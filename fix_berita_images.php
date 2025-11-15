<?php

/**
 * Script untuk memperbaiki gambar berita yang menggunakan placeholder-berita.jpg
 * Menjadi menggunakan gambar yang tersedia atau placeholder.jpg
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Post;
use App\Models\Foto;
use App\Models\Galery;

echo "Memperbaiki gambar berita...\n\n";

// Daftar gambar yang tersedia
$availableImages = ['upacara_bendera_1.jpg', 'p5.JPG', 'IMG_0167.JPG', 'sidang pkl.JPG'];
$placeholderFile = 'placeholder.jpg';

// Ambil semua post yang published
$posts = Post::where('status', 'Published')
    ->where('isi', 'not like', 'Album foto:%')
    ->with(['galeries.fotos'])
    ->get();

$updated = 0;
$created = 0;

foreach ($posts as $post) {
    // Cek apakah post punya galeri
    if (!$post->galeries || $post->galeries->isEmpty()) {
        // Buat galeri baru
        $galery = Galery::create([
            'post_id' => $post->id,
            'judul' => $post->judul,
            'position' => 0,
            'status' => 1,
            'category' => 'berita',
            'created_at' => $post->created_at,
            'updated_at' => $post->updated_at,
        ]);
        
        // Pilih gambar untuk digunakan
        $imageIndex = ($post->id - 1) % count($availableImages);
        $imageToUse = $placeholderFile;
        
        if (file_exists(public_path('images/galeri/' . $availableImages[$imageIndex]))) {
            $imageToUse = $availableImages[$imageIndex];
        } elseif (file_exists(public_path('images/' . $placeholderFile))) {
            $imageToUse = $placeholderFile;
        }
        
        Foto::create([
            'galery_id' => $galery->id,
            'file' => $imageToUse,
            'judul' => $post->judul . ' - Foto 1',
            'created_at' => $post->created_at,
            'updated_at' => $post->updated_at,
        ]);
        
        echo "✓ Created galeri and foto for: {$post->judul}\n";
        $created++;
        continue;
    }
    
    // Cek setiap galeri
    foreach ($post->galeries as $galery) {
        if (!$galery->fotos || $galery->fotos->isEmpty()) {
            // Buat foto baru
            $imageIndex = ($post->id - 1) % count($availableImages);
            $imageToUse = $placeholderFile;
            
            if (file_exists(public_path('images/galeri/' . $availableImages[$imageIndex]))) {
                $imageToUse = $availableImages[$imageIndex];
            } elseif (file_exists(public_path('images/' . $placeholderFile))) {
                $imageToUse = $placeholderFile;
            }
            
            Foto::create([
                'galery_id' => $galery->id,
                'file' => $imageToUse,
                'judul' => $post->judul . ' - Foto 1',
                'created_at' => $post->created_at,
                'updated_at' => $post->updated_at,
            ]);
            
            echo "✓ Created foto for: {$post->judul}\n";
            $created++;
        } else {
            // Update foto yang menggunakan placeholder-berita.jpg
            foreach ($galery->fotos as $foto) {
                if ($foto->file === 'placeholder-berita.jpg' || !file_exists(public_path('images/galeri/' . $foto->file)) && !file_exists(public_path('images/' . $foto->file))) {
                    $imageIndex = ($post->id - 1) % count($availableImages);
                    $imageToUse = $placeholderFile;
                    
                    if (file_exists(public_path('images/galeri/' . $availableImages[$imageIndex]))) {
                        $imageToUse = $availableImages[$imageIndex];
                    } elseif (file_exists(public_path('images/' . $placeholderFile))) {
                        $imageToUse = $placeholderFile;
                    }
                    
                    $foto->file = $imageToUse;
                    $foto->save();
                    
                    echo "✓ Updated foto for: {$post->judul} -> {$imageToUse}\n";
                    $updated++;
                }
            }
        }
    }
}

echo "\n";
echo "Selesai!\n";
echo "Created: {$created} foto\n";
echo "Updated: {$updated} foto\n";

