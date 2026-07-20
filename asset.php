<?php
$assets = [
  'logo' => [
    'path' => __DIR__ . '/assets/logo-fixed.webp',
    'type' => 'image/webp',
    'base64' => false,
  ],
  'fans' => [
    'path' => __DIR__ . '/assets/portals/fans-fixed.webp.b64',
    'type' => 'image/webp',
    'base64' => true,
  ],
  'electric' => [
    'path' => __DIR__ . '/assets/portals/electric-fixed.webp.b64',
    'type' => 'image/webp',
    'base64' => true,
  ],
];

$name = $_GET['name'] ?? '';
if (!isset($assets[$name])) {
  http_response_code(404);
  exit;
}

$asset = $assets[$name];
if (!is_file($asset['path'])) {
  http_response_code(404);
  exit;
}

$data = file_get_contents($asset['path']);
if ($data === false) {
  http_response_code(500);
  exit;
}

if ($asset['base64']) {
  $data = base64_decode(preg_replace('/\s+/', '', $data), true);
  if ($data === false) {
    http_response_code(500);
    exit;
  }
}

header('Content-Type: ' . $asset['type']);
header('Cache-Control: public, max-age=3600');
header('Content-Length: ' . strlen($data));
echo $data;
