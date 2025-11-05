<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Http\Kernel');
$request = Illuminate\Http\Request::capture();
$kernel->bootstrap();

use App\Helpers\ImageHelper;

$filename = '1761625417_69004549c7414.jpg';

echo "=== TEST IMAGE HELPER ===\n\n";
echo "Filename: {$filename}\n\n";

$url = ImageHelper::getImageUrl($filename);
echo "URL: {$url}\n\n";

// Cek apakah file ada di berbagai lokasi
$locations = [
    'public/storage/galeri/' => public_path('storage/galeri/' . $filename),
    'storage/app/public/galeri/' => storage_path('app/public/galeri/' . $filename),
    'public/images/galeri/' => public_path('images/galeri/' . $filename),
];

echo "Cek lokasi file:\n";
foreach ($locations as $label => $path) {
    $exists = file_exists($path) ? 'ADA ✓' : 'TIDAK ADA ✗';
    echo "- {$label}: {$exists}\n";
    if (file_exists($path)) {
        echo "  Path: {$path}\n";
    }
}
