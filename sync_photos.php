<?php
/**
 * Script untuk sync foto dari storage/app/public/galeri ke public/storage/galeri
 * Untuk fix masalah foto tidak tampil di Windows XAMPP
 */

$source = __DIR__ . '/storage/app/public/galeri/';
$dest = __DIR__ . '/public/storage/galeri/';

echo "=== SYNC PHOTOS ===\n\n";
echo "Source: {$source}\n";
echo "Destination: {$dest}\n\n";

// Buat folder destination jika belum ada
if (!is_dir($dest)) {
    mkdir($dest, 0755, true);
    echo "Created destination folder.\n\n";
}

// Scan semua file di source
$files = scandir($source);
$copied = 0;
$skipped = 0;
$total = 0;

foreach ($files as $file) {
    if ($file != '.' && $file != '..') {
        $total++;
        $src = $source . $file;
        $dst = $dest . $file;
        
        if (is_file($src)) {
            if (!file_exists($dst)) {
                if (copy($src, $dst)) {
                    echo "✓ Copied: {$file}\n";
                    $copied++;
                } else {
                    echo "✗ Failed: {$file}\n";
                }
            } else {
                $skipped++;
            }
        }
    }
}

echo "\n=== SUMMARY ===\n";
echo "Total files: {$total}\n";
echo "Copied: {$copied}\n";
echo "Skipped (already exists): {$skipped}\n";
echo "\nDone!\n";
