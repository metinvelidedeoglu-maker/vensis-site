<?php
$encoded = '';

for ($i = 0; $i <= 9; $i++) {
    $file = __DIR__ . '/assets/portals/vitlo-premium/' . str_pad((string) $i, 2, '0', STR_PAD_LEFT) . '.b64';

    if (!is_file($file)) {
        http_response_code(404);
        header('Content-Type: text/plain; charset=utf-8');
        echo 'Vitlo görsel parçası bulunamadı.';
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

if (
    $data === false ||
    strlen($data) < 12 ||
    substr($data, 0, 4) !== 'RIFF' ||
    substr($data, 8, 4) !== 'WEBP'
) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');
    echo 'Vitlo görseli okunamadı.';
    exit;
}

header('Content-Type: image/webp');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');
header('Content-Length: ' . strlen($data));
echo $data;
