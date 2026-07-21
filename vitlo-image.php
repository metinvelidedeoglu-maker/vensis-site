<?php
ini_set('display_errors', '0');
ini_set('zlib.output_compression', '0');
while (ob_get_level() > 0) {
    ob_end_clean();
}

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

    $encoded .= preg_replace('/\s+/', '', $part);
}

$data = base64_decode($encoded, true);
$valid = $data !== false
    && strlen($data) >= 12
    && substr($data, 0, 4) === 'RIFF'
    && substr($data, 8, 4) === 'WEBP';

if ($valid) {
    $riff = unpack('Vsize', substr($data, 4, 4));
    $expectedLength = ($riff['size'] ?? 0) + 8;
    $valid = $expectedLength === strlen($data);
}

if (!$valid) {
    $fallback = __DIR__ . '/assets/portals/vitlo.svg';
    if (is_file($fallback)) {
        header('Content-Type: image/svg+xml; charset=utf-8');
        header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
        header('X-Content-Type-Options: nosniff');
        readfile($fallback);
        exit;
    }

    http_response_code(500);
    exit;
}

header_remove('Content-Length');
header('Content-Type: image/webp');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');
header('Accept-Ranges: none');
header('X-Content-Type-Options: nosniff');
echo $data;
exit;
