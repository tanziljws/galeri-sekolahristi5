<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Petugas;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Petugas::create([
            'username' => 'Admin',
            'password' => Hash::make('123'),
            'email' => 'admin@smkn4bogor.sch.id'
        ]);

        Petugas::create([
            'username' => 'user',
            'password' => Hash::make('12345'),
            'email' => 'user@gmail.com'
        ]);
    }
}
