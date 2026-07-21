<?php
$files = [
    '00.b64',
    '01.b64',
    '02.b64',
    '03.b64',
    '04.b64',
    '05.b64',
    '06a0.b64',
    '06a10.b64',
    '06a11.b64',
    '06b.b64',
    '06c.b64',
    '06d.b64',
    '07.b64',
    '08.b64',
    '09.b64',
];

$encoded = '';
$baseDir = __DIR__ . '/assets/portals/vitlo-premium/';

foreach ($files as $name) {
    $file = $baseDir . $name;

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
$expectedSha256 = '8f0e1ff8947db5ae6ba159e281372f5911644457d5889fc80feb65b7d4be76d5';

if (
    $data === false ||
    strlen($data) < 12 ||
    substr($data, 0, 4) !== 'RIFF' ||
    substr($data, 8, 4) !== 'WEBP' ||
    hash('sha256', $data) !== $expectedSha256
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
