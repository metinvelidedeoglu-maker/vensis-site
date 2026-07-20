<?php
$assets = [
  'logo' => [
    __DIR__ . '/assets/generated/logo.b64',
  ],
  'fans' => [
    __DIR__ . '/assets/portals/fans-chunks/00.b64',
  ],
  'electric' => [
    __DIR__ . '/assets/portals/electric-00.b64',
    __DIR__ . '/assets/portals/electric-01.b64',
    __DIR__ . '/assets/portals/electric-03.b64',
  ],
];

$name = $_GET['name'] ?? '';
if (!isset($assets[$name])) {
  http_response_code(404);
  exit;
}

$encoded = '';
foreach ($assets[$name] as $file) {
  if (!is_file($file)) {
    http_response_code(404);
    header('Content-Type: text/plain; charset=utf-8');
    echo 'Görsel parçası bulunamadı: ' . basename($file);
    exit;
  }

  $part = file_get_contents($file);
  if ($part === false) {
    http_response_code(500);
    exit;
  }

  $encoded .= preg_replace('/\s+/', '', $part);
}

$data = base64_decode($encoded, false);
if ($data === false || strlen($data) < 12 || substr($data, 0, 4) !== 'RIFF' || substr($data, 8, 4) !== 'WEBP') {
  http_response_code(500);
  header('Content-Type: text/plain; charset=utf-8');
  echo 'WebP görsel verisi çözülemedi.';
  exit;
}

header('Content-Type: image/webp');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');
header('Content-Length: ' . strlen($data));
echo $data;
