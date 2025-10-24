<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategori::create([
            'judul' => 'Informasi Terkini'
        ]);

        Kategori::create([
            'judul' => 'Galery Sekolah'
        ]);

        Kategori::create([
            'judul' => 'Agenda Sekolah'
        ]);
    }
}
