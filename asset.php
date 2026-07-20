<?php
$assets = [
  'logo' => __DIR__ . '/assets/generated/logo.b64',
  'fans' => __DIR__ . '/assets/portals/fans-fixed.webp.b64',
  'electric' => __DIR__ . '/assets/portals/electric-fixed.webp.b64',
];

$name = $_GET['name'] ?? '';
if (!isset($assets[$name])) {
  http_response_code(404);
  exit;
}

$file = $assets[$name];
if (!is_file($file)) {
  http_response_code(404);
  header('Content-Type: text/plain; charset=utf-8');
  echo 'Görsel kaynağı bulunamadı.';
  exit;
}

$encoded = file_get_contents($file);
if ($encoded === false) {
  http_response_code(500);
  exit;
}

$encoded = preg_replace('/\s+/', '', $encoded);
$data = base64_decode($encoded, true);

if ($data === false || strlen($data) < 12 || substr($data, 0, 4) !== 'RIFF' || substr($data, 8, 4) !== 'WEBP') {
  http_response_code(500);
  header('Content-Type: text/plain; charset=utf-8');
  echo 'WebP görsel dosyası bozuk veya eksik.';
  exit;
}

header('Content-Type: image/webp');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');
header('Content-Length: ' . strlen($data));
echo $data;
