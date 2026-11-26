<?php
declare(strict_types=1);


date_default_timezone_set('Asia/Kuala_Lumpur');

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('X-Content-Type-Options: nosniff');

function respond(int $status, array $payload): never
{
    http_response_code($status);
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    respond(405, ['ok' => false, 'error' => 'Method not allowed.']);
}

$raw = file_get_contents('php://input');
$contentType = $_SERVER['CONTENT_TYPE'] ?? '';

if (stripos($contentType, 'application/json') !== false) {
    $input = json_decode((string) $raw, true);
    if (!is_array($input)) {
        respond(400, ['ok' => false, 'error' => 'Invalid JSON payload.']);
    }
} else {
    $input = $_POST;
}

function text_field(array $input, string $key, int $maxLength): string
{
    $value = $input[$key] ?? '';
    if (!is_string($value)) {
        return '';
    }

    $value = trim($value);
    $value = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $value) ?? '';
    return mb_substr($value, 0, $maxLength);
}

$honeypot = text_field($input, 'website', 200);
if ($honeypot !== '') {
    respond(422, ['ok' => false, 'error' => 'Unable to submit this form.']);
}

$name = text_field($input, 'name', 80);
$gender = text_field($input, 'gender', 40);
$email = text_field($input, 'email', 120);
$type = text_field($input, 'type', 40);
$message = text_field($input, 'message', 1500);

$allowedGenders = ['Female', 'Male'];
$allowedTypes = ['Suggestion', 'Complaint', 'Enquiry'];

$errors = [];

if (mb_strlen($name) < 2) {
    $errors['name'] = 'Please enter your name (at least 2 characters).';
}

if (!in_array($gender, $allowedGenders, true)) {
    $errors['gender'] = 'Please select a gender.';
}

if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Please enter a valid email address.';
}

if (!in_array($type, $allowedTypes, true)) {
    $errors['type'] = 'Please choose a feedback type.';
}

if (mb_strlen($message) < 10) {
    $errors['message'] = 'Please write at least 10 characters.';
}

if ($errors !== []) {
    respond(422, [
        'ok' => false,
        'error' => 'Please check the highlighted fields and try again.',
        'fields' => $errors,
    ]);
}

$reference = 'MOOD-' . strtoupper(bin2hex(random_bytes(3)));
$submittedAt = date('c');

$record = [
    'reference' => $reference,
    'name' => $name,
    'gender' => $gender,
    'email' => $email,
    'type' => $type,
    'message' => $message,
    'submitted_at' => $submittedAt,
    'source' => 'feedback.html',
];

$dataDir = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'feedback-data';
$dataFile = $dataDir . DIRECTORY_SEPARATOR . 'feedback.json';

if (!is_dir($dataDir) && !mkdir($dataDir, 0775, true) && !is_dir($dataDir)) {
    respond(500, ['ok' => false, 'error' => 'Feedback storage is unavailable.']);
}

$htaccess = $dataDir . DIRECTORY_SEPARATOR . '.htaccess';
if (!file_exists($htaccess)) {
    @file_put_contents(
        $htaccess,
        "<IfModule mod_authz_core.c>\n    Require all denied\n</IfModule>\n" .
        "<IfModule !mod_authz_core.c>\n    Order allow,deny\n    Deny from all\n</IfModule>\n"
    );
}

$handle = @fopen($dataFile, 'c+');
if ($handle === false) {
    respond(500, ['ok' => false, 'error' => 'Feedback storage is not writable.']);
}

if (!flock($handle, LOCK_EX)) {
    fclose($handle);
    respond(500, ['ok' => false, 'error' => 'Feedback storage is busy. Please try again.']);
}

$existing = [];
$contents = stream_get_contents($handle);
if (is_string($contents) && trim($contents) !== '') {
    $decoded = json_decode($contents, true);
    if (is_array($decoded)) {
        $existing = $decoded;
    }
}

$existing[] = $record;
$json = json_encode($existing, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

if ($json === false) {
    flock($handle, LOCK_UN);
    fclose($handle);
    respond(500, ['ok' => false, 'error' => 'Could not prepare the feedback record.']);
}

rewind($handle);
ftruncate($handle, 0);
$written = fwrite($handle, $json);
fflush($handle);
flock($handle, LOCK_UN);
fclose($handle);

if ($written === false) {
    respond(500, ['ok' => false, 'error' => 'Could not save your feedback.']);
}

respond(200, [
    'ok' => true,
    'reference' => $reference,
    'submittedAt' => $submittedAt,
    'storage' => 'Server',
]);
