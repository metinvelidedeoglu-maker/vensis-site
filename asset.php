<?php
$files = [
  'logo' => [__DIR__ . '/assets/logo-fixed.webp'],
  'fans' => [__DIR__ . '/assets/portals/fans-fixed.webp.b64'],
  'electric' => [__DIR__ . '/assets/portals/electric-fixed.webp.b64'],
];

$name = $_GET['name'] ?? '';
if (!isset($files[$name])) {
  http_response_code(404);
  exit;
}

$data = '';
foreach ($files[$name] as $file) {
  if (!is_file($file)) {
    http_response_code(404);
    exit;
  }
  $data .= preg_replace('/\s+/', '', file_get_contents($file));
}

$binary = base64_decode($data, true);
if ($binary === false) {
  http_response_code(500);
  exit;
}

header('Content-Type: image/webp');
header('Cache-Control: public, max-age=31536000, immutable');
header('Content-Length: ' . strlen($binary));
echo $binary;
