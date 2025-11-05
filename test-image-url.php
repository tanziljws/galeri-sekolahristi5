<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

echo "=== TEST IMAGE URL ===\n\n";

$galery = \App\Models\Galery::with('fotos')->first();

if ($galery && $galery->fotos->count() > 0) {
    $firstPhoto = $galery->fotos->first();
    
    echo "Album: " . $galery->judul . "\n";
    echo "Foto file: " . $firstPhoto->file . "\n\n";
    
    // Test ImageHelper
    $imageUrl = \App\Helpers\ImageHelper::getImageUrl($firstPhoto->file);
    echo "Image URL dari ImageHelper:\n";
    echo $imageUrl . "\n\n";
    
    // Test manual path
    echo "Path yang dicek:\n";
    echo "1. public/storage/galeri/" . $firstPhoto->file . " - " . (file_exists(public_path('storage/galeri/' . $firstPhoto->file)) ? 'EXISTS' : 'NOT FOUND') . "\n";
    echo "2. storage/app/public/galeri/" . $firstPhoto->file . " - " . (file_exists(storage_path('app/public/galeri/' . $firstPhoto->file)) ? 'EXISTS' : 'NOT FOUND') . "\n";
    
} else {
    echo "Tidak ada galeri atau foto\n";
}
