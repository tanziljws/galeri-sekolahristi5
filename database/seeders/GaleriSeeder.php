<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Galery;
use App\Models\Foto;
use App\Models\Post;
use App\Models\Petugas;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        // Get the Admin user
        $admin = Petugas::where('username', 'Admin')->first();
        
        if (!$admin) {
            echo "Admin user not found! Please run PetugasSeeder first.\n";
            return;
        }

        // Buat post untuk Upacara Bendera
        $postUpacara = Post::create([
            'judul' => 'Upacara Bendera Hari Senin SMKN 4 Bogor',
            'kategori_id' => 1, // Kategori pertama
            'isi' => 'Kegiatan upacara bendera rutin setiap hari Senin yang diikuti seluruh siswa dan guru SMK Negeri 4 Kota Bogor. Upacara ini bertujuan untuk menanamkan jiwa patriotisme dan nasionalisme.',
            'petugas_id' => $admin->id,
            'status' => 'Published'
        ]);

        // Galeri 1: Upacara Bendera
        $galery1 = Galery::create([
            'post_id' => $postUpacara->id,
            'position' => 1,
            'status' => 1
        ]);

        // Foto-foto Upacara Bendera
        Foto::create([
            'galery_id' => $galery1->id,
            'file' => 'upacara_bendera_1.jpg',
            'judul' => 'Upacara Bendera SMKN 4 Bogor'
        ]);

        Foto::create([
            'galery_id' => $galery1->id,
            'file' => 'upacara_bendera_2.jpg',
            'judul' => 'Petugas Upacara SMKN 4'
        ]);

        Foto::create([
            'galery_id' => $galery1->id,
            'file' => 'upacara_bendera_3.jpg',
            'judul' => 'Siswa Mengikuti Upacara'
        ]);

        // Buat post untuk Praktikum Bengkel
        $postPraktikum = Post::create([
            'judul' => 'Praktikum Bengkel SMKN 4 Bogor',
            'kategori_id' => 1,
            'isi' => 'Kegiatan praktikum di bengkel untuk siswa jurusan Teknik Kendaraan Ringan, Teknik Sepeda Motor, dan jurusan teknik lainnya. Siswa belajar langsung dengan peralatan modern.',
            'petugas_id' => $admin->id,
            'status' => 'Published'
        ]);

        // Galeri 2: Praktikum Bengkel
        $galery2 = Galery::create([
            'post_id' => $postPraktikum->id,
            'position' => 2,
            'status' => 1
        ]);

        // Foto-foto Praktikum Bengkel
        Foto::create([
            'galery_id' => $galery2->id,
            'file' => 'praktikum_bengkel_1.jpg',
            'judul' => 'Siswa Praktikum Mesin'
        ]);

        Foto::create([
            'galery_id' => $galery2->id,
            'file' => 'praktikum_bengkel_2.jpg',
            'judul' => 'Bengkel SMKN 4 Bogor'
        ]);

        Foto::create([
            'galery_id' => $galery2->id,
            'file' => 'praktikum_bengkel_3.jpg',
            'judul' => 'Praktikum Kendaraan'
        ]);

        Foto::create([
            'galery_id' => $galery2->id,
            'file' => 'praktikum_bengkel_4.jpg',
            'judul' => 'Alat Praktikum Modern'
        ]);

        // Buat post untuk Kunjungan Industri
        $postKunjungan = Post::create([
            'judul' => 'Kunjungan Industri SMKN 4 Bogor',
            'kategori_id' => 1,
            'isi' => 'Program kunjungan industri ke perusahaan-perusahaan besar untuk memberikan wawasan dunia kerja yang sebenarnya kepada siswa SMKN 4 Bogor.',
            'petugas_id' => $admin->id,
            'status' => 'Published'
        ]);

        // Galeri 3: Kunjungan Industri
        $galery3 = Galery::create([
            'post_id' => $postKunjungan->id,
            'position' => 3,
            'status' => 1
        ]);

        // Foto-foto Kunjungan Industri
        Foto::create([
            'galery_id' => $galery3->id,
            'file' => 'kunjungan_industri_1.jpg',
            'judul' => 'Kunjungan ke Pabrik'
        ]);

        Foto::create([
            'galery_id' => $galery3->id,
            'file' => 'kunjungan_industri_2.jpg',
            'judul' => 'Siswa di Perusahaan'
        ]);

        Foto::create([
            'galery_id' => $galery3->id,
            'file' => 'kunjungan_industri_3.jpg',
            'judul' => 'Belajar di Industri'
        ]);

        // Buat post untuk Ekstrakurikuler
        $postEkskul = Post::create([
            'judul' => 'Kegiatan Ekstrakurikuler SMKN 4 Bogor',
            'kategori_id' => 1,
            'isi' => 'Berbagai kegiatan ekstrakurikuler yang diikuti siswa SMKN 4 Bogor seperti Pramuka, PMR, Paskibra, dan kegiatan lainnya untuk mengembangkan bakat dan minat siswa.',
            'petugas_id' => $admin->id,
            'status' => 'Published'
        ]);

        // Galeri 4: Ekstrakurikuler
        $galery4 = Galery::create([
            'post_id' => $postEkskul->id,
            'position' => 4,
            'status' => 1
        ]);

        // Foto-foto Ekstrakurikuler
        Foto::create([
            'galery_id' => $galery4->id,
            'file' => 'ekskul_pramuka_1.jpg',
            'judul' => 'Kegiatan Pramuka'
        ]);

        Foto::create([
            'galery_id' => $galery4->id,
            'file' => 'ekskul_paskibra_1.jpg',
            'judul' => 'Latihan Paskibra'
        ]);

        Foto::create([
            'galery_id' => $galery4->id,
            'file' => 'ekskul_pmr_1.jpg',
            'judul' => 'Kegiatan PMR'
        ]);

        Foto::create([
            'galery_id' => $galery4->id,
            'file' => 'ekskul_olahraga_1.jpg',
            'judul' => 'Ekstrakurikuler Olahraga'
        ]);

        // Buat post untuk Seminar dan Workshop
        $postSeminar = Post::create([
            'judul' => 'Seminar dan Workshop SMKN 4 Bogor',
            'kategori_id' => 1,
            'isi' => 'Berbagai kegiatan seminar, workshop, dan pelatihan yang diselenggarakan SMKN 4 Bogor untuk meningkatkan kompetensi siswa dan guru.',
            'petugas_id' => $admin->id,
            'status' => 'Published'
        ]);

        // Galeri 5: Seminar dan Workshop
        $galery5 = Galery::create([
            'post_id' => $postSeminar->id,
            'position' => 5,
            'status' => 1
        ]);

        // Foto-foto Seminar dan Workshop
        Foto::create([
            'galery_id' => $galery5->id,
            'file' => 'seminar_1.jpg',
            'judul' => 'Seminar Kewirausahaan'
        ]);

        Foto::create([
            'galery_id' => $galery5->id,
            'file' => 'workshop_1.jpg',
            'judul' => 'Workshop Teknologi'
        ]);

        Foto::create([
            'galery_id' => $galery5->id,
            'file' => 'pelatihan_1.jpg',
            'judul' => 'Pelatihan Guru'
        ]);

        // Buat post untuk Acara Perpisahan
        $postPerpisahan = Post::create([
            'judul' => 'Acara Perpisahan SMKN 4 Bogor',
            'kategori_id' => 1,
            'isi' => 'Momen spesial perpisahan siswa kelas XII yang telah menyelesaikan pendidikan di SMKN 4 Bogor. Acara yang penuh kenangan dan haru.',
            'petugas_id' => $admin->id,
            'status' => 'Published'
        ]);

        // Galeri 6: Acara Perpisahan
        $galery6 = Galery::create([
            'post_id' => $postPerpisahan->id,
            'position' => 6,
            'status' => 1
        ]);

        // Foto-foto Acara Perpisahan
        Foto::create([
            'galery_id' => $galery6->id,
            'file' => 'perpisahan_1.jpg',
            'judul' => 'Momen Perpisahan'
        ]);

        Foto::create([
            'galery_id' => $galery6->id,
            'file' => 'perpisahan_2.jpg',
            'judul' => 'Foto Bersama Alumni'
        ]);

        Foto::create([
            'galery_id' => $galery6->id,
            'file' => 'perpisahan_3.jpg',
            'judul' => 'Kenangan Terakhir'
        ]);

        echo "Seeder berhasil! Dibuat " . Galery::count() . " galeri dengan " . Foto::count() . " foto.\n";
    }
}
