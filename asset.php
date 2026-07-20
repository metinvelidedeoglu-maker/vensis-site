<?php
$patterns = [
  'logo' => __DIR__ . '/assets/logo-fixed.webp*',
  'fans' => __DIR__ . '/assets/portals/fans-fixed.webp.b64*',
  'electric' => __DIR__ . '/assets/portals/electric-fixed.webp.b64*',
];

$name = $_GET['name'] ?? '';
if (!isset($patterns[$name])) {
  http_response_code(404);
  exit;
}

$files = glob($patterns[$name], GLOB_NOSORT) ?: [];
if (!$files) {
  http_response_code(404);
  exit;
}

usort($files, 'strnatcasecmp');
$raw = '';
foreach ($files as $file) {
  if (!is_file($file)) {
    continue;
  }
  $part = file_get_contents($file);
  if ($part === false) {
    http_response_code(500);
    exit;
  }
  $raw .= $part;
}

if ($raw === '') {
  http_response_code(404);
  exit;
}

// Dosya gerçek WebP ise doğrudan, base64 metni ise çözerek gönder.
if (substr($raw, 0, 4) === 'RIFF' && substr($raw, 8, 4) === 'WEBP') {
  $data = $raw;
} else {
  $encoded = preg_replace('/\s+/', '', $raw);
  $data = base64_decode($encoded, true);
}

if ($data === false || substr($data, 0, 4) !== 'RIFF' || substr($data, 8, 4) !== 'WEBP') {
  http_response_code(500);
  header('Content-Type: text/plain; charset=utf-8');
  echo 'Görsel verisi okunamadı.';
  exit;
}

header('Content-Type: image/webp');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');
header('Content-Length: ' . strlen($data));
echo $data;
