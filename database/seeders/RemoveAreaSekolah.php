<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RemoveAreaSekolah extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nonaktifkan album Area Sekolah (ID 44)
        $updated = DB::table('galery')
            ->where('id', 44)
            ->update(['status' => 0]);

        $this->command->info("Album ID 44 (Area Sekolah) berhasil dinonaktifkan!");
        
        // Tampilkan album lingkungan sekolah yang masih aktif
        $this->command->info('\nAlbum lingkungan_sekolah yang masih aktif:');
        $activeAlbums = DB::table('galery')
            ->where('category', 'lingkungan_sekolah')
            ->where('status', 1)
            ->get(['id', 'judul']);
            
        foreach ($activeAlbums as $album) {
            $this->command->info("ID: {$album->id}, Judul: {$album->judul}");
        }
    }
}
