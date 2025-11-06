<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RemoveLabAlbums extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nonaktifkan album lab 4 PPLG (ID 41) dan Lab 1 TJKT (ID 42)
        $updated = DB::table('galery')
            ->whereIn('id', [41, 42])
            ->update(['status' => 0]);

        $this->command->info("Album ID 41 (lab 4 PPLG) dan ID 42 (Lab 1 TJKT) berhasil dinonaktifkan!");
        
        // Tampilkan album lingkungan sekolah yang masih aktif
        $this->command->info('\nAlbum lingkungan_sekolah yang masih aktif:');
        $activeAlbums = DB::table('galery')
            ->where('category', 'lingkungan_sekolah')
            ->where('status', 1)
            ->get(['id', 'judul']);
            
        if ($activeAlbums->count() > 0) {
            foreach ($activeAlbums as $album) {
                $this->command->info("ID: {$album->id}, Judul: {$album->judul}");
            }
        } else {
            $this->command->info("Tidak ada album lingkungan_sekolah yang aktif.");
        }
    }
}
