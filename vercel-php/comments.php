<?php
declare(strict_types=1);

date_default_timezone_set('Asia/Kuala_Lumpur');

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('X-Content-Type-Options: nosniff');

$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
$allowedOrigin = $origin === 'https://flyingmyvi.github.io'
    || preg_match('#^http://(localhost|127\.0\.0\.1)(:\d+)?$#', $origin) === 1;

if ($origin !== '' && $allowedOrigin) {
    header('Access-Control-Allow-Origin: ' . $origin);
    header('Vary: Origin');
}

header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
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
    $value = preg_replace('/[\x00-\x1F\x7F]/u', ' ', $value) ?? '';
    $value = preg_replace('/\s+/u', ' ', $value) ?? '';
    return mb_substr(trim($value), 0, $maxLength);
}

function blob_credentials(): ?array
{
    $token = getenv('BLOB_READ_WRITE_TOKEN');
    if (!is_string($token) || $token === '') {
        return null;
    }

    $parts = explode('_', $token);
    $storeId = $parts[3] ?? '';
    if ($storeId === '') {
        return null;
    }

    return [$token, $storeId];
}

function blob_request(string $method, string $url, string $token, ?string $body = null, array $extraHeaders = []): array
{
    $headers = array_merge([
        'Authorization: Bearer ' . $token,
        'x-api-version: 13',
    ], $extraHeaders);

    $options = [
        'method' => $method,
        'header' => implode("\r\n", $headers),
        'timeout' => 15,
        'ignore_errors' => true,
    ];

    if ($body !== null) {
        $options['content'] = $body;
    }

    $context = stream_context_create(['http' => $options]);
    $response = @file_get_contents($url, false, $context);
    $status = 0;

    if (isset($http_response_header[0]) && preg_match('/\s(\d{3})\s/', $http_response_header[0], $matches)) {
        $status = (int) $matches[1];
    }

    return [$status, is_string($response) ? $response : ''];
}

function store_comment(int $track, array $record): bool
{
    $credentials = blob_credentials();
    if ($credentials === null) {
        error_log('MOODIFY comments: Blob credentials are missing.');
        return false;
    }

    [$token, $storeId] = $credentials;

    $pathname = 'comments/' . $track . '/' . $record['id'] . '.json';
    $body = json_encode($record, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    if ($body === false) {
        return false;
    }

    $url = 'https://blob.vercel-storage.com/?' . http_build_query(['pathname' => $pathname]);

    [$status, $response] = blob_request('PUT', $url, $token, $body, [
        'x-vercel-blob-store-id: ' . $storeId,
        'x-content-type: application/json',
        'x-add-random-suffix: 0',
        'x-allow-overwrite: 0',
        'x-vercel-blob-access: private',
        'Content-Type: application/json',
        'Content-Length: ' . strlen($body),
    ]);

    if ($status < 200 || $status >= 300) {
        error_log('MOODIFY comments: Blob upload failed with status ' . $status . ' response ' . substr($response, 0, 300));
        return false;
    }

    return true;
}

function load_comments(int $track): array
{
    $credentials = blob_credentials();
    if ($credentials === null) {
        return [];
    }

    [$token, $storeId] = $credentials;
    $prefix = 'comments/' . $track . '/';

    $listUrl = 'https://blob.vercel-storage.com/?' . http_build_query([
        'prefix' => $prefix,
        'limit' => 200,
    ]);

    [$status, $body] = blob_request('GET', $listUrl, $token, null, [
        'x-vercel-blob-store-id: ' . $storeId,
    ]);

    if ($status < 200 || $status >= 300) {
        error_log('MOODIFY comments: Blob list failed with status ' . $status);
        return [];
    }

    $data = json_decode($body, true);
    $blobs = is_array($data['blobs'] ?? null) ? $data['blobs'] : [];
    $comments = [];

    foreach ($blobs as $blob) {
        $pathname = (string) ($blob['pathname'] ?? '');
        if (!str_starts_with($pathname, $prefix)) {
            continue;
        }

        $fileUrl = (string) ($blob['downloadUrl'] ?? $blob['url'] ?? '');
        if ($fileUrl === '') {
            continue;
        }

        [$fileStatus, $fileBody] = blob_request('GET', $fileUrl, $token);
        if ($fileStatus < 200 || $fileStatus >= 300) {
            continue;
        }

        $record = json_decode($fileBody, true);
        if (!is_array($record)) {
            continue;
        }

        $comments[] = [
            'id' => (string) ($record['id'] ?? ''),
            'user' => (string) ($record['user'] ?? ''),
            'text' => (string) ($record['text'] ?? ''),
            'at' => (string) ($record['at'] ?? ''),
        ];
    }

    usort($comments, static function (array $a, array $b): int {
        return strcmp($b['at'], $a['at']);
    });

    return array_slice($comments, 0, 100);
}

$method = $_SERVER['REQUEST_METHOD'] ?? '';

if ($method === 'GET') {
    $trackRaw = $_GET['track'] ?? null;
    if (!is_numeric($trackRaw)) {
        respond(422, ['ok' => false, 'error' => 'A valid track number is required.']);
    }

    $track = (int) $trackRaw;
    if ($track < 0 || $track > 19) {
        respond(422, ['ok' => false, 'error' => 'Unknown track.']);
    }

    respond(200, [
        'ok' => true,
        'track' => $track,
        'comments' => load_comments($track),
        'storage' => 'Vercel Blob',
    ]);
}

if ($method !== 'POST') {
    respond(405, ['ok' => false, 'error' => 'Method not allowed.']);
}

$raw = file_get_contents('php://input');
if (strlen((string) $raw) > 4000) {
    respond(413, ['ok' => false, 'error' => 'Comment is too large.']);
}

$contentType = $_SERVER['CONTENT_TYPE'] ?? '';

if (stripos($contentType, 'application/json') !== false) {
    $input = json_decode((string) $raw, true);
    if (!is_array($input)) {
        respond(400, ['ok' => false, 'error' => 'Invalid JSON payload.']);
    }
} else {
    $input = $_POST;
}

if (text_field($input, 'website', 200) !== '') {
    respond(422, ['ok' => false, 'error' => 'Unable to post this comment.']);
}

$trackRaw = $input['track'] ?? null;
$name = text_field($input, 'name', 24);
$text = text_field($input, 'text', 280);

$errors = [];

if (!is_numeric($trackRaw) || (int) $trackRaw < 0 || (int) $trackRaw > 19) {
    $errors['track'] = 'Unknown track.';
}

if ($name === '') {
    $errors['name'] = 'Please enter a username.';
}

if (mb_strlen($text) < 2) {
    $errors['text'] = 'Please write at least 2 characters.';
}

if ($errors !== []) {
    respond(422, [
        'ok' => false,
        'error' => 'Please check the highlighted fields and try again.',
        'fields' => $errors,
    ]);
}

$track = (int) $trackRaw;
$id = 'CMT-' . strtoupper(bin2hex(random_bytes(4)));
$at = date('c');

$record = [
    'id' => $id,
    'track' => $track,
    'user' => $name,
    'text' => $text,
    'at' => $at,
];

if (!store_comment($track, $record)) {
    respond(500, [
        'ok' => false,
        'error' => 'Comment storage is temporarily unavailable. Please try again.',
    ]);
}

respond(200, [
    'ok' => true,
    'comment' => [
        'id' => $id,
        'user' => $name,
        'text' => $text,
        'at' => $at,
    ],
    'storage' => 'Vercel Blob',
]);
