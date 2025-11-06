<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FixKegiatanPembiasaanCategory extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ubah kategori album Kegiatan Pembiasaan kembali ke 'umum'
        $updated = DB::table('galery')
            ->where('judul', 'LIKE', '%Kegiatan Pembiasaan%')
            ->update(['category' => 'umum']);

        $this->command->info("Updated {$updated} album(s) - Kegiatan Pembiasaan category changed to 'umum'");
        
        // Tampilkan hasil
        $albums = DB::table('galery')
            ->where('judul', 'LIKE', '%Kegiatan Pembiasaan%')
            ->get(['id', 'judul', 'category']);
            
        foreach ($albums as $album) {
            $this->command->info("ID: {$album->id}, Judul: {$album->judul}, Category: {$album->category}");
        }
    }
}
