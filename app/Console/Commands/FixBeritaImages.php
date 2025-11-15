<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use App\Models\Foto;
use App\Models\Galery;

class FixBeritaImages extends Command
{
    protected $signature = 'berita:fix-images';
    protected $description = 'Memperbaiki gambar berita yang menggunakan placeholder-berita.jpg';

    public function handle()
    {
        $this->info("Memperbaiki gambar berita...\n");

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
                
                $this->info("✓ Created galeri and foto for: {$post->judul}");
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
                    
                    $this->info("✓ Created foto for: {$post->judul}");
                    $created++;
                } else {
                    // Update foto yang menggunakan placeholder-berita.jpg atau file tidak ada
                    foreach ($galery->fotos as $foto) {
                        $needsUpdate = false;
                        
                        // Cek jika menggunakan placeholder-berita.jpg
                        if ($foto->file === 'placeholder-berita.jpg') {
                            $needsUpdate = true;
                        } else {
                            // Cek jika file tidak ada
                            $fileExists = file_exists(public_path('images/galeri/' . $foto->file)) 
                                       || file_exists(public_path('images/' . $foto->file))
                                       || file_exists(storage_path('app/public/galeri/' . $foto->file));
                            
                            if (!$fileExists) {
                                $needsUpdate = true;
                            }
                        }
                        
                        if ($needsUpdate) {
                            $imageIndex = ($post->id - 1) % count($availableImages);
                            $imageToUse = $placeholderFile;
                            
                            if (file_exists(public_path('images/galeri/' . $availableImages[$imageIndex]))) {
                                $imageToUse = $availableImages[$imageIndex];
                            } elseif (file_exists(public_path('images/' . $placeholderFile))) {
                                $imageToUse = $placeholderFile;
                            }
                            
                            $foto->file = $imageToUse;
                            $foto->save();
                            
                            $this->info("✓ Updated foto for: {$post->judul} -> {$imageToUse}");
                            $updated++;
                        }
                    }
                }
            }
        }

        $this->info("\nSelesai!");
        $this->info("Created: {$created} foto");
        $this->info("Updated: {$updated} foto");

        return 0;
    }
}

