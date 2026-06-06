<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/functions.php';

header('Content-Type: text/plain; charset=UTF-8');
$base = rtrim(base_path(), '/');
echo "User-agent: *\n";
echo "Allow: /\n";
echo "Disallow: {$base}/administrador/\n";
echo "Disallow: {$base}/ckeditor/\n";
echo "Disallow: {$base}/config/\n";
echo "Disallow: {$base}/includes/\n";
echo "Disallow: {$base}/node_modules/\n";
echo "Disallow: {$base}/buscar\n\n";
echo "Sitemap: " . site_url('sitemap.xml') . "\n";
