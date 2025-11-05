<?php
/**
 * Script untuk update category galeri berita dari 'umum' ke 'berita'
 */

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== UPDATE GALERI BERITA CATEGORY ===\n\n";

// Update galeri yang punya post_id (berita) dari 'umum' ke 'berita'
$updated = DB::table('galery')
    ->where('category', 'umum')
    ->whereNotNull('post_id')
    ->update(['category' => 'berita']);

echo "Updated {$updated} galeri berita\n";

// Tampilkan hasil
$beritaGaleries = DB::table('galery')
    ->where('category', 'berita')
    ->get(['id', 'judul', 'post_id', 'category']);

echo "\nGaleri dengan category 'berita':\n";
foreach ($beritaGaleries as $galery) {
    echo "- ID: {$galery->id} | Judul: {$galery->judul} | Post ID: {$galery->post_id}\n";
}

echo "\nDone!\n";
