<?php
$files = [
    __DIR__ . '/assets/vitlo-card/00.b64',
    __DIR__ . '/assets/vitlo-card/01.b64',
    __DIR__ . '/assets/vitlo-card/02.b64',
];

$encoded = '';
foreach ($files as $file) {
    if (!is_file($file)) {
        http_response_code(404);
        exit;
    }
    $part = file_get_contents($file);
    if ($part === false) {
        http_response_code(500);
        exit;
    }
    $encoded .= $part;
}

$encoded = preg_replace('/\s+/', '', $encoded);
$data = base64_decode($encoded, true);

if ($data === false || strlen($data) < 12 || substr($data, 0, 4) !== 'RIFF' || substr($data, 8, 4) !== 'WEBP') {
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');
    echo 'Vitlo görseli okunamadı.';
    exit;
}

header('Content-Type: image/webp');
header('Content-Length: ' . strlen($data));
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');
echo $data;
