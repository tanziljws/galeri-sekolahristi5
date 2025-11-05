<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Galery;
use App\Models\Foto;

echo "=== CEK ALBUM SENAM ===\n\n";

$galery = Galery::where('judul', 'LIKE', '%Senam%')->first();

if ($galery) {
    echo "Album ditemukan:\n";
    echo "ID: {$galery->id}\n";
    echo "Judul: {$galery->judul}\n";
    echo "Kategori: {$galery->category}\n";
    echo "Status: {$galery->status}\n";
    echo "Jumlah foto: " . $galery->fotos()->count() . "\n\n";
    
    if ($galery->fotos()->count() > 0) {
        echo "Daftar foto:\n";
        foreach ($galery->fotos as $foto) {
            $filePath = storage_path('app/public/galeri/' . $foto->file);
            $exists = file_exists($filePath) ? 'ADA' : 'TIDAK ADA';
            echo "- {$foto->file} [{$exists}]\n";
            echo "  Judul: {$foto->judul}\n";
        }
    } else {
        echo "Tidak ada foto di album ini.\n";
    }
} else {
    echo "Album 'Senam' tidak ditemukan.\n\n";
    echo "Daftar semua album:\n";
    $allGaleries = Galery::all();
    foreach ($allGaleries as $g) {
        echo "- {$g->judul} (ID: {$g->id}, Foto: {$g->fotos()->count()})\n";
    }
}
