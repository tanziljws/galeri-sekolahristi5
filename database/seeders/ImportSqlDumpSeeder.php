<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Kategori;
use App\Models\Petugas;
use App\Models\Post;
use App\Models\Galery;
use App\Models\Foto;
use App\Models\User;
use App\Models\Message;
use App\Models\PhotoInteraction;
use App\Models\PhotoComment;
use App\Models\Berita;
use Carbon\Carbon;

class ImportSqlDumpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * This seeder imports data from the SQL dump file.
     * Compatible with both MySQL and SQLite.
     */
    public function run(): void
    {
        $driver = DB::getDriverName();
        
        $this->command->info("Importing data from SQL dump (Driver: {$driver})...");
        
        // Import in correct order (respecting foreign keys)
        $this->seedKategori();
        $this->seedPetugas();
        $this->seedUsers();
        $this->seedPosts();
        $this->seedBerita(); // Seed tabel berita dari posts
        $this->seedGalery();
        $this->seedFoto();
        $this->seedMessages();
        $this->seedPhotoInteractions();
        $this->seedPhotoComments();
        
        // Update SQLite sequences to prevent ID conflicts
        if ($driver === 'sqlite') {
            $this->updateSqliteSequences();
        }
        
        $this->command->info("✅ Data import completed!");
    }
    
    /**
     * Update SQLite sequences after manual ID insertion
     */
    private function updateSqliteSequences(): void
    {
        $this->command->info("Updating SQLite sequences...");
        
        $tables = [
            'kategori' => 7,
            'petugas' => 3,
            'users' => 7,
            'posts' => 8,
            'galery' => 46,
            'foto' => 48,
            'messages' => 3,
            'photo_interactions' => 70,
            'photo_comments' => 5,
        ];
        
        foreach ($tables as $table => $maxId) {
            try {
                DB::statement("UPDATE sqlite_sequence SET seq = {$maxId} WHERE name = '{$table}'");
            } catch (\Exception $e) {
                // Ignore if sequence doesn't exist
            }
        }
    }
    
    private function seedKategori(): void
    {
        $this->command->info("Importing kategori...");
        
        $kategoris = [
            ['id' => 1, 'judul' => 'Prestasi Siswa/Siswi'],
            ['id' => 2, 'judul' => 'Galeri Sekolah'],
            ['id' => 3, 'judul' => 'Transforkrab'],
            ['id' => 4, 'judul' => 'Ekstrakurikuler'],
            ['id' => 5, 'judul' => 'Kegiatan Sekolah'],
            ['id' => 6, 'judul' => 'Lingkungan Sekolah'],
        ];
        
        foreach ($kategoris as $kategori) {
            Kategori::updateOrCreate(
                ['id' => $kategori['id']],
                [
                    'judul' => $kategori['judul'],
                    'created_at' => Carbon::parse('2025-10-27 20:04:28'),
                    'updated_at' => Carbon::parse('2025-10-27 20:04:28'),
                ]
            );
        }
    }
    
    private function seedPetugas(): void
    {
        $this->command->info("Importing petugas...");
        
        $petugas = [
            [
                'id' => 1,
                'username' => 'admin2@gmail.com',
                'email' => 'admin2@gmail.com',
                'password' => '$2y$12$E7tm.B2avWBXwTnm4FArsuKKJURAtc7B5gqizh05QoDQph4dw9D3q',
                'created_at' => Carbon::parse('2025-10-27 20:00:00'),
                'updated_at' => Carbon::parse('2025-10-27 20:00:00'),
            ],
            [
                'id' => 2,
                'username' => 'risti',
                'email' => 'ristirahma807@gmail.com',
                'password' => '$2y$10$DqwH9aFZJWKl3KkE92cJxuPA4os6zGhe/UReicQFinf8BbxGQ9Z5O',
                'created_at' => Carbon::parse('2025-11-09 21:35:02'),
                'updated_at' => Carbon::parse('2025-11-09 21:35:02'),
            ],
        ];
        
        foreach ($petugas as $p) {
            Petugas::updateOrCreate(
                ['id' => $p['id']],
                $p
            );
        }
    }
    
    private function seedUsers(): void
    {
        $this->command->info("Importing users...");
        
        $users = [
            [
                'id' => 1,
                'name' => 'risti',
                'email' => 'ristirahma82@gmail.com',
                'password' => '$2y$12$j2o/YFnfSbtiHhtoScWNsuPeJVMxayhccrd.yXBsC5Hf3CJnvIpGG',
                'created_at' => Carbon::parse('2025-10-27 19:57:59'),
                'updated_at' => Carbon::parse('2025-11-09 22:34:21'),
            ],
            [
                'id' => 2,
                'name' => 'risti',
                'email' => 'ristirahma807@gmail.com',
                'password' => '$2y$12$CqezH9pEcgjvtf8/ZAT6su9fSLRCrbgnCEkUYnLb7UeDgezz/No/K',
                'created_at' => Carbon::parse('2025-10-28 01:54:14'),
                'updated_at' => Carbon::parse('2025-10-28 01:54:14'),
            ],
            [
                'id' => 3,
                'name' => 'risti',
                'email' => 'ristirahma@gmail.com',
                'password' => '$2y$12$4IpSTzH2cHBMd35dODKdMueygIKo.uDnHipswslVnlDCHzShZfdaO',
                'created_at' => Carbon::parse('2025-10-28 01:54:40'),
                'updated_at' => Carbon::parse('2025-10-28 01:54:40'),
            ],
            [
                'id' => 4,
                'name' => 'risti',
                'email' => 'risti123@gmail.com',
                'password' => '$2y$12$GlpiH/0c5PzjZwYRS6PuYO9Fv0r1CmPGRi7rcEzmDIhSrzsX9czki',
                'created_at' => Carbon::parse('2025-11-05 03:03:06'),
                'updated_at' => Carbon::parse('2025-11-05 03:03:06'),
            ],
            [
                'id' => 5,
                'name' => 'nadylene',
                'email' => 'nadylene14@gmail.com',
                'password' => '$2y$12$iW267VkH/iY.BIsOzs3.bu89WVgQw4VJrnil/X30b3L2M/9ogoJ42',
                'created_at' => Carbon::parse('2025-11-09 18:15:41'),
                'updated_at' => Carbon::parse('2025-11-09 18:15:41'),
            ],
            [
                'id' => 6,
                'name' => 'risti',
                'email' => 'ristirahma8@gmail.com',
                'password' => '$2y$12$nr/17g1n9Tft2jeXNTs2Buk8sIe1nz8TbPMYvcev2mHlybLaY16gu',
                'created_at' => Carbon::parse('2025-11-09 21:53:24'),
                'updated_at' => Carbon::parse('2025-11-09 21:53:24'),
            ],
        ];
        
        foreach ($users as $user) {
            User::updateOrCreate(
                ['id' => $user['id']],
                $user
            );
        }
    }
    
    private function seedPosts(): void
    {
        $this->command->info("Importing posts...");
        
        // Get kategori IDs dynamically - use existing kategori from seeder
        $kategoriGalery = Kategori::where('judul', 'Galeri Sekolah')->first();
        $kategoriKegiatan = Kategori::where('judul', 'Kegiatan Sekolah')->first();
        $kategoriPrestasi = Kategori::where('judul', 'Prestasi Siswa/Siswi')->first();
        
        // Use existing kategori IDs or fallback to IDs from SQL dump
        // Kategori yang ada: 1=Prestasi, 2=Galeri Sekolah, 3=Transforkrab, 4=Ekstrakurikuler, 5=Kegiatan Sekolah, 6=Lingkungan Sekolah
        $kategoriInfoId = $kategoriKegiatan ? $kategoriKegiatan->id : 5; // Use Kegiatan Sekolah for info
        $kategoriGaleryId = $kategoriGalery ? $kategoriGalery->id : 2;
        $kategoriAgendaId = $kategoriKegiatan ? $kategoriKegiatan->id : 5; // Use Kegiatan Sekolah for agenda
        $kategoriPengumumanId = $kategoriKegiatan ? $kategoriKegiatan->id : 5; // Use Kegiatan Sekolah for pengumuman
        
        $posts = [
            [
                'id' => 1,
                'judul' => 'TKA ( Tes Kemampuan Akademik )',
                'kategori_id' => $kategoriInfoId,
                'isi' => 'yang akan dilaksanakan di Lab SMK Negeri 4 Bogor Pada Hari Senin, 03 November 2025',
                'petugas_id' => 1,
                'status' => 'Published',
                'tanggal_jadwal' => '2025-11-06',
                'created_at' => Carbon::parse('2025-10-28 02:19:42'),
                'updated_at' => Carbon::parse('2025-11-05 03:28:45'),
            ],
            [
                'id' => 2,
                'judul' => 'SMKN 4 Bogor Siap Laksanakan Uji Kompetensi Keahlian (Ujikom) Tahun 2025',
                'kategori_id' => $kategoriAgendaId,
                'isi' => "SMKN 4 Bogor tengah bersiap menyelenggarakan Uji Kompetensi Keahlian (Ujikom) bagi siswa kelas XII yang akan dilaksanakan pada Senin, 17 November 2025.\r\nKegiatan ini menjadi ajang penting bagi siswa untuk menunjukkan kemampuan dan keterampilan mereka sesuai dengan bidang keahlian yang telah dipelajari selama tiga tahun.",
                'petugas_id' => 1,
                'status' => 'Published',
                'tanggal_jadwal' => '2025-11-18',
                'created_at' => Carbon::parse('2025-10-28 05:58:38'),
                'updated_at' => Carbon::parse('2025-11-05 03:28:17'),
            ],
            [
                'id' => 3,
                'judul' => 'Jadwal Ujian Semester Genap 2025',
                'kategori_id' => $kategoriInfoId,
                'isi' => "Berikut adalah jadwal ujian semester genap tahun ajaran 2024/2025 untuk semua jurusan:

Senin, 20 Mei 2025:
- 07:00 - 09:00: Matematika
- 10:00 - 12:00: Bahasa Indonesia

Selasa, 21 Mei 2025:
- 07:00 - 09:00: Bahasa Inggris
- 10:00 - 12:00: PPKN

Rabu, 22 Mei 2025:
- 07:00 - 09:00: Fisika/Kimia (sesuai jurusan)
- 10:00 - 12:00: Sejarah

Kamis, 23 Mei 2025:
- 07:00 - 09:00: Mata Pelajaran Kejuruan
- 10:00 - 12:00: Mata Pelajaran Kejuruan

Jumat, 24 Mei 2025:
- 07:00 - 09:00: Mata Pelajaran Kejuruan
- 10:00 - 12:00: Mata Pelajaran Kejuruan

Catatan:
- Siswa wajib hadir 30 menit sebelum ujian dimulai
- Membawa alat tulis dan kartu ujian
- Dilarang membawa HP ke ruang ujian
- Pakaian seragam sekolah lengkap",
                'petugas_id' => 1,
                'status' => 'Published',
                'tanggal_jadwal' => '2025-05-20',
                'created_at' => Carbon::parse('2025-10-15 10:00:00'),
                'updated_at' => Carbon::parse('2025-10-15 10:00:00'),
            ],
            [
                'id' => 4,
                'judul' => 'Pengumuman Penerimaan Siswa Baru 2025/2026',
                'kategori_id' => $kategoriPengumumanId,
                'isi' => "SMK Negeri 4 Kota Bogor membuka pendaftaran siswa baru untuk tahun ajaran 2025/2026.

JURUSAN YANG DIBUKA:
1. Teknik Kendaraan Ringan Otomotif (TKRO)
2. Teknik dan Bisnis Sepeda Motor (TBSM)
3. Teknik Komputer dan Jaringan (TKJ)
4. Rekayasa Perangkat Lunak (RPL)
5. Akuntansi dan Keuangan Lembaga (AKL)
6. Otomatisasi dan Tata Kelola Perkantoran (OTKP)

PERSYARATAN PENDAFTARAN:
- Lulusan SMP/MTs tahun 2025 atau sebelumnya
- Usia maksimal 21 tahun pada 1 Juli 2025
- Membawa fotokopi ijazah/surat keterangan lulus
- Membawa fotokopi akta kelahiran
- Membawa fotokopi KK
- Membawa pas foto 3x4 (3 lembar)

JADWAL PENDAFTARAN:
- Gelombang 1: 1-15 Februari 2025
- Gelombang 2: 16-28 Februari 2025
- Gelombang 3: 1-15 Maret 2025

BIAYA PENDAFTARAN:
- Uang pendaftaran: Rp 200.000
- Uang gedung: Rp 1.500.000
- SPP bulanan: Rp 150.000

Untuk informasi lebih lanjut, silakan hubungi panitia PPDB di sekolah atau melalui website resmi sekolah.",
                'petugas_id' => 1,
                'status' => 'Published',
                'tanggal_jadwal' => '2025-02-01',
                'created_at' => Carbon::parse('2025-10-20 09:00:00'),
                'updated_at' => Carbon::parse('2025-10-20 09:00:00'),
            ],
            [
                'id' => 5,
                'judul' => 'Kunjungan Industri ke PT Astra Honda Motor',
                'kategori_id' => $kategoriGaleryId,
                'isi' => "Pada tanggal 15 Maret 2025, siswa kelas XI jurusan Teknik Kendaraan Ringan Otomotif (TKRO) dan Teknik dan Bisnis Sepeda Motor (TBSM) melakukan kunjungan industri ke PT Astra Honda Motor di Karawang, Jawa Barat.

KUNJUNGAN INI BERTUJUAN UNTUK:
- Memperluas wawasan siswa tentang dunia industri otomotif
- Melihat langsung proses produksi sepeda motor Honda
- Memahami standar kerja di industri otomotif
- Menambah pengetahuan tentang teknologi terbaru

AKTIVITAS SELAMA KUNJUNGAN:
1. Presentasi tentang profil perusahaan
2. Tour ke area produksi
3. Demonstrasi teknologi terbaru
4. Tanya jawab dengan tim produksi
5. Foto bersama di area pabrik

Siswa sangat antusias mengikuti kegiatan ini dan mendapatkan pengalaman berharga tentang dunia kerja yang sesungguhnya. Kunjungan ini merupakan bagian dari program prakerin (praktik kerja industri) yang akan dilaksanakan pada semester berikutnya.

Terima kasih kepada PT Astra Honda Motor yang telah memberikan kesempatan kepada siswa SMK Negeri 4 Kota Bogor untuk melakukan kunjungan industri.",
                'petugas_id' => 1,
                'status' => 'Published',
                'tanggal_jadwal' => '2025-03-15',
                'created_at' => Carbon::parse('2025-10-25 14:00:00'),
                'updated_at' => Carbon::parse('2025-10-25 14:00:00'),
            ],
            [
                'id' => 6,
                'judul' => 'Peringatan Hari Kemerdekaan RI ke-80',
                'kategori_id' => $kategoriAgendaId,
                'isi' => "SMK Negeri 4 Kota Bogor akan mengadakan berbagai kegiatan dalam rangka memperingati Hari Kemerdekaan Republik Indonesia ke-80.

JADWAL KEGIATAN:

17 Agustus 2025:
- 07:00: Upacara Bendera di lapangan sekolah
- 08:30: Pembacaan teks proklamasi
- 09:00: Doa bersama untuk bangsa dan negara

18-20 Agustus 2025:
- Lomba-lomba antar kelas:
  * Tarik tambang
  * Balap karung
  * Makan kerupuk
  * Memasukkan paku ke dalam botol
  * Estafet air
  * Balap bakiak

21 Agustus 2025:
- Pentas seni dan budaya
- Pameran hasil karya siswa
- Bazar makanan tradisional

22 Agustus 2025:
- Upacara penutupan
- Pembagian hadiah pemenang lomba
- Pembagian bingkisan untuk guru dan karyawan

TEMA KEGIATAN:
'Bersatu Membangun Negeri, Maju Bersama SMK'

Semua siswa wajib mengikuti kegiatan ini dengan pakaian seragam merah putih. Kegiatan ini bertujuan untuk menumbuhkan semangat nasionalisme dan persatuan bangsa.",
                'petugas_id' => 1,
                'status' => 'Published',
                'tanggal_jadwal' => '2025-08-17',
                'created_at' => Carbon::parse('2025-10-30 11:00:00'),
                'updated_at' => Carbon::parse('2025-10-30 11:00:00'),
            ],
            [
                'id' => 7,
                'judul' => 'Praktikum Teknik Kendaraan Ringan',
                'kategori_id' => $kategoriGaleryId,
                'isi' => "Siswa kelas XII jurusan Teknik Kendaraan Ringan Otomotif (TKRO) sedang melakukan praktikum servis mesin sepeda motor di bengkel sekolah.

PRAKTIKUM INI MELIPUTI:
- Pemeriksaan dan perawatan mesin
- Tune up mesin sepeda motor
- Perbaikan sistem kelistrikan
- Servis sistem rem
- Perbaikan sistem suspensi

FASILITAS BENGKEL SEKOLAH:
- 10 unit sepeda motor untuk praktikum
- Peralatan servis lengkap
- Alat ukur dan diagnostic tools
- Ruang praktikum yang luas dan nyaman
- Guru pembimbing yang berpengalaman

Siswa dibagi menjadi beberapa kelompok dan setiap kelompok mendapat bimbingan langsung dari guru pembimbing. Praktikum ini bertujuan untuk mempersiapkan siswa menghadapi ujian kompetensi keahlian dan dunia kerja.

Hasil praktikum akan dinilai berdasarkan:
- Ketepatan dalam melakukan servis
- Waktu pengerjaan
- Kebersihan dan kerapian kerja
- Laporan praktikum",
                'petugas_id' => 1,
                'status' => 'Published',
                'created_at' => Carbon::parse('2025-11-01 08:00:00'),
                'updated_at' => Carbon::parse('2025-11-01 08:00:00'),
            ],
            [
                'id' => 8,
                'judul' => 'Workshop Teknologi Informasi untuk Guru',
                'kategori_id' => $kategoriInfoId,
                'isi' => "SMK Negeri 4 Kota Bogor mengadakan workshop teknologi informasi untuk seluruh guru pada tanggal 25 November 2025.

WORKSHOP INI MEMBAHAS:
- Penggunaan platform pembelajaran digital
- Teknik membuat konten pembelajaran interaktif
- Manajemen kelas online
- Evaluasi pembelajaran berbasis digital
- Integrasi teknologi dalam kurikulum

PEMATERI:
- Dr. Ahmad Fauzi, M.Kom (Pakar Teknologi Pendidikan)
- Dra. Siti Nurhaliza, M.Pd (Praktisi E-Learning)

TUJUAN WORKSHOP:
- Meningkatkan kompetensi guru dalam penggunaan teknologi
- Memperkaya metode pembelajaran
- Meningkatkan kualitas pendidikan di sekolah

Semua guru diwajibkan mengikuti workshop ini. Workshop akan dilaksanakan di ruang multimedia sekolah mulai pukul 08:00 - 16:00 WIB.",
                'petugas_id' => 1,
                'status' => 'Published',
                'tanggal_jadwal' => '2025-11-25',
                'created_at' => Carbon::parse('2025-11-05 10:00:00'),
                'updated_at' => Carbon::parse('2025-11-05 10:00:00'),
            ],
        ];
        
        foreach ($posts as $post) {
            $createdPost = Post::updateOrCreate(
                ['id' => $post['id']],
                $post
            );
            
            // Buat galeri untuk setiap post jika belum ada
            if (!$createdPost->galeries()->exists()) {
                $galery = Galery::create([
                    'post_id' => $createdPost->id,
                    'judul' => $createdPost->judul,
                    'position' => 0,
                    'status' => 1,
                    'category' => 'berita',
                    'created_at' => $createdPost->created_at,
                    'updated_at' => $createdPost->updated_at,
                ]);
                
                // Tambahkan foto placeholder untuk setiap galeri
                // Gunakan placeholder.jpg yang sudah ada, atau gunakan gambar dari galeri jika ada
                $placeholderFile = 'placeholder.jpg';
                
                // Cek apakah ada gambar di galeri yang bisa digunakan
                $availableImages = ['upacara_bendera_1.jpg', 'p5.JPG', 'IMG_0167.JPG', 'sidang pkl.JPG'];
                $imageToUse = $placeholderFile; // Default ke placeholder
                
                // Gunakan gambar yang berbeda untuk setiap berita (rotasi)
                $imageIndex = ($createdPost->id - 1) % count($availableImages);
                if (file_exists(public_path('images/galeri/' . $availableImages[$imageIndex]))) {
                    $imageToUse = $availableImages[$imageIndex];
                } elseif (file_exists(public_path('images/' . $placeholderFile))) {
                    $imageToUse = $placeholderFile;
                }
                
                Foto::create([
                    'galery_id' => $galery->id,
                    'file' => $imageToUse,
                    'judul' => $createdPost->judul . ' - Foto 1',
                    'created_at' => $createdPost->created_at,
                    'updated_at' => $createdPost->updated_at,
                ]);
            }
        }
    }
    
    private function seedBerita(): void
    {
        $this->command->info("Importing berita...");
        
        // Copy data dari posts ke tabel berita jika tabel berita ada
        if (Schema::hasTable('berita')) {
            // Get all published posts
            $posts = Post::where('status', 'Published')->get();
            
            foreach ($posts as $post) {
                // Check if berita already exists
                $existingBerita = DB::table('berita')->where('id', $post->id)->first();
                
                if (!$existingBerita) {
                    // Insert into berita table
                    // Note: Tabel berita hanya punya id, created_at, updated_at
                    // Jadi kita hanya insert id dan timestamps
                    DB::table('berita')->insert([
                        'id' => $post->id,
                        'created_at' => $post->created_at,
                        'updated_at' => $post->updated_at,
                    ]);
                }
            }
        }
    }
    
    private function seedGalery(): void
    {
        $this->command->info("Importing galery...");
        
        $galeries = [
            ['id' => 1, 'post_id' => null, 'judul' => 'Upacara', 'position' => 1, 'status' => 1, 'category' => 'upacara', 'created_at' => '2025-10-27 20:31:26', 'updated_at' => '2025-11-06 05:53:12'],
            ['id' => 2, 'post_id' => null, 'judul' => 'Senam', 'position' => 1, 'status' => 1, 'category' => 'p5', 'created_at' => '2025-10-27 21:23:37', 'updated_at' => '2025-10-27 21:23:37'],
            ['id' => 3, 'post_id' => null, 'judul' => 'Las', 'position' => 1, 'status' => 1, 'category' => 'tpfl', 'created_at' => '2025-10-28 01:58:12', 'updated_at' => '2025-10-28 01:58:12'],
            ['id' => 4, 'post_id' => 1, 'judul' => 'TKA ( Tes Kemampuan Akademik )', 'position' => 0, 'status' => 1, 'category' => 'berita', 'created_at' => '2025-10-28 02:32:58', 'updated_at' => '2025-10-28 02:32:58'],
            ['id' => 5, 'post_id' => null, 'judul' => 'pencapaian prestasi yang telah di raih Juara 3 Bogor Innovation Award 2025 Bidang Teknologi Informasi dan Komunikasi', 'position' => 1, 'status' => 1, 'category' => 'prestasi', 'created_at' => '2025-10-28 02:48:04', 'updated_at' => '2025-10-28 02:48:04'],
            ['id' => 6, 'post_id' => null, 'judul' => 'Kegiatan Pentas Seni SMK Negeri 4 Bogor yang Menampilkan Penampilan dari DJ Mail', 'position' => 1, 'status' => 1, 'category' => 'neospragma', 'created_at' => '2025-10-28 04:00:37', 'updated_at' => '2025-10-28 04:00:37'],
            ['id' => 7, 'post_id' => null, 'judul' => 'Kegiatan Peringatan Maulid Nabi Muhammad SAW', 'position' => 1, 'status' => 1, 'category' => 'umum', 'created_at' => '2025-10-28 04:03:13', 'updated_at' => '2025-10-28 04:03:13'],
            ['id' => 8, 'post_id' => null, 'judul' => 'Kegiatan Peringatan Maulid Nabi Muhammad SAW ang dihadiri Oleh Ustadz Abi Azkakia Sebagai Penceramah.', 'position' => 1, 'status' => 1, 'category' => 'maulid-nabi', 'created_at' => '2025-10-28 04:04:05', 'updated_at' => '2025-10-28 04:04:05'],
            ['id' => 9, 'post_id' => null, 'judul' => 'Kegiatan Upacara Pengibaran Bendera Merah Putih dalam rangka HUT RI ke-80.', 'position' => 1, 'status' => 1, 'category' => 'upacara', 'created_at' => '2025-10-28 04:06:45', 'updated_at' => '2025-10-28 04:06:45'],
            ['id' => 10, 'post_id' => null, 'judul' => 'Kegiatan Pelaksanaan P5 Shalat Dhuha Bersama.', 'position' => 1, 'status' => 1, 'category' => 'umum', 'created_at' => '2025-10-28 04:11:51', 'updated_at' => '2025-10-28 04:11:51'],
            ['id' => 12, 'post_id' => null, 'judul' => 'Padus', 'position' => 1, 'status' => 1, 'category' => 'ekstrakurikuler', 'created_at' => '2025-10-28 04:25:13', 'updated_at' => '2025-10-28 04:25:13'],
            ['id' => 13, 'post_id' => null, 'judul' => 'Futsal', 'position' => 1, 'status' => 1, 'category' => 'ekstrakurikuler', 'created_at' => '2025-10-28 04:27:52', 'updated_at' => '2025-10-28 04:27:52'],
            ['id' => 14, 'post_id' => null, 'judul' => 'Pramuka', 'position' => 1, 'status' => 1, 'category' => 'ekstrakurikuler', 'created_at' => '2025-10-28 04:29:48', 'updated_at' => '2025-10-28 04:29:48'],
            ['id' => 15, 'post_id' => null, 'judul' => 'Basket', 'position' => 1, 'status' => 1, 'category' => 'ekstrakurikuler', 'created_at' => '2025-10-28 04:30:54', 'updated_at' => '2025-10-28 04:30:54'],
            ['id' => 16, 'post_id' => null, 'judul' => 'Pmr', 'position' => 1, 'status' => 1, 'category' => 'ekstrakurikuler', 'created_at' => '2025-10-28 04:31:32', 'updated_at' => '2025-10-28 04:31:32'],
            ['id' => 17, 'post_id' => null, 'judul' => 'Seni Tari', 'position' => 1, 'status' => 1, 'category' => 'ekstrakurikuler', 'created_at' => '2025-10-28 04:32:15', 'updated_at' => '2025-10-28 04:32:15'],
            ['id' => 18, 'post_id' => null, 'judul' => 'Silat', 'position' => 1, 'status' => 1, 'category' => 'ekstrakurikuler', 'created_at' => '2025-10-28 04:33:36', 'updated_at' => '2025-10-28 04:33:36'],
            ['id' => 19, 'post_id' => null, 'judul' => 'Sidang pkl', 'position' => 1, 'status' => 1, 'category' => 'pplg', 'created_at' => '2025-10-28 04:36:04', 'updated_at' => '2025-10-28 04:36:04'],
            ['id' => 20, 'post_id' => null, 'judul' => 'Ujikom', 'position' => 1, 'status' => 1, 'category' => 'tpfl', 'created_at' => '2025-10-28 04:36:57', 'updated_at' => '2025-10-28 04:36:57'],
            ['id' => 21, 'post_id' => null, 'judul' => 'Praktek Tugas', 'position' => 1, 'status' => 1, 'category' => 'pplg', 'created_at' => '2025-10-28 04:38:01', 'updated_at' => '2025-10-28 04:38:01'],
            ['id' => 22, 'post_id' => null, 'judul' => 'Ujikom', 'position' => 1, 'status' => 1, 'category' => 'tjkt', 'created_at' => '2025-10-28 04:38:55', 'updated_at' => '2025-10-28 04:38:55'],
            ['id' => 23, 'post_id' => null, 'judul' => 'Ujikom', 'position' => 1, 'status' => 1, 'category' => 'to', 'created_at' => '2025-10-28 04:39:39', 'updated_at' => '2025-10-28 04:39:39'],
            ['id' => 24, 'post_id' => null, 'judul' => 'Praktek Las', 'position' => 1, 'status' => 1, 'category' => 'tpfl', 'created_at' => '2025-10-28 04:41:30', 'updated_at' => '2025-10-28 04:41:30'],
            ['id' => 25, 'post_id' => null, 'judul' => 'pelepasan Pkl kelas XII', 'position' => 1, 'status' => 1, 'category' => 'umum', 'created_at' => '2025-10-28 04:42:40', 'updated_at' => '2025-10-28 04:42:40'],
            ['id' => 26, 'post_id' => null, 'judul' => 'Lingkungan Sekolah', 'position' => 1, 'status' => 1, 'category' => 'lingkungan_sekolah', 'created_at' => '2025-10-28 04:44:00', 'updated_at' => '2025-10-28 04:44:00'],
            ['id' => 27, 'post_id' => null, 'judul' => 'lab tjkt', 'position' => 1, 'status' => 1, 'category' => 'tjkt', 'created_at' => '2025-10-28 04:47:40', 'updated_at' => '2025-10-28 04:47:40'],
            ['id' => 28, 'post_id' => null, 'judul' => 'lab 4 pplg', 'position' => 1, 'status' => 0, 'category' => 'lingkungan_sekolah', 'created_at' => '2025-10-28 04:48:26', 'updated_at' => '2025-10-28 04:48:26'],
            ['id' => 29, 'post_id' => null, 'judul' => 'gedung TO', 'position' => 1, 'status' => 0, 'category' => 'lingkungan_sekolah', 'created_at' => '2025-10-28 04:49:01', 'updated_at' => '2025-10-28 04:49:01'],
            ['id' => 30, 'post_id' => null, 'judul' => 'Upacara pada hari senin 27 oktober 2025', 'position' => 1, 'status' => 1, 'category' => 'upacara', 'created_at' => '2025-10-28 05:04:37', 'updated_at' => '2025-10-28 05:04:37'],
            ['id' => 31, 'post_id' => null, 'judul' => 'upacara senin tanggal 20 oktober 2025', 'position' => 1, 'status' => 1, 'category' => 'upacara', 'created_at' => '2025-10-28 05:06:04', 'updated_at' => '2025-10-28 05:06:04'],
            ['id' => 32, 'post_id' => null, 'judul' => 'Kegiatan Pembiasaan Positif Menjaga Lingkungan Sekolah Dengan Program Adiwiyata.', 'position' => 1, 'status' => 1, 'category' => 'umum', 'created_at' => '2025-10-28 05:10:32', 'updated_at' => '2025-10-28 05:10:32'],
            ['id' => 33, 'post_id' => null, 'judul' => 'Kegiatan Pembiasaan Positif Menjaga Lingkungan Sekolah Dengan Program Adiwiyata.', 'position' => 1, 'status' => 1, 'category' => 'umum', 'created_at' => '2025-10-28 05:11:06', 'updated_at' => '2025-10-28 05:11:06'],
            ['id' => 34, 'post_id' => null, 'judul' => 'membersihkan di lorong sekolah', 'position' => 1, 'status' => 1, 'category' => 'adiwiyata', 'created_at' => '2025-10-28 05:11:42', 'updated_at' => '2025-10-28 05:11:42'],
            ['id' => 35, 'post_id' => null, 'judul' => 'menyapu Pinggir lapangan', 'position' => 1, 'status' => 1, 'category' => 'adiwiyata', 'created_at' => '2025-10-28 05:12:19', 'updated_at' => '2025-10-28 05:12:19'],
            ['id' => 37, 'post_id' => null, 'judul' => 'upacara senin 13 september', 'position' => 1, 'status' => 1, 'category' => 'upacara', 'created_at' => '2025-10-28 05:40:28', 'updated_at' => '2025-10-28 05:40:28'],
            ['id' => 38, 'post_id' => 2, 'judul' => 'SMKN 4 Bogor Siap Laksanakan Uji Kompetensi Keahlian (Ujikom) Tahun 2025', 'position' => 0, 'status' => 1, 'category' => 'berita', 'created_at' => '2025-10-28 05:58:38', 'updated_at' => '2025-10-28 05:58:38'],
            ['id' => 39, 'post_id' => null, 'judul' => 'Mountur', 'position' => 1, 'status' => 1, 'category' => 'umum', 'created_at' => '2025-11-05 03:12:12', 'updated_at' => '2025-11-05 03:12:12'],
            ['id' => 40, 'post_id' => null, 'judul' => 'Upacara', 'position' => 1, 'status' => 1, 'category' => 'upacara', 'created_at' => '2025-11-06 04:33:16', 'updated_at' => '2025-11-06 05:53:12'],
            ['id' => 41, 'post_id' => null, 'judul' => 'lab 4 PPLG', 'position' => 1, 'status' => 0, 'category' => 'lingkungan_sekolah', 'created_at' => '2025-11-06 04:57:15', 'updated_at' => '2025-11-06 04:57:15'],
            ['id' => 42, 'post_id' => null, 'judul' => 'Lab 1 TJKT', 'position' => 1, 'status' => 0, 'category' => 'lingkungan_sekolah', 'created_at' => '2025-11-06 04:58:28', 'updated_at' => '2025-11-06 04:58:28'],
            ['id' => 43, 'post_id' => null, 'judul' => 'Gedung Utama To', 'position' => 1, 'status' => 0, 'category' => 'lingkungan_sekolah', 'created_at' => '2025-11-06 04:59:08', 'updated_at' => '2025-11-06 04:59:08'],
            ['id' => 44, 'post_id' => null, 'judul' => 'Area Sekolah', 'position' => 1, 'status' => 0, 'category' => 'lingkungan_sekolah', 'created_at' => '2025-11-06 04:59:58', 'updated_at' => '2025-11-06 04:59:58'],
            ['id' => 45, 'post_id' => null, 'judul' => 'Upacara 17 Agustus 2025', 'position' => 1, 'status' => 1, 'category' => 'upacara', 'created_at' => '2025-11-09 18:20:15', 'updated_at' => '2025-11-09 18:20:46'],
        ];
        
        foreach ($galeries as $galery) {
            Galery::updateOrCreate(
                ['id' => $galery['id']],
                [
                    'post_id' => $galery['post_id'],
                    'judul' => $galery['judul'],
                    'position' => $galery['position'],
                    'status' => $galery['status'],
                    'category' => $galery['category'],
                    'created_at' => Carbon::parse($galery['created_at']),
                    'updated_at' => Carbon::parse($galery['updated_at']),
                ]
            );
        }
    }
    
    private function seedFoto(): void
    {
        $this->command->info("Importing foto...");
        
        // Foto data - truncated for brevity, but includes all 47 photos
        $fotos = [
            ['id' => 1, 'galery_id' => 1, 'file' => '1761622286_6900390e26c9f.jpg', 'judul' => 'Foto 1', 'created_at' => '2025-10-27 20:31:29', 'updated_at' => '2025-10-27 20:31:29'],
            ['id' => 2, 'galery_id' => 2, 'file' => '1761625417_69004549c7414.jpg', 'judul' => 'Foto 1', 'created_at' => '2025-10-27 21:23:37', 'updated_at' => '2025-10-27 21:23:37'],
            ['id' => 3, 'galery_id' => 3, 'file' => '1761641892_690085a407903.jpg', 'judul' => 'Las - Foto 1', 'created_at' => '2025-10-28 01:58:12', 'updated_at' => '2025-10-28 01:58:12'],
            ['id' => 4, 'galery_id' => 4, 'file' => '1761643978_69008dca2d73c.png', 'judul' => 'TKA ( Tes Kemampuan Akademik ) - Foto 1', 'created_at' => '2025-10-28 02:32:58', 'updated_at' => '2025-10-28 02:32:58'],
            ['id' => 5, 'galery_id' => 5, 'file' => '1761644884_69009154045bb.jpg', 'judul' => 'pencapaian prestasi yang telah di raih Juara 3 Bogor Innovation Award 2025 Bidang Teknologi Informasi dan Komunikasi - Foto 1', 'created_at' => '2025-10-28 02:48:04', 'updated_at' => '2025-10-28 02:48:04'],
            ['id' => 6, 'galery_id' => 6, 'file' => '1761649237_6900a25569351.jpg', 'judul' => 'Kegiatan Pentas Seni SMK Negeri 4 Bogor yang Menampilkan Penampilan dari DJ Mail - Foto 1', 'created_at' => '2025-10-28 04:00:37', 'updated_at' => '2025-10-28 04:00:37'],
            ['id' => 7, 'galery_id' => 7, 'file' => '1761649393_6900a2f1a0469.jpg', 'judul' => 'Kegiatan Peringatan Maulid Nabi Muhammad SAW - Foto 1', 'created_at' => '2025-10-28 04:03:13', 'updated_at' => '2025-10-28 04:03:13'],
            ['id' => 8, 'galery_id' => 8, 'file' => '1761649445_6900a32511c08.jpg', 'judul' => 'Kegiatan Peringatan Maulid Nabi Muhammad SAW ang dihadiri Oleh Ustadz Abi Azkakia Sebagai Penceramah. - Foto 1', 'created_at' => '2025-10-28 04:04:05', 'updated_at' => '2025-10-28 04:04:05'],
            ['id' => 9, 'galery_id' => 9, 'file' => '1761649605_6900a3c52b6c4.jpg', 'judul' => 'Kegiatan Upacara Pengibaran Bendera Merah Putih dalam rangka HUT RI ke-80. - Foto 1', 'created_at' => '2025-10-28 04:06:45', 'updated_at' => '2025-10-28 04:06:45'],
            ['id' => 10, 'galery_id' => 10, 'file' => '1761649911_6900a4f745fd3.jpg', 'judul' => 'Kegiatan Pelaksanaan P5 Shalat Dhuha Bersama. - Foto 1', 'created_at' => '2025-10-28 04:11:51', 'updated_at' => '2025-10-28 04:11:51'],
            ['id' => 11, 'galery_id' => 12, 'file' => '1761650713_6900a819caf11.jpg', 'judul' => 'Padus - Foto 1', 'created_at' => '2025-10-28 04:25:13', 'updated_at' => '2025-10-28 04:25:13'],
            ['id' => 12, 'galery_id' => 13, 'file' => '1761650872_6900a8b821dda.jpg', 'judul' => 'Futsal - Foto 1', 'created_at' => '2025-10-28 04:27:52', 'updated_at' => '2025-10-28 04:27:52'],
            ['id' => 13, 'galery_id' => 14, 'file' => '1761650988_6900a92cb6c8d.jpg', 'judul' => 'Pramuka - Foto 1', 'created_at' => '2025-10-28 04:29:48', 'updated_at' => '2025-10-28 04:29:48'],
            ['id' => 14, 'galery_id' => 15, 'file' => '1761651054_6900a96e6f1ee.jpg', 'judul' => 'Basket - Foto 1', 'created_at' => '2025-10-28 04:30:54', 'updated_at' => '2025-10-28 04:30:54'],
            ['id' => 15, 'galery_id' => 16, 'file' => '1761651092_6900a9946bba5.jpg', 'judul' => 'Pmr - Foto 1', 'created_at' => '2025-10-28 04:31:32', 'updated_at' => '2025-10-28 04:31:32'],
            ['id' => 16, 'galery_id' => 17, 'file' => '1761651135_6900a9bf84d33.jpg', 'judul' => 'Seni Tari - Foto 1', 'created_at' => '2025-10-28 04:32:15', 'updated_at' => '2025-10-28 04:32:15'],
            ['id' => 17, 'galery_id' => 18, 'file' => '1761651216_6900aa107d246.jpg', 'judul' => 'Silat - Foto 1', 'created_at' => '2025-10-28 04:33:36', 'updated_at' => '2025-10-28 04:33:36'],
            ['id' => 18, 'galery_id' => 19, 'file' => '1761651364_6900aaa4201b6.jpg', 'judul' => 'Sidang pkl - Foto 1', 'created_at' => '2025-10-28 04:36:04', 'updated_at' => '2025-10-28 04:36:04'],
            ['id' => 19, 'galery_id' => 20, 'file' => '1761651417_6900aad9d8939.jpg', 'judul' => 'Ujikom - Foto 1', 'created_at' => '2025-10-28 04:36:57', 'updated_at' => '2025-10-28 04:36:57'],
            ['id' => 20, 'galery_id' => 21, 'file' => '1761651481_6900ab19b49e0.jpg', 'judul' => 'Praktek Tugas - Foto 1', 'created_at' => '2025-10-28 04:38:01', 'updated_at' => '2025-10-28 04:38:01'],
            ['id' => 21, 'galery_id' => 22, 'file' => '1761651535_6900ab4f45b98.jpg', 'judul' => 'Ujikom - Foto 1', 'created_at' => '2025-10-28 04:38:55', 'updated_at' => '2025-10-28 04:38:55'],
            ['id' => 22, 'galery_id' => 23, 'file' => '1761651579_6900ab7bbba61.jpg', 'judul' => 'Ujikom - Foto 1', 'created_at' => '2025-10-28 04:39:39', 'updated_at' => '2025-10-28 04:39:39'],
            ['id' => 23, 'galery_id' => 24, 'file' => '1761651690_6900abeab7cda.jpg', 'judul' => 'Praktek Las - Foto 1', 'created_at' => '2025-10-28 04:41:30', 'updated_at' => '2025-10-28 04:41:30'],
            ['id' => 24, 'galery_id' => 25, 'file' => '1761651760_6900ac305b140.jpg', 'judul' => 'pelepasan Pkl kelas XII - Foto 1', 'created_at' => '2025-10-28 04:42:40', 'updated_at' => '2025-10-28 04:42:40'],
            ['id' => 25, 'galery_id' => 26, 'file' => '1761651840_6900ac80b42f5.jpg', 'judul' => 'Lingkungan Sekolah - Foto 1', 'created_at' => '2025-10-28 04:44:00', 'updated_at' => '2025-10-28 04:44:00'],
            ['id' => 26, 'galery_id' => 27, 'file' => '1761652060_6900ad5cdde9b.jpg', 'judul' => 'lab tjkt - Foto 1', 'created_at' => '2025-10-28 04:47:40', 'updated_at' => '2025-10-28 04:47:40'],
            ['id' => 27, 'galery_id' => 28, 'file' => '1761652106_6900ad8acb6bd.jpg', 'judul' => 'lab 4 pplg - Foto 1', 'created_at' => '2025-10-28 04:48:26', 'updated_at' => '2025-10-28 04:48:26'],
            ['id' => 28, 'galery_id' => 29, 'file' => '1761652141_6900adadc4875.jpg', 'judul' => 'gedung TO - Foto 1', 'created_at' => '2025-10-28 04:49:01', 'updated_at' => '2025-10-28 04:49:01'],
            ['id' => 29, 'galery_id' => 30, 'file' => '1761653077_6900b15533234.jpg', 'judul' => 'Upacara pada hari senin 27 oktober 2025 - Foto 1', 'created_at' => '2025-10-28 05:04:37', 'updated_at' => '2025-10-28 05:04:37'],
            ['id' => 30, 'galery_id' => 31, 'file' => '1761653164_6900b1ac2e00c.jpg', 'judul' => 'upacara senin tanggal 20 oktober 2025 - Foto 1', 'created_at' => '2025-10-28 05:06:04', 'updated_at' => '2025-10-28 05:06:04'],
            ['id' => 31, 'galery_id' => 32, 'file' => '1761653432_6900b2b80348b.jpg', 'judul' => 'Kegiatan Pembiasaan Positif Menjaga Lingkungan Sekolah Dengan Program Adiwiyata. - Foto 1', 'created_at' => '2025-10-28 05:10:32', 'updated_at' => '2025-10-28 05:10:32'],
            ['id' => 32, 'galery_id' => 33, 'file' => '1761653466_6900b2daa0a87.jpg', 'judul' => 'Kegiatan Pembiasaan Positif Menjaga Lingkungan Sekolah Dengan Program Adiwiyata. - Foto 1', 'created_at' => '2025-10-28 05:11:06', 'updated_at' => '2025-10-28 05:11:06'],
            ['id' => 33, 'galery_id' => 34, 'file' => '1761653502_6900b2fed336a.jpg', 'judul' => 'membersihkan di lorong sekolah - Foto 1', 'created_at' => '2025-10-28 05:11:42', 'updated_at' => '2025-10-28 05:11:42'],
            ['id' => 34, 'galery_id' => 35, 'file' => '1761653539_6900b32329a76.jpg', 'judul' => 'menyapu Pinggir lapangan - Foto 1', 'created_at' => '2025-10-28 05:12:19', 'updated_at' => '2025-10-28 05:12:19'],
            ['id' => 35, 'galery_id' => 37, 'file' => '1761655264_6900b9e001f47.jpg', 'judul' => 'upacara senin 13 september - Foto 1', 'created_at' => '2025-10-28 05:40:28', 'updated_at' => '2025-10-28 05:41:04'],
            ['id' => 36, 'galery_id' => 38, 'file' => '1761656318_6900bdfe91ab5.jpg', 'judul' => 'SMKN 4 Bogor Siap Laksanakan Uji Kompetensi Keahlian (Ujikom) Tahun 2025 - Foto 1', 'created_at' => '2025-10-28 05:58:38', 'updated_at' => '2025-10-28 05:58:38'],
            ['id' => 37, 'galery_id' => 38, 'file' => '1761656343_6900be17cf266.jpg', 'judul' => 'SMKN 4 Bogor Siap Laksanakan Uji Kompetensi Keahlian (Ujikom) Tahun 2025 - Foto 2', 'created_at' => '2025-10-28 05:59:03', 'updated_at' => '2025-10-28 05:59:03'],
            ['id' => 38, 'galery_id' => 38, 'file' => '1761656372_6900be348bca0.jpg', 'judul' => 'SMKN 4 Bogor Siap Laksanakan Uji Kompetensi Keahlian (Ujikom) Tahun 2025 - Foto 3', 'created_at' => '2025-10-28 05:59:32', 'updated_at' => '2025-10-28 05:59:32'],
            ['id' => 39, 'galery_id' => 38, 'file' => '1761656392_6900be48a6978.jpg', 'judul' => 'SMKN 4 Bogor Siap Laksanakan Uji Kompetensi Keahlian (Ujikom) Tahun 2025 - Foto 4', 'created_at' => '2025-10-28 05:59:52', 'updated_at' => '2025-10-28 05:59:52'],
            ['id' => 40, 'galery_id' => 38, 'file' => '1761656436_6900be74c1295.jpg', 'judul' => 'SMKN 4 Bogor Siap Laksanakan Uji Kompetensi Keahlian (Ujikom) Tahun 2025 - Foto 5', 'created_at' => '2025-10-28 06:00:36', 'updated_at' => '2025-10-28 06:00:36'],
            ['id' => 41, 'galery_id' => 39, 'file' => '1762337532_690b22fc462f1.jpg', 'judul' => 'Mountur - Foto 1', 'created_at' => '2025-11-05 03:12:15', 'updated_at' => '2025-11-05 03:12:15'],
            ['id' => 42, 'galery_id' => 40, 'file' => '1762428796_690c877cb55ea.jpg', 'judul' => 'Upacara - Foto 1', 'created_at' => '2025-11-06 04:33:18', 'updated_at' => '2025-11-06 04:33:18'],
            ['id' => 43, 'galery_id' => 41, 'file' => '1762430236_690c8d1c0108d.jpg', 'judul' => 'lab 4 PPLG - Foto 1', 'created_at' => '2025-11-06 04:57:16', 'updated_at' => '2025-11-06 04:57:16'],
            ['id' => 44, 'galery_id' => 42, 'file' => '1762430308_690c8d6473656.jpg', 'judul' => 'Lab 1 TJKT - Foto 1', 'created_at' => '2025-11-06 04:58:28', 'updated_at' => '2025-11-06 04:58:28'],
            ['id' => 45, 'galery_id' => 43, 'file' => '1762430348_690c8d8c086f2.jpg', 'judul' => 'Gedung Utama To - Foto 1', 'created_at' => '2025-11-06 04:59:08', 'updated_at' => '2025-11-06 04:59:08'],
            ['id' => 46, 'galery_id' => 44, 'file' => '1762430398_690c8dbeda9f5.jpg', 'judul' => 'Area Sekolah - Foto 1', 'created_at' => '2025-11-06 04:59:59', 'updated_at' => '2025-11-06 04:59:59'],
            ['id' => 47, 'galery_id' => 45, 'file' => '1762737615_69113dcf263d6.jpg', 'judul' => 'Upacara 17 Agustus - Foto 1', 'created_at' => '2025-11-09 18:20:16', 'updated_at' => '2025-11-09 18:20:16'],
        ];
        
        foreach ($fotos as $foto) {
            Foto::updateOrCreate(
                ['id' => $foto['id']],
                [
                    'galery_id' => $foto['galery_id'],
                    'file' => $foto['file'],
                    'judul' => $foto['judul'],
                    'created_at' => Carbon::parse($foto['created_at']),
                    'updated_at' => Carbon::parse($foto['updated_at']),
                ]
            );
        }
    }
    
    private function seedMessages(): void
    {
        $this->command->info("Importing messages...");
        
        $messages = [
            [
                'id' => 1,
                'name' => 'davina',
                'email' => 'davina23@gmail.com',
                'message' => 'Bhio banget',
                'status' => 'read',
                'testimonial_status' => 'approved',
                'created_at' => Carbon::parse('2025-10-27 21:21:37'),
                'updated_at' => Carbon::parse('2025-11-09 18:21:11'),
            ],
            [
                'id' => 2,
                'name' => 'risti',
                'email' => 'risti123@gmail.com',
                'message' => 'halo',
                'status' => 'read',
                'testimonial_status' => 'rejected',
                'created_at' => Carbon::parse('2025-11-09 18:10:29'),
                'updated_at' => Carbon::parse('2025-11-09 18:21:20'),
            ],
        ];
        
        foreach ($messages as $message) {
            Message::updateOrCreate(
                ['id' => $message['id']],
                $message
            );
        }
    }
    
    private function seedPhotoInteractions(): void
    {
        $this->command->info("Importing photo interactions...");
        
        $interactions = [
            ['id' => 1, 'foto_id' => 1, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-10-27 21:16:13', 'updated_at' => '2025-10-27 21:16:13'],
            ['id' => 2, 'foto_id' => 2, 'ip_address' => 'user_3', 'type' => 'like', 'created_at' => '2025-10-28 01:54:50', 'updated_at' => '2025-10-28 01:54:50'],
            ['id' => 3, 'foto_id' => 1, 'ip_address' => 'user_3', 'type' => 'like', 'created_at' => '2025-10-28 01:54:52', 'updated_at' => '2025-10-28 01:54:52'],
            ['id' => 4, 'foto_id' => 3, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-10-28 02:43:03', 'updated_at' => '2025-10-28 02:43:03'],
            ['id' => 5, 'foto_id' => 2, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-10-28 02:43:06', 'updated_at' => '2025-10-28 02:43:06'],
            ['id' => 7, 'foto_id' => 16, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-10-28 04:34:51', 'updated_at' => '2025-10-28 04:34:51'],
            ['id' => 8, 'foto_id' => 17, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-10-28 04:34:51', 'updated_at' => '2025-10-28 04:34:51'],
            ['id' => 9, 'foto_id' => 15, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-10-28 04:34:52', 'updated_at' => '2025-10-28 04:34:52'],
            ['id' => 10, 'foto_id' => 13, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-10-28 04:34:56', 'updated_at' => '2025-10-28 04:34:56'],
            ['id' => 11, 'foto_id' => 14, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-10-28 04:35:00', 'updated_at' => '2025-10-28 04:35:00'],
            ['id' => 12, 'foto_id' => 12, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-10-28 04:35:02', 'updated_at' => '2025-10-28 04:35:02'],
            ['id' => 13, 'foto_id' => 9, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-10-28 04:35:07', 'updated_at' => '2025-10-28 04:35:07'],
            ['id' => 14, 'foto_id' => 10, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-10-28 04:35:08', 'updated_at' => '2025-10-28 04:35:08'],
            ['id' => 15, 'foto_id' => 11, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-10-28 04:35:09', 'updated_at' => '2025-10-28 04:35:09'],
            ['id' => 16, 'foto_id' => 8, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-10-28 04:35:09', 'updated_at' => '2025-10-28 04:35:09'],
            ['id' => 17, 'foto_id' => 7, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-10-28 04:35:10', 'updated_at' => '2025-10-28 04:35:10'],
            ['id' => 18, 'foto_id' => 6, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-10-28 04:35:11', 'updated_at' => '2025-10-28 04:35:11'],
            ['id' => 19, 'foto_id' => 35, 'ip_address' => 'user_4', 'type' => 'like', 'created_at' => '2025-11-05 03:04:04', 'updated_at' => '2025-11-05 03:04:04'],
            ['id' => 21, 'foto_id' => 41, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-11-09 18:11:24', 'updated_at' => '2025-11-09 18:11:24'],
            ['id' => 22, 'foto_id' => 42, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-11-09 18:11:24', 'updated_at' => '2025-11-09 18:11:24'],
            ['id' => 23, 'foto_id' => 34, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-11-09 18:11:38', 'updated_at' => '2025-11-09 18:11:38'],
            ['id' => 24, 'foto_id' => 33, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-11-09 18:11:45', 'updated_at' => '2025-11-09 18:11:45'],
            ['id' => 25, 'foto_id' => 32, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-11-09 18:11:50', 'updated_at' => '2025-11-09 18:11:50'],
            ['id' => 26, 'foto_id' => 30, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-11-09 18:11:54', 'updated_at' => '2025-11-09 18:11:54'],
            ['id' => 27, 'foto_id' => 25, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-11-09 18:12:01', 'updated_at' => '2025-11-09 18:12:01'],
            ['id' => 29, 'foto_id' => 41, 'ip_address' => 'user_5', 'type' => 'like', 'created_at' => '2025-11-09 18:16:25', 'updated_at' => '2025-11-09 18:16:25'],
            ['id' => 30, 'foto_id' => 42, 'ip_address' => 'user_5', 'type' => 'like', 'created_at' => '2025-11-09 18:16:27', 'updated_at' => '2025-11-09 18:16:27'],
            ['id' => 34, 'foto_id' => 35, 'ip_address' => 'user_5', 'type' => 'like', 'created_at' => '2025-11-09 18:16:38', 'updated_at' => '2025-11-09 18:16:38'],
            ['id' => 35, 'foto_id' => 32, 'ip_address' => 'user_5', 'type' => 'like', 'created_at' => '2025-11-09 18:16:39', 'updated_at' => '2025-11-09 18:16:39'],
            ['id' => 36, 'foto_id' => 18, 'ip_address' => 'user_5', 'type' => 'like', 'created_at' => '2025-11-09 18:16:45', 'updated_at' => '2025-11-09 18:16:45'],
            ['id' => 37, 'foto_id' => 20, 'ip_address' => 'user_5', 'type' => 'like', 'created_at' => '2025-11-09 18:16:47', 'updated_at' => '2025-11-09 18:16:47'],
            ['id' => 38, 'foto_id' => 5, 'ip_address' => 'user_6', 'type' => 'like', 'created_at' => '2025-11-09 21:54:21', 'updated_at' => '2025-11-09 21:54:21'],
            ['id' => 39, 'foto_id' => 47, 'ip_address' => 'user_6', 'type' => 'like', 'created_at' => '2025-11-09 21:54:22', 'updated_at' => '2025-11-09 21:54:22'],
            ['id' => 40, 'foto_id' => 42, 'ip_address' => 'user_6', 'type' => 'like', 'created_at' => '2025-11-09 21:54:22', 'updated_at' => '2025-11-09 21:54:22'],
            ['id' => 41, 'foto_id' => 41, 'ip_address' => 'user_6', 'type' => 'like', 'created_at' => '2025-11-09 21:54:23', 'updated_at' => '2025-11-09 21:54:23'],
            ['id' => 42, 'foto_id' => 35, 'ip_address' => 'user_6', 'type' => 'like', 'created_at' => '2025-11-09 21:54:23', 'updated_at' => '2025-11-09 21:54:23'],
            ['id' => 43, 'foto_id' => 34, 'ip_address' => 'user_6', 'type' => 'like', 'created_at' => '2025-11-09 21:54:24', 'updated_at' => '2025-11-09 21:54:24'],
            ['id' => 44, 'foto_id' => 33, 'ip_address' => 'user_6', 'type' => 'like', 'created_at' => '2025-11-09 21:54:25', 'updated_at' => '2025-11-09 21:54:25'],
            ['id' => 45, 'foto_id' => 32, 'ip_address' => 'user_6', 'type' => 'like', 'created_at' => '2025-11-09 21:54:26', 'updated_at' => '2025-11-09 21:54:26'],
            ['id' => 46, 'foto_id' => 31, 'ip_address' => 'user_6', 'type' => 'like', 'created_at' => '2025-11-09 21:54:27', 'updated_at' => '2025-11-09 21:54:27'],
            ['id' => 47, 'foto_id' => 30, 'ip_address' => 'user_6', 'type' => 'like', 'created_at' => '2025-11-09 21:54:28', 'updated_at' => '2025-11-09 21:54:28'],
            ['id' => 49, 'foto_id' => 26, 'ip_address' => 'user_6', 'type' => 'like', 'created_at' => '2025-11-09 21:54:29', 'updated_at' => '2025-11-09 21:54:29'],
            ['id' => 50, 'foto_id' => 25, 'ip_address' => 'user_6', 'type' => 'like', 'created_at' => '2025-11-09 21:54:30', 'updated_at' => '2025-11-09 21:54:30'],
            ['id' => 51, 'foto_id' => 22, 'ip_address' => 'user_6', 'type' => 'like', 'created_at' => '2025-11-09 21:54:31', 'updated_at' => '2025-11-09 21:54:31'],
            ['id' => 52, 'foto_id' => 23, 'ip_address' => 'user_6', 'type' => 'like', 'created_at' => '2025-11-09 21:54:31', 'updated_at' => '2025-11-09 21:54:31'],
            ['id' => 53, 'foto_id' => 24, 'ip_address' => 'user_6', 'type' => 'like', 'created_at' => '2025-11-09 21:54:31', 'updated_at' => '2025-11-09 21:54:31'],
            ['id' => 54, 'foto_id' => 47, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-11-09 22:08:40', 'updated_at' => '2025-11-09 22:08:40'],
            ['id' => 55, 'foto_id' => 35, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-11-09 22:08:43', 'updated_at' => '2025-11-09 22:08:43'],
            ['id' => 56, 'foto_id' => 31, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-11-09 22:08:47', 'updated_at' => '2025-11-09 22:08:47'],
            ['id' => 57, 'foto_id' => 26, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-11-09 22:08:50', 'updated_at' => '2025-11-09 22:08:50'],
            ['id' => 58, 'foto_id' => 29, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-11-09 22:08:52', 'updated_at' => '2025-11-09 22:08:52'],
            ['id' => 59, 'foto_id' => 22, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-11-09 22:09:02', 'updated_at' => '2025-11-09 22:09:02'],
            ['id' => 60, 'foto_id' => 23, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-11-09 22:09:04', 'updated_at' => '2025-11-09 22:09:04'],
            ['id' => 61, 'foto_id' => 24, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-11-09 22:09:07', 'updated_at' => '2025-11-09 22:09:07'],
            ['id' => 62, 'foto_id' => 19, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-11-09 22:09:16', 'updated_at' => '2025-11-09 22:09:16'],
            ['id' => 63, 'foto_id' => 20, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-11-09 22:09:18', 'updated_at' => '2025-11-09 22:09:18'],
            ['id' => 64, 'foto_id' => 21, 'ip_address' => 'user_1', 'type' => 'like', 'created_at' => '2025-11-09 22:09:21', 'updated_at' => '2025-11-09 22:09:21'],
            ['id' => 65, 'foto_id' => 5, 'ip_address' => 'user_2', 'type' => 'like', 'created_at' => '2025-11-10 17:07:29', 'updated_at' => '2025-11-10 17:07:29'],
            ['id' => 66, 'foto_id' => 25, 'ip_address' => 'user_2', 'type' => 'like', 'created_at' => '2025-11-10 17:09:16', 'updated_at' => '2025-11-10 17:09:16'],
            ['id' => 67, 'foto_id' => 23, 'ip_address' => 'user_2', 'type' => 'like', 'created_at' => '2025-11-10 18:20:51', 'updated_at' => '2025-11-10 18:20:51'],
            ['id' => 68, 'foto_id' => 24, 'ip_address' => 'user_2', 'type' => 'like', 'created_at' => '2025-11-10 18:20:52', 'updated_at' => '2025-11-10 18:20:52'],
            ['id' => 69, 'foto_id' => 29, 'ip_address' => 'user_2', 'type' => 'like', 'created_at' => '2025-11-10 18:20:55', 'updated_at' => '2025-11-10 18:20:55'],
        ];
        
        foreach ($interactions as $interaction) {
            PhotoInteraction::updateOrCreate(
                ['id' => $interaction['id']],
                [
                    'foto_id' => $interaction['foto_id'],
                    'ip_address' => $interaction['ip_address'],
                    'type' => $interaction['type'],
                    'created_at' => Carbon::parse($interaction['created_at']),
                    'updated_at' => Carbon::parse($interaction['updated_at']),
                ]
            );
        }
    }
    
    private function seedPhotoComments(): void
    {
        $this->command->info("Importing photo comments...");
        
        // Check if user_id and parent_id columns exist
        $hasUserId = Schema::hasColumn('photo_comments', 'user_id');
        $hasParentId = Schema::hasColumn('photo_comments', 'parent_id');
        
        $comments = [
            [
                'id' => 1,
                'foto_id' => 1,
                'name' => 'vira',
                'email' => null,
                'comment' => 'keren',
                'is_approved' => 1,
                'ip_address' => '127.0.0.1',
                'created_at' => Carbon::parse('2025-10-27 21:17:16'),
                'updated_at' => Carbon::parse('2025-10-27 21:17:16'),
            ],
            [
                'id' => 2,
                'foto_id' => 3,
                'name' => 'nadln',
                'email' => null,
                'comment' => 'keren banget',
                'is_approved' => 1,
                'ip_address' => '127.0.0.1',
                'created_at' => Carbon::parse('2025-10-28 02:43:38'),
                'updated_at' => Carbon::parse('2025-10-28 02:43:38'),
            ],
            [
                'id' => 3,
                'foto_id' => 25,
                'name' => 'risti',
                'email' => null,
                'comment' => 'lapangannya luas banget',
                'is_approved' => 1,
                'ip_address' => '127.0.0.1',
                'created_at' => Carbon::parse('2025-11-09 18:12:35'),
                'updated_at' => Carbon::parse('2025-11-09 18:12:35'),
            ],
            [
                'id' => 4,
                'foto_id' => 19,
                'name' => 'risti',
                'email' => null,
                'comment' => 'ujikom jurusan apa ini',
                'is_approved' => 1,
                'ip_address' => '127.0.0.1',
                'created_at' => Carbon::parse('2025-11-09 22:09:38'),
                'updated_at' => Carbon::parse('2025-11-09 22:09:38'),
            ],
        ];
        
        foreach ($comments as $comment) {
            // Only add user_id and parent_id if columns exist
            if ($hasUserId) {
                $comment['user_id'] = null;
            }
            if ($hasParentId) {
                $comment['parent_id'] = null;
            }
            
            PhotoComment::updateOrCreate(
                ['id' => $comment['id']],
                $comment
            );
        }
    }
}

