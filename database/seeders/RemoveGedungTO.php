<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RemoveGedungTO extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tampilkan album gedung TO
        $this->command->info('Album gedung TO yang ditemukan:');
        $albums = DB::table('galery')
            ->where('judul', 'LIKE', '%gedung TO%')
            ->orWhere('judul', 'LIKE', '%gedung to%')
            ->get(['id', 'judul', 'category', 'status']);
            
        foreach ($albums as $album) {
            $this->command->info("ID: {$album->id}, Judul: {$album->judul}, Category: {$album->category}, Status: {$album->status}");
        }
        
        // Nonaktifkan album gedung TO (ID 29)
        $updated = DB::table('galery')
            ->where('id', 29)
            ->update(['status' => 0]);

        $this->command->info("\nAlbum ID 29 (gedung TO) berhasil dinonaktifkan!");
        
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
