<?php
/**
 * Script untuk update foto background dengan foto siswa yang lebih bagus
 */

echo "=== UPDATE BACKGROUND PHOTO ===\n\n";

// Cari foto terbesar (biasanya kualitas terbaik)
$galeriPath = 'storage/app/public/galeri/';
$files = glob(__DIR__ . '/' . $galeriPath . '*.jpg');

if (empty($files)) {
    echo "❌ No photos found in gallery.\n";
    exit(1);
}

// Sort by file size (descending) - foto besar biasanya kualitas bagus
usort($files, function($a, $b) {
    return filesize($b) - filesize($a);
});

echo "Found " . count($files) . " photos in gallery.\n";
echo "Selecting best quality photo...\n\n";

// Ambil 3 foto terbesar dan tampilkan
echo "Top 3 largest photos:\n";
for ($i = 0; $i < min(3, count($files)); $i++) {
    $size = filesize($files[$i]);
    $sizeMB = round($size / 1024 / 1024, 2);
    echo ($i + 1) . ". " . basename($files[$i]) . " ({$sizeMB} MB)\n";
}

// Gunakan foto terbesar
$bestPhoto = $files[0];
$destination = 'public/images/siswa-background.jpg';
$fullDest = __DIR__ . '/' . $destination;

echo "\nCopying best photo to background...\n";
echo "Source: " . basename($bestPhoto) . "\n";
echo "Destination: {$destination}\n";

if (copy($bestPhoto, $fullDest)) {
    $size = filesize($fullDest);
    $sizeMB = round($size / 1024 / 1024, 2);
    echo "\n✅ Successfully copied!\n";
    echo "File size: {$sizeMB} MB\n";
    echo "\nBackground photo updated!\n";
    echo "Refresh your browser (Ctrl + F5) to see changes.\n";
} else {
    echo "\n❌ Failed to copy photo.\n";
}
