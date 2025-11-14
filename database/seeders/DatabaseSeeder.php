<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Uncomment this line to import data from SQL dump instead of default seeders
        // $this->call([ImportSqlDumpSeeder::class]);
        
        // Default seeders (comment out if using ImportSqlDumpSeeder)
        $this->call([
            PetugasSeeder::class,
            KategoriSeeder::class,
            PostSeeder::class,
            GaleriSeeder::class,
        ]);
    }
}
