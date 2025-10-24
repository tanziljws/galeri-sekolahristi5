# 🎯 Panduan Admin - Sistem Galeri Terpisah

## 📋 **Overview**
Sistem galeri SMKN 4 Bogor sekarang memiliki **2 sistem terpisah** yang tidak akan tercampur:

1. **🎓 Galeri Kegiatan Jurusan** - Untuk foto kegiatan PPLG, TJKT, TPFL, TO
2. **🏫 Galeri Sekolah Umum** - Untuk foto kegiatan umum sekolah

## 🔗 **URL Admin Panel**

### **1. Kelola Kegiatan Jurusan**
```
URL: /admin/jurusan-activities
Fungsi: Mengelola foto kegiatan jurusan (PPLG, TJKT, TPFL, TO)
```

### **2. Kelola Galeri Sekolah**
```
URL: /admin/school-galleries
Fungsi: Mengelola foto galeri sekolah umum
```

## 📱 **Cara Penggunaan**

### **🎓 MENAMBAH FOTO KEGIATAN JURUSAN**

**Langkah:**
1. Buka `/admin/jurusan-activities`
2. Klik "Tambah Kegiatan Baru"
3. Pilih jurusan: **PPLG**, **TJKT**, **TPFL**, atau **TO**
4. Isi judul, tipe kegiatan, tanggal, deskripsi
5. Upload foto (max 2MB)
6. Klik "Simpan Kegiatan"

**Hasil:**
- ✅ Foto muncul di halaman jurusan yang dipilih
- ❌ Foto TIDAK akan muncul di "Galeri Agenda Sekolah"
- 📍 Lokasi: `/jurusan/pplg`, `/jurusan/tjkt`, `/jurusan/tpfl`, `/jurusan/to`

---

### **🏫 MENAMBAH FOTO GALERI SEKOLAH**

**Langkah:**
1. Buka `/admin/school-galleries`
2. Klik "Tambah Foto Baru"
3. Pilih kategori: kegiatan sekolah, acara, prestasi, fasilitas, dll
4. Isi judul, deskripsi, tanggal event (opsional)
5. Upload foto (max 2MB)
6. Klik "Simpan Foto"

**Hasil:**
- ✅ Foto muncul di halaman utama "Galeri Agenda Sekolah"
- ❌ Foto TIDAK akan muncul di halaman jurusan
- 📍 Lokasi: Halaman utama website

## 🎨 **Kategori yang Tersedia**

### **Kegiatan Jurusan:**
- **Lab** - Kegiatan laboratorium
- **Workshop** - Pelatihan dan workshop
- **Competition** - Kompetisi dan lomba
- **Project** - Proyek kelompok
- **Field Trip** - Kunjungan lapangan
- **Seminar** - Seminar dan presentasi
- **Other** - Kegiatan lainnya

### **Galeri Sekolah:**
- **Kegiatan Sekolah** - Upacara, rapat, administrasi
- **Acara Khusus** - Hari besar, perpisahan, wisuda
- **Prestasi Siswa** - Lomba, penghargaan, kompetisi
- **Fasilitas Sekolah** - Gedung, ruang, lab, perpustakaan
- **Kegiatan Umum** - Ekstrakurikuler, sosial, kunjungan
- **Lainnya** - Kategori tidak spesifik

## 🔄 **Manajemen Foto**

### **Fitur yang Tersedia:**
- ✅ **Tambah** - Upload foto baru
- ✅ **Edit** - Ubah informasi foto
- ✅ **Lihat** - Detail foto
- ✅ **Hapus** - Hapus foto
- ✅ **Toggle Status** - Aktifkan/nonaktifkan foto

### **Status Foto:**
- 🟢 **Aktif** - Foto akan ditampilkan di website
- 🔴 **Nonaktif** - Foto tidak akan ditampilkan (tersembunyi)

## 📁 **Struktur Penyimpanan**

### **Foto Kegiatan Jurusan:**
```
storage/app/public/jurusan-activities/
├── pplg_lab_coding.jpg
├── tjkt_workshop_networking.jpg
├── tpfl_lab_pengolahan.jpg
└── to_praktik_mesin.jpg
```

### **Foto Galeri Sekolah:**
```
storage/app/public/school-gallery/
├── upacara_bendera.jpg
├── rapat_guru.jpg
├── prestasi_lomba.jpg
└── fasilitas_lab.jpg
```

## 🚫 **Yang TIDAK Akan Terjadi**

### **Foto Jurusan TIDAK akan muncul di:**
- ❌ Halaman utama "Galeri Agenda Sekolah"
- ❌ Halaman jurusan lain (PPLG tidak muncul di TJKT)

### **Foto Sekolah TIDAK akan muncul di:**
- ❌ Halaman jurusan manapun
- ❌ Halaman PPLG, TJKT, TPFL, TO

## ✅ **Keuntungan Sistem Terpisah**

1. **🎯 Konten Terorganisir** - Setiap foto muncul di tempat yang tepat
2. **👨‍💼 Manajemen Mudah** - Admin bisa mengelola galeri secara terpisah
3. **📱 Tampilan Bersih** - Tidak ada pencampuran konten
4. **🔒 Keamanan** - Konten jurusan tidak bocor ke galeri umum
5. **⚡ Performa** - Query database lebih efisien

## 🆘 **Troubleshooting**

### **Foto Tidak Muncul:**
1. ✅ Cek status foto (aktif/nonaktif)
2. ✅ Cek symbolic link storage sudah dibuat
3. ✅ Cek permission direktori storage
4. ✅ Cek path foto di database

### **Upload Gagal:**
1. ✅ Cek ukuran file (max 2MB)
2. ✅ Cek tipe file (JPG, PNG, GIF)
3. ✅ Cek permission direktori storage

### **Route Not Found:**
1. ✅ Jalankan `php artisan route:clear`
2. ✅ Cek file `routes/web.php`
3. ✅ Pastikan controller ada

## 📚 **Contoh Penggunaan Real**

### **Scenario 1: Admin ingin menambah foto lab PPLG**
1. Buka `/admin/jurusan-activities`
2. Pilih jurusan: **PPLG**
3. Upload foto lab coding
4. **Hasil**: Foto muncul di `/jurusan/pplg` saja

### **Scenario 2: Admin ingin menambah foto upacara sekolah**
1. Buka `/admin/school-galleries`
2. Pilih kategori: **Kegiatan Sekolah**
3. Upload foto upacara
4. **Hasil**: Foto muncul di halaman utama galeri saja

### **Scenario 3: Admin ingin menambah foto workshop TJKT**
1. Buka `/admin/jurusan-activities`
2. Pilih jurusan: **TJKT**
3. Upload foto workshop networking
4. **Hasil**: Foto muncul di `/jurusan/tjkt` saja

## 🎯 **Kesimpulan**

Dengan sistem galeri terpisah ini:
- **Foto kegiatan jurusan** → Hanya muncul di halaman jurusan masing-masing
- **Foto galeri sekolah** → Hanya muncul di halaman utama galeri
- **Tidak ada pencampuran** antara kedua jenis galeri
- **Admin bisa mengelola** kedua galeri secara terpisah dan mudah

Sistem ini memastikan bahwa setiap foto muncul di tempat yang tepat sesuai dengan kategorinya! 🎉

---

**💡 Tips**: Gunakan menu yang tepat sesuai dengan jenis foto yang ingin ditambahkan:
- **Jurusan Activities** → Untuk foto kegiatan PPLG, TJKT, TPFL, TO
- **School Gallery** → Untuk foto kegiatan umum sekolah
