<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Kategori;
use App\Models\Petugas;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        // Get existing categories and users
        $kategoriInfo = Kategori::where('judul', 'Informasi Terkini')->first();
        $kategoriGalery = Kategori::where('judul', 'Galery Sekolah')->first();
        $kategoriAgenda = Kategori::where('judul', 'Agenda Sekolah')->first();
        
        $admin = Petugas::where('username', 'Admin')->first();
        $user = Petugas::where('username', 'user')->first();

        // Create user if doesn't exist
        if (!$user) {
            $user = Petugas::create([
                'username' => 'user',
                'password' => \Illuminate\Support\Facades\Hash::make('12345'),
                'email' => 'user@gmail.com'
            ]);
        }

        // Sample posts for Informasi Terkini
        Post::create([
            'judul' => 'Jadwal Ujian Semester Genap 2024',
            'kategori_id' => $kategoriInfo->id,
            'isi' => "Berikut adalah jadwal ujian semester genap tahun ajaran 2023/2024 untuk semua jurusan:

Senin, 20 Mei 2024:
- 07:00 - 09:00: Matematika
- 10:00 - 12:00: Bahasa Indonesia

Selasa, 21 Mei 2024:
- 07:00 - 09:00: Bahasa Inggris
- 10:00 - 12:00: PPKN

Rabu, 22 Mei 2024:
- 07:00 - 09:00: Fisika/Kimia (sesuai jurusan)
- 10:00 - 12:00: Sejarah

Kamis, 23 Mei 2024:
- 07:00 - 09:00: Mata Pelajaran Kejuruan
- 10:00 - 12:00: Mata Pelajaran Kejuruan

Jumat, 24 Mei 2024:
- 07:00 - 09:00: Mata Pelajaran Kejuruan
- 10:00 - 12:00: Mata Pelajaran Kejuruan

Catatan:
- Siswa wajib hadir 30 menit sebelum ujian dimulai
- Membawa alat tulis dan kartu ujian
- Dilarang membawa HP ke ruang ujian
- Pakaian seragam sekolah lengkap",
            'petugas_id' => $admin->id,
            'status' => 'Published'
        ]);

        Post::create([
            'judul' => 'Pengumuman Penerimaan Siswa Baru 2024/2025',
            'kategori_id' => $kategoriInfo->id,
            'isi' => "SMK Negeri 4 Kota Bogor membuka pendaftaran siswa baru untuk tahun ajaran 2024/2025.

JURUSAN YANG DIBUKA:
1. Teknik Kendaraan Ringan Otomotif (TKRO)
2. Teknik dan Bisnis Sepeda Motor (TBSM)
3. Teknik Komputer dan Jaringan (TKJ)
4. Rekayasa Perangkat Lunak (RPL)
5. Akuntansi dan Keuangan Lembaga (AKL)
6. Otomatisasi dan Tata Kelola Perkantoran (OTKP)

PERSYARATAN PENDAFTARAN:
- Lulusan SMP/MTs tahun 2024 atau sebelumnya
- Usia maksimal 21 tahun pada 1 Juli 2024
- Membawa fotokopi ijazah/surat keterangan lulus
- Membawa fotokopi akta kelahiran
- Membawa fotokopi KK
- Membawa pas foto 3x4 (3 lembar)

JADWAL PENDAFTARAN:
- Gelombang 1: 1-15 Februari 2024
- Gelombang 2: 16-28 Februari 2024
- Gelombang 3: 1-15 Maret 2024

BIAYA PENDAFTARAN:
- Uang pendaftaran: Rp 200.000
- Uang gedung: Rp 1.500.000
- SPP bulanan: Rp 150.000

Untuk informasi lebih lanjut, silakan hubungi panitia PPDB di sekolah atau melalui website resmi sekolah.",
            'petugas_id' => $admin->id,
            'status' => 'Published'
        ]);

        // Sample posts for Galery Sekolah
        Post::create([
            'judul' => 'Kunjungan Industri ke PT Astra Honda Motor',
            'kategori_id' => $kategoriGalery->id,
            'isi' => "Pada tanggal 15 Maret 2024, siswa kelas XI jurusan Teknik Kendaraan Ringan Otomotif (TKRO) dan Teknik dan Bisnis Sepeda Motor (TBSM) melakukan kunjungan industri ke PT Astra Honda Motor di Karawang, Jawa Barat.

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
            'petugas_id' => $user->id,
            'status' => 'Published'
        ]);

        Post::create([
            'judul' => 'Praktikum Teknik Kendaraan Ringan',
            'kategori_id' => $kategoriGalery->id,
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
            'petugas_id' => $user->id,
            'status' => 'Published'
        ]);

        // Sample posts for Agenda Sekolah
        Post::create([
            'judul' => 'Peringatan Hari Kemerdekaan RI ke-79',
            'kategori_id' => $kategoriAgenda->id,
            'isi' => "SMK Negeri 4 Kota Bogor akan mengadakan berbagai kegiatan dalam rangka memperingati Hari Kemerdekaan Republik Indonesia ke-79.

JADWAL KEGIATAN:

17 Agustus 2024:
- 07:00: Upacara Bendera di lapangan sekolah
- 08:30: Pembacaan teks proklamasi
- 09:00: Doa bersama untuk bangsa dan negara

18-20 Agustus 2024:
- Lomba-lomba antar kelas:
  * Tarik tambang
  * Balap karung
  * Makan kerupuk
  * Memasukkan paku ke dalam botol
  * Estafet air
  * Balap bakiak

21 Agustus 2024:
- Pentas seni dan budaya
- Pameran hasil karya siswa
- Bazar makanan tradisional

22 Agustus 2024:
- Upacara penutupan
- Pembagian hadiah pemenang lomba
- Pembagian bingkisan untuk guru dan karyawan

TEMA KEGIATAN:
'Bersatu Membangun Negeri, Maju Bersama SMK'

Semua siswa wajib mengikuti kegiatan ini dengan pakaian seragam merah putih. Kegiatan ini bertujuan untuk menumbuhkan semangat nasionalisme dan persatuan bangsa.",
            'petugas_id' => $admin->id,
            'status' => 'Published'
        ]);

        Post::create([
            'judul' => 'Kunjungan Dinas Pendidikan Provinsi Jawa Barat',
            'kategori_id' => $kategoriAgenda->id,
            'isi' => "Pada tanggal 10 April 2024, SMK Negeri 4 Kota Bogor mendapat kunjungan dari Dinas Pendidikan Provinsi Jawa Barat untuk melakukan monitoring dan evaluasi program sekolah.

AGENDA KUNJUNGAN:
1. Rapat dengan kepala sekolah dan wakil kepala sekolah
2. Kunjungan ke ruang praktikum
3. Observasi kegiatan belajar mengajar
4. Pemeriksaan dokumen administrasi sekolah
5. Wawancara dengan guru dan siswa
6. Rapat evaluasi dan rekomendasi

HASIL MONITORING:
- Program sekolah berjalan dengan baik
- Fasilitas praktikum memadai
- Guru kompeten dan profesional
- Siswa aktif dan berprestasi
- Administrasi sekolah tertib

REKOMENDASI:
- Menambah fasilitas laboratorium komputer
- Meningkatkan kerjasama dengan dunia industri
- Mengembangkan program unggulan sekolah
- Memperluas jaringan alumni

Kunjungan ini merupakan bagian dari program monitoring rutin Dinas Pendidikan Provinsi Jawa Barat untuk memastikan kualitas pendidikan di SMK Negeri 4 Kota Bogor tetap terjaga.",
            'petugas_id' => $admin->id,
            'status' => 'Published'
        ]);
    }
}
