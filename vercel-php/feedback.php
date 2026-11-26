<?php
declare(strict_types=1);


date_default_timezone_set('Asia/Kuala_Lumpur');

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('X-Content-Type-Options: nosniff');

$allowedOrigins = [
    'https://flyingmyvi.github.io',
    'http://localhost',
    'http://localhost:8000',
    'http://127.0.0.1:8000',
];

$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
if ($origin !== '' && in_array($origin, $allowedOrigins, true)) {
    header('Access-Control-Allow-Origin: ' . $origin);
    header('Vary: Origin');
}

header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Accept');

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'OPTIONS') {
    http_response_code(204);
    exit;
}

function respond(int $status, array $payload): never
{
    http_response_code($status);
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
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

function store_in_blob(array $record): bool
{
    $token = getenv('BLOB_READ_WRITE_TOKEN');
    if (!is_string($token) || $token === '') {
        return false;
    }

    $parts = explode('_', $token);
    $storeId = $parts[3] ?? '';
    if ($storeId === '') {
        error_log('MOODIFY feedback: could not read Blob store ID from token.');
        return false;
    }

    $pathname = 'feedback/' . $record['reference'] . '.json';
    $body = json_encode($record, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    if ($body === false) {
        return false;
    }

    $url = 'https://blob.vercel-storage.com/?' . http_build_query([
        'pathname' => $pathname,
    ]);

    $headers = [
        'Authorization: Bearer ' . $token,
        'x-api-version: 13',
        'x-vercel-blob-store-id: ' . $storeId,
        'x-content-type: application/json',
        'x-add-random-suffix: 0',
        'x-allow-overwrite: 0',
        'x-vercel-blob-access: private',
        'Content-Type: application/json',
        'Content-Length: ' . strlen($body),
    ];

    $context = stream_context_create([
        'http' => [
            'method' => 'PUT',
            'header' => implode("\r\n", $headers),
            'content' => $body,
            'timeout' => 15,
            'ignore_errors' => true,
        ],
    ]);

    $response = @file_get_contents($url, false, $context);
    $status = 0;

    if (isset($http_response_header[0]) && preg_match('/\s(\d{3})\s/', $http_response_header[0], $matches)) {
        $status = (int) $matches[1];
    }

    if ($response === false || $status < 200 || $status >= 300) {
        error_log('MOODIFY feedback: Blob upload failed with status ' . $status . ' response ' . substr((string) $response, 0, 300));
        return false;
    }

    return true;
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
    'source' => 'vercel-feedback',
];

if (!store_in_blob($record)) {
    respond(500, [
        'ok' => false,
        'error' => 'Feedback storage is temporarily unavailable. Please try again.',
    ]);
}

respond(200, [
    'ok' => true,
    'reference' => $reference,
    'submittedAt' => $submittedAt,
    'storage' => 'Vercel Blob',
]);
