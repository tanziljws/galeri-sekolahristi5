<?php
/**
 * Script untuk copy foto siswa dari galeri ke images folder
 * Untuk background section About
 */

echo "=== COPY FOTO SISWA UNTUK BACKGROUND ===\n\n";

// Source: Foto dari galeri (salah satu foto siswa)
$sourceFiles = [
    'storage/app/public/galeri/1756200774_68ad7f46775d2.jpg',
    'storage/app/public/galeri/1756200809_68ad7f695b59b.jpg',
    'storage/app/public/galeri/1756207413_68ad99355ade3.jpg',
];

// Destination
$destination = 'public/images/siswa-upacara.jpg';

$copied = false;

foreach ($sourceFiles as $source) {
    $fullSource = __DIR__ . '/' . $source;
    $fullDest = __DIR__ . '/' . $destination;
    
    if (file_exists($fullSource)) {
        echo "Found photo: {$source}\n";
        echo "Copying to: {$destination}\n";
        
        if (copy($fullSource, $fullDest)) {
            echo "✓ Successfully copied!\n";
            echo "File size: " . filesize($fullDest) . " bytes\n";
            $copied = true;
            break;
        } else {
            echo "✗ Failed to copy\n";
        }
    }
}

if (!$copied) {
    echo "\n❌ No suitable photo found in gallery.\n";
    echo "\nPlease manually:\n";
    echo "1. Save the student photo as 'siswa-upacara.jpg'\n";
    echo "2. Copy to: public/images/\n";
} else {
    echo "\n✅ Done! Refresh your browser to see the background.\n";
    echo "URL: http://127.0.0.1:8000/\n";
}
