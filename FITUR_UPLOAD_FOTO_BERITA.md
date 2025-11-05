# 📸 Fitur Upload Foto untuk Berita

## ✨ Fitur Baru: Upload Foto Berita

Sekarang admin bisa **upload foto langsung saat membuat atau mengedit berita**! Foto akan otomatis tampil di halaman detail berita dengan desain modern minimalis.

---

## 🎯 Cara Menggunakan

### 1️⃣ **Upload Foto Saat Buat Berita Baru**

**Lokasi:** Menu Post/Berita → Tambah Berita Baru

**Langkah:**
1. Isi judul berita
2. Tulis isi berita (gunakan struktur: Teras → Isi → Penutup)
3. Pilih kategori dan penulis
4. **Scroll ke bawah** ke bagian "Upload Foto Berita"
5. Klik tombol "Choose File" atau drag & drop foto
6. Pilih **maksimal 10 foto** sekaligus
7. **Preview foto** akan muncul otomatis
8. Klik "Simpan Berita"

**Hasil:**
- ✅ Berita tersimpan dengan foto
- ✅ Foto langsung tampil di halaman detail berita
- ✅ Foto pertama jadi hero image (foto besar di atas)

---

### 2️⃣ **Tambah Foto ke Berita yang Sudah Ada**

**Lokasi:** Menu Post/Berita → Edit Berita

**Langkah:**
1. Buka berita yang ingin ditambah fotonya
2. Klik tombol "Edit"
3. **Lihat foto yang sudah ada** (jika ada)
4. Scroll ke "Tambah Foto Baru"
5. Pilih foto baru yang ingin ditambahkan
6. Preview akan muncul
7. Klik "Update Berita"

**Hasil:**
- ✅ Foto baru ditambahkan ke berita
- ✅ Foto lama tetap ada
- ✅ Semua foto tampil di halaman detail

---

## 📋 Spesifikasi Upload

- **Format:** JPG, PNG
- **Ukuran maksimal:** 20MB per file
- **Jumlah maksimal:** 10 foto per upload
- **Auto-generate judul:** Ya (Judul Berita - Foto 1, Foto 2, dst)
- **Langsung tampil:** Ya
- **Preview sebelum upload:** Ya

---

## 🎨 Tampilan di Website

### **Halaman Detail Berita:**
```
┌─────────────────────────────────────┐
│    HERO IMAGE (Foto Pertama)       │
│         (Full Width, 400px)         │
└─────────────────────────────────────┘
         ┌─────────────────┐
         │  Badge Kategori │
         └─────────────────┘
    ┌────────────────────────────┐
    │      JUDUL BERITA          │
    └────────────────────────────┘
    📅 Tanggal | ⏰ Waktu | 👤 Penulis
    ────────────────────────────────
    
    TERAS BERITA (Highlighted)
    
    ISI BERITA
    
    📤 Share: [FB] [TW] [WA] [📋]
```

### **Jika Berita Tidak Ada Foto:**
- Placeholder "Tidak ada gambar" di card berita
- Tidak ada hero image di detail
- Tetap bisa dibaca dengan normal

---

## 🔧 Technical Details

### **Sistem Upload:**
1. **Dual Storage** - Foto disimpan di 2 lokasi:
   - `storage/app/public/galeri/` (Laravel storage)
   - `public/storage/galeri/` (Windows fix)

2. **Auto-create Galeri** - Saat upload foto:
   - Sistem otomatis membuat album galeri untuk berita
   - Galeri terhubung dengan berita via `post_id`
   - Kategori galeri: "umum"

3. **Nama File:**
   - Format: `timestamp_uniqueid.ext`
   - Contoh: `1730102400_68f872787d6cc.jpg`
   - Judul foto: "Judul Berita - Foto 1"

### **Database Structure:**
```
posts
├── id
├── judul
├── isi
└── ...

galery
├── id
├── post_id (FK to posts)
├── judul
└── ...

foto
├── id
├── galery_id (FK to galery)
├── file
└── judul
```

---

## 💡 Tips Upload Foto Berita

### ✅ **DO (Lakukan):**
1. **Upload foto berkualitas** tinggi dan jelas
2. **Foto pertama** akan jadi hero image - pilih yang terbaik!
3. **Foto relevan** dengan isi berita
4. **Hindari foto blur** atau gelap
5. **Compress foto** jika ukuran terlalu besar (gunakan TinyPNG, dll)
6. **Upload minimal 1 foto** untuk setiap berita agar menarik

### ❌ **DON'T (Jangan):**
1. ❌ Upload foto yang tidak relevan
2. ❌ Upload foto dengan watermark orang lain
3. ❌ Upload foto yang terlalu besar (>20MB)
4. ❌ Upload foto yang melanggar privasi
5. ❌ Upload lebih dari 10 foto sekaligus

---

## 📸 **Contoh Penggunaan**

### **Berita: "SMKN 4 Bogor Gelar Lomba Kreativitas"**

**Foto yang Diupload:**
1. Foto pembukaan acara (Hero Image)
2. Foto peserta lomba
3. Foto pemenang
4. Foto penyerahan hadiah

**Hasil:**
- Foto 1 tampil besar di atas (hero)
- Semua foto tersimpan di galeri berita
- Pengunjung bisa lihat semua foto
- Berita jadi lebih menarik dan informatif

---

## 🔍 **Preview Sebelum Upload**

Fitur preview membantu Anda:
- ✅ **Melihat foto** sebelum diupload
- ✅ **Memastikan foto** sudah benar
- ✅ **Menghitung jumlah** foto yang akan diupload
- ✅ **Alert otomatis** jika lebih dari 10 foto

---

## 🚀 **Workflow Upload Foto Berita**

```
1. Admin buat/edit berita
   ↓
2. Pilih foto (max 10)
   ↓
3. Preview muncul otomatis
   ↓
4. Klik Simpan/Update
   ↓
5. Sistem upload & simpan ke:
   - storage/app/public/galeri/
   - public/storage/galeri/
   - Database (tabel foto)
   ↓
6. Foto langsung tampil di website
```

---

## 📁 **File yang Dimodifikasi**

### **Controller:**
- `app/Http/Controllers/PostController.php`
  - Method `store()` - Upload foto saat buat berita
  - Method `update()` - Upload foto saat edit berita

### **Views:**
- `resources/views/post/create.blade.php` - Form upload foto
- `resources/views/post/edit.blade.php` - Form upload + tampil foto lama
- `resources/views/berita/show.blade.php` - Tampilan detail dengan foto

### **Models:**
- `app/Models/Post.php` - Relasi dengan Galery
- `app/Models/Galery.php` - Relasi dengan Post dan Foto
- `app/Models/Foto.php` - Data foto

---

## ❓ **FAQ**

### **Q: Apakah wajib upload foto?**
A: Tidak, foto bersifat opsional. Tapi sangat disarankan untuk membuat berita lebih menarik.

### **Q: Berapa maksimal ukuran foto?**
A: 20MB per file. Jika lebih besar, compress dulu menggunakan tools online.

### **Q: Apakah bisa upload video?**
A: Belum. Saat ini hanya support foto (JPG, PNG).

### **Q: Bagaimana jika ingin hapus foto?**
A: Saat ini belum ada fitur hapus foto individual. Akan ditambahkan di update berikutnya.

### **Q: Apakah foto lama terhapus saat upload foto baru?**
A: Tidak. Foto baru akan ditambahkan, foto lama tetap ada.

---

## 📞 **Support**

Jika ada masalah:
1. Pastikan ukuran foto tidak lebih dari 20MB
2. Pastikan format foto JPG atau PNG
3. Cek koneksi internet
4. Clear cache browser
5. Hubungi admin sistem jika masih error

---

**Dibuat:** 28 Oktober 2025  
**Versi:** 1.0  
**Status:** ✅ Active
