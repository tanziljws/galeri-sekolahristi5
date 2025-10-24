# Panduan Kategori Galeri

## Kategori yang Tersedia

Sistem galeri sekarang mendukung kategori-kategori berikut:

### Kategori Umum
1. **umum** - Galeri Umum Sekolah
2. **prestasi** - Galeri Prestasi (tampil di section khusus)
3. **ekstrakurikuler** - Kegiatan Ekstrakurikuler

### Kategori Kegiatan
4. **upacara** - Upacara Bendera & Apel
5. **maulid-nabi** - Peringatan Maulid Nabi
6. **p5** - Projek Penguatan Profil Pelajar Pancasila
7. **adiwiyata** - Kegiatan Adiwiyata
8. **neospragma** - Kegiatan Neospragma

### Kategori Organisasi
9. **pmr** - Palang Merah Remaja
10. **pramuka** - Pramuka
11. **osis** - OSIS

### Kategori Jurusan
12. **pplg** - PPLG (Pengembangan Perangkat Lunak & Gim)
13. **tjkt** - TJKT (Teknik Jaringan Komputer & Telekomunikasi)
14. **tpfl** - TPFL (Teknik Pengelasan & Fabrikasi Logam)
15. **to** - TO (Teknik Otomotif)
16. **transforkrab** - Transforkrab

### Kategori Lainnya
17. **lainnya** - Kategori Lain-lain

---

## Cara Mengubah Kategori Galeri

### Manual (Satu per Satu)
1. Buka halaman admin: `http://127.0.0.1:8000/galeri`
2. Klik tombol **Edit** pada album yang ingin diubah
3. Pilih kategori yang sesuai dari dropdown **"Kategori Galeri"**
4. Klik **"Update Album"**

### Otomatis (Berdasarkan Judul)
Jalankan command berikut untuk otomatis mengkategorikan galeri berdasarkan kata kunci di judul:

```bash
php artisan galery:auto-categorize
```

Command ini akan:
- Mencari kata kunci di judul galeri
- Otomatis mengubah kategori yang sesuai
- Menampilkan ringkasan perubahan

### Memperbaiki Kategori yang Invalid
Jika ada kategori yang berisi timestamp atau data tidak valid:

```bash
php artisan galery:fix-categories
```

---

## Kata Kunci Auto-Categorize

Sistem auto-categorize menggunakan kata kunci berikut:

| Kategori | Kata Kunci |
|----------|------------|
| prestasi | prestasi, juara, lomba, kompetisi, penghargaan, medali, trophy |
| upacara | upacara, bendera, apel |
| maulid-nabi | maulid, maulud, nabi |
| p5 | p5, projek penguatan, profil pelajar |
| adiwiyata | adiwiyata, lingkungan, hijau |
| neospragma | neospragma, neo spragma |
| pmr | pmr, palang merah |
| pramuka | pramuka |
| osis | osis, mpk, organisasi siswa |
| ekstrakurikuler | ekskul, ekstrakurikuler |
| pplg | pplg, rpl, perangkat lunak |
| tjkt | tjkt, tkj, jaringan |
| tpfl | tpfl, las, pengelasan |
| to | to, otomotif, mesin |
| transforkrab | transforkrab, transformasi |

---

## Filter di Halaman Publik

Setelah kategori diatur, pengunjung dapat memfilter foto di halaman:
`http://127.0.0.1:8000/galeri-foto`

Tombol filter akan otomatis muncul berdasarkan kategori yang ada di database.

---

## Tips

1. **Konsisten**: Gunakan kategori yang sama untuk kegiatan sejenis
2. **Prestasi**: Foto prestasi akan muncul di section khusus dengan badge kuning
3. **Jurusan**: Foto jurusan bisa ditampilkan di halaman jurusan masing-masing
4. **Update Berkala**: Jalankan `php artisan galery:auto-categorize` setelah menambah galeri baru

---

## Troubleshooting

### Kategori tidak muncul di filter
- Clear cache: `php artisan cache:clear`
- Clear view: `php artisan view:clear`
- Refresh browser dengan Ctrl+F5

### Foto tidak terfilter dengan benar
- Pastikan kategori sudah disimpan di database
- Periksa apakah `data-category` attribute ada di HTML foto

### Command error
- Gunakan `php artisan galery:fix-categories` untuk memperbaiki data invalid
- Pastikan database connection aktif

---

## Contoh Penggunaan

### Contoh 1: Album Upacara
```
Judul: Upacara Bendera 17 Agustus 2024
Kategori: upacara
```

### Contoh 2: Album Prestasi
```
Judul: Juara 1 Lomba Web Design Tingkat Nasional
Kategori: prestasi
```

### Contoh 3: Album Kegiatan Keagamaan
```
Judul: Peringatan Maulid Nabi Muhammad SAW 2024
Kategori: maulid-nabi
```

### Contoh 4: Album Jurusan
```
Judul: Praktikum PPLG - Membuat Aplikasi Mobile
Kategori: pplg
```
