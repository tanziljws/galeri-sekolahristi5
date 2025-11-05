<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== CEK DATA GALERI ===\n\n";

$galeries = \App\Models\Galery::with('fotos')->get();

echo "Total Album: " . $galeries->count() . "\n";
echo "Total Foto: " . \App\Models\Foto::count() . "\n\n";

foreach ($galeries as $galery) {
    echo "Album: " . ($galery->judul ?? 'Tanpa Judul') . "\n";
    echo "  - Jumlah foto: " . $galery->fotos->count() . "\n";
    
    if ($galery->fotos->count() > 0) {
        $firstPhoto = $galery->fotos->first();
        echo "  - Foto pertama: " . $firstPhoto->file . "\n";
        
        $filePath = storage_path('app/public/galeri/' . $firstPhoto->file);
        echo "  - File exists: " . (file_exists($filePath) ? 'YES' : 'NO') . "\n";
        
        if (file_exists($filePath)) {
            echo "  - File size: " . round(filesize($filePath) / 1024 / 1024, 2) . " MB\n";
        }
    }
    echo "\n";
}
