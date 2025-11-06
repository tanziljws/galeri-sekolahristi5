<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RemoveDuplicateLab4PPLG extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tampilkan semua album lab 4 pplg
        $this->command->info('Album lab 4 pplg yang ditemukan:');
        $albums = DB::table('galery')
            ->where('judul', 'LIKE', '%lab 4 pplg%')
            ->orWhere('judul', 'LIKE', '%lab 4 PPLG%')
            ->get(['id', 'judul', 'category', 'status']);
            
        foreach ($albums as $album) {
            $this->command->info("ID: {$album->id}, Judul: {$album->judul}, Category: {$album->category}, Status: {$album->status}");
        }
        
        // Nonaktifkan album dengan ID 28 (lab 4 pplg huruf kecil)
        $updated = DB::table('galery')
            ->where('id', 28)
            ->update(['status' => 0]);

        $this->command->info("\nAlbum ID 28 (lab 4 pplg) berhasil dinonaktifkan!");
        
        // Tampilkan hasil setelah update
        $this->command->info('\nAlbum lab 4 yang masih aktif:');
        $activeAlbums = DB::table('galery')
            ->where(function($query) {
                $query->where('judul', 'LIKE', '%lab 4 pplg%')
                      ->orWhere('judul', 'LIKE', '%lab 4 PPLG%');
            })
            ->where('status', 1)
            ->get(['id', 'judul', 'category', 'status']);
            
        foreach ($activeAlbums as $album) {
            $this->command->info("ID: {$album->id}, Judul: {$album->judul}, Category: {$album->category}");
        }
    }
}
