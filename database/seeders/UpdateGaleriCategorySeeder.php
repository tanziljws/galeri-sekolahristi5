<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateGaleriCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update kategori untuk album-album lingkungan sekolah
        $lingkunganSekolahAlbums = [
            'Lab 4 PPLG',
            'Lab 1 TJKT',
            'Gedung Utama To',
            'Gedung TO',
            'Area Sekolah',
            'Lingkungan Sekolah',
        ];

        foreach ($lingkunganSekolahAlbums as $albumTitle) {
            DB::table('galery')
                ->where('judul', 'LIKE', '%' . $albumTitle . '%')
                ->update(['category' => 'lingkungan_sekolah']);
        }

        $this->command->info('Kategori galeri berhasil diupdate!');
        
        // Tampilkan hasil update
        $updated = DB::table('galery')
            ->where('category', 'lingkungan_sekolah')
            ->get(['id', 'judul', 'category']);
            
        $this->command->info('Album dengan kategori lingkungan_sekolah:');
        foreach ($updated as $galery) {
            $this->command->info("- ID: {$galery->id}, Judul: {$galery->judul}");
        }
    }
}
