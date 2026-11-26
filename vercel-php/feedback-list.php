<?php
declare(strict_types=1);

date_default_timezone_set('Asia/Kuala_Lumpur');

function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function http_get(string $url, array $headers): array
{
    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'header' => implode("\r\n", $headers),
            'timeout' => 15,
            'ignore_errors' => true,
        ],
    ]);

    $body = @file_get_contents($url, false, $context);
    $status = 0;

    if (isset($http_response_header[0]) && preg_match('/\s(\d{3})\s/', $http_response_header[0], $matches)) {
        $status = (int) $matches[1];
    }

    return [$status, is_string($body) ? $body : ''];
}

function load_blob_feedback(): array
{
    $token = getenv('BLOB_READ_WRITE_TOKEN');
    if (!is_string($token) || $token === '') {
        return [];
    }

    $parts = explode('_', $token);
    $storeId = $parts[3] ?? '';
    if ($storeId === '') {
        return [];
    }

    $headers = [
        'Authorization: Bearer ' . $token,
        'x-api-version: 13',
        'x-vercel-blob-store-id: ' . $storeId,
    ];

    [$status, $body] = http_get('https://blob.vercel-storage.com/?limit=100', $headers);
    if ($status < 200 || $status >= 300) {
        return [];
    }

    $data = json_decode($body, true);
    $blobs = is_array($data['blobs'] ?? null) ? $data['blobs'] : [];
    $records = [];

    foreach ($blobs as $blob) {
        $pathname = (string) ($blob['pathname'] ?? '');
        if (!str_starts_with($pathname, 'feedback/')) {
            continue;
        }

        $url = (string) ($blob['downloadUrl'] ?? $blob['url'] ?? '');
        if ($url === '') {
            continue;
        }

        [$fileStatus, $fileBody] = http_get($url, $headers);
        if ($fileStatus < 200 || $fileStatus >= 300) {
            continue;
        }

        $record = json_decode($fileBody, true);
        if (is_array($record)) {
            $records[] = $record;
        }
    }

    return $records;
}

$adminKey = getenv('FEEDBACK_ADMIN_KEY') ?: '';
$providedKey = isset($_GET['key']) && is_string($_GET['key']) ? $_GET['key'] : '';

if ($adminKey !== '' && !hash_equals($adminKey, $providedKey)) {
    http_response_code(403);
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MOODIFY — Feedback Admin</title>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600&family=Outfit:wght@800&display=swap" rel="stylesheet">
        <style>
            :root { --black:#09090c; --panel:#111116; --lavender:#ccccff; --cream:#f5f3ee; --grey:#aaa9b2; --border:rgba(255,255,255,.12); }
            * { box-sizing:border-box; }
            body { margin:0; min-height:100vh; display:grid; place-items:center; padding:24px; background:radial-gradient(ellipse at 80% 10%, rgba(204,204,255,.12), transparent 40%), var(--black); color:var(--cream); font-family:'DM Sans',sans-serif; }
            .card { width:min(520px,100%); padding:36px; background:var(--panel); border:1px solid var(--border); }
            h1 { margin:10px 0 8px; font-family:'Playfair Display',Georgia,serif; font-weight:600; font-size:2.2rem; }
            p { color:var(--grey); line-height:1.7; }
            .kicker { color:var(--lavender); font-size:10px; font-weight:700; letter-spacing:2px; text-transform:uppercase; }
            label { display:block; margin:24px 0 8px; color:var(--grey); font-size:10px; font-weight:700; letter-spacing:1.2px; text-transform:uppercase; }
            input { width:100%; padding:12px 14px; background:#08080c; border:1px solid var(--border); color:var(--cream); font:inherit; outline:none; }
            input:focus { border-color:var(--lavender); box-shadow:0 0 0 3px rgba(204,204,255,.1); }
            button { margin-top:14px; padding:12px 18px; border:1px solid var(--lavender); background:var(--lavender); color:var(--black); font:700 11px 'DM Sans',sans-serif; letter-spacing:1.2px; text-transform:uppercase; cursor:pointer; }
            a { color:var(--lavender); }
        </style>
    </head>
    <body>
        <main class="card">
            <div class="kicker">MOODIFY / ADMIN</div>
            <h1>Feedback access.</h1>
            <p>Enter the admin key to view submitted feedback.</p>
            <form method="get">
                <label for="key">Admin key</label>
                <input id="key" name="key" type="password" required autofocus>
                <button type="submit">View Feedback</button>
            </form>
            <p><a href="https://flyingmyvi.github.io/MOODIFY/">Back to MOODIFY</a></p>
        </main>
    </body>
    </html>
    <?php
    exit;
}

$records = load_blob_feedback();

usort($records, function (array $a, array $b): int {
    $aTime = strtotime((string) ($a['submitted_at'] ?? '')) ?: 0;
    $bTime = strtotime((string) ($b['submitted_at'] ?? '')) ?: 0;
    return $bTime <=> $aTime;
});

$refreshUrl = 'feedback-list.php' . ($adminKey !== '' ? '?key=' . rawurlencode($providedKey) : '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#09090c">
    <title>MOODIFY — Feedback Received</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600&family=Outfit:wght@800&display=swap" rel="stylesheet">
    <style>
        :root {
            --black:#09090c;
            --panel:#111116;
            --surface:#191920;
            --lavender:#ccccff;
            --cream:#f5f3ee;
            --grey:#aaa9b2;
            --border:rgba(255,255,255,.12);
        }
        * { box-sizing:border-box; }
        body {
            margin:0;
            min-height:100vh;
            padding:34px;
            background:
                radial-gradient(ellipse at 85% 8%, rgba(204,204,255,.1), transparent 38%),
                var(--black);
            color:var(--cream);
            font-family:'DM Sans',sans-serif;
        }
        .wrap { width:min(1400px,100%); margin:0 auto; }
        .topbar {
            display:flex;
            align-items:flex-end;
            justify-content:space-between;
            gap:20px;
            padding-bottom:22px;
            margin-bottom:22px;
            border-bottom:1px solid var(--border);
        }
        .kicker {
            color:var(--lavender);
            font-size:10px;
            font-weight:700;
            letter-spacing:2px;
            text-transform:uppercase;
        }
        h1 {
            margin:10px 0 0;
            font-family:'Playfair Display',Georgia,serif;
            font-size:clamp(2rem,4vw,3.1rem);
            font-weight:600;
            line-height:1.1;
        }
        .sub { margin-top:6px; color:var(--grey); font-size:13px; }
        .actions { display:flex; flex-wrap:wrap; gap:12px; }
        .actions a {
            color:var(--lavender);
            font-size:11px;
            font-weight:700;
            letter-spacing:.8px;
            text-decoration:none;
            text-transform:uppercase;
        }
        .actions a:hover { text-decoration:underline; }
        .table-wrap {
            overflow-x:auto;
            background:var(--panel);
            border:1px solid var(--border);
        }
        table { width:100%; min-width:1050px; border-collapse:collapse; }
        th, td {
            padding:11px 12px;
            border-bottom:1px solid var(--border);
            border-right:1px solid var(--border);
            text-align:left;
            vertical-align:top;
        }
        th:last-child, td:last-child { border-right:0; }
        th {
            background:var(--surface);
            color:var(--lavender);
            font-size:9px;
            font-weight:700;
            letter-spacing:1.2px;
            text-transform:uppercase;
            white-space:nowrap;
        }
        td { color:var(--cream); font-size:12px; line-height:1.55; }
        tr:last-child td { border-bottom:0; }
        td.message { min-width:300px; white-space:pre-wrap; color:var(--grey); }
        td.email { min-width:190px; }
        td.email a { color:var(--lavender); text-decoration:none; }
        td.email a:hover { text-decoration:underline; }
        .empty {
            padding:40px 24px;
            text-align:center;
            color:var(--grey);
            background:var(--panel);
            border:1px solid var(--border);
        }
        @media (max-width:700px) {
            body { padding:18px; }
            .topbar { align-items:flex-start; flex-direction:column; }
        }
    </style>
</head>
<body>
<div class="wrap">
    <header class="topbar">
        <div>
            <div class="kicker">MOODIFY / ADMIN</div>
            <h1>Feedback Received</h1>
            <div class="sub"><?= count($records) ?> submission<?= count($records) === 1 ? '' : 's' ?> · newest first</div>
        </div>
        <div class="actions">
            <a href="<?= h($refreshUrl) ?>">Refresh</a>
            <a href="https://flyingmyvi.github.io/MOODIFY/">Back to MOODIFY</a>
        </div>
    </header>

    <?php if ($records === []): ?>
        <div class="empty">No feedback has been submitted yet.</div>
    <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Reference</th>
                        <th>Date &amp; Time</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Feedback</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($records as $record): ?>
                    <?php
                    $timestamp = strtotime((string) ($record['submitted_at'] ?? ''));
                    $displayDate = $timestamp ? date('d M Y, g:i A', $timestamp) : (string) ($record['submitted_at'] ?? '—');
                    $reference = (string) ($record['reference'] ?? '—');
                    $name = (string) ($record['name'] ?? '—');
                    $gender = (string) ($record['gender'] ?? '—');
                    $email = (string) ($record['email'] ?? '');
                    $type = (string) ($record['type'] ?? '—');
                    $message = (string) ($record['message'] ?? '—');
                    ?>
                    <tr>
                        <td><?= h($reference) ?></td>
                        <td><?= h($displayDate) ?></td>
                        <td><?= h($name) ?></td>
                        <td><?= h($gender) ?></td>
                        <td class="email">
                            <?php if ($email !== ''): ?>
                                <a href="mailto:<?= h($email) ?>"><?= h($email) ?></a>
                            <?php else: ?>
                                —
                            <?php endif; ?>
                        </td>
                        <td><?= h($type) ?></td>
                        <td class="message"><?= h($message) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
