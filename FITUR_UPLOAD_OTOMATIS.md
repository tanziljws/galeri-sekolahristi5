# 📸 Fitur Upload Foto Otomatis - Galeri Sekolah

## ✨ Fitur Baru: Upload Otomatis

Sekarang admin bisa upload foto dengan cara yang lebih mudah dan cepat! **Tinggal pilih foto, langsung masuk database dan tampil di galeri.**

---

## 🎯 Cara Menggunakan

### 1️⃣ Upload Foto Saat Buat Album Baru
**Lokasi:** Menu Galeri → Buat Album Baru

**Langkah:**
1. Isi judul album (contoh: "Upacara Bendera", "Lab PPLG", "Kegiatan Adiwiyata")
2. Pilih kategori (Umum, Prestasi, PPLG, TJKT, dll)
3. **Drag & drop foto** atau klik "Pilih Foto"
4. Pilih **banyak foto sekaligus** (maksimal 20 foto)
5. Klik "Simpan Album"

**Hasil:**
- ✅ Semua foto langsung masuk database
- ✅ Judul foto dibuat otomatis: "Nama Album - Foto 1", "Nama Album - Foto 2", dst
- ✅ Langsung tampil di galeri publik

---

### 2️⃣ Quick Upload - Tambah Foto ke Album yang Sudah Ada
**Lokasi:** Menu Galeri → Tombol "Upload Foto" di setiap album

**Langkah:**
1. Buka halaman **Galeri** (daftar semua album)
2. Cari album yang ingin ditambah fotonya
3. Klik tombol **"Upload Foto"** (tombol hijau)
4. Pilih foto yang ingin diupload (bisa banyak sekaligus)
5. Klik "Upload Sekarang"

**Hasil:**
- ✅ Foto langsung masuk ke album tersebut
- ✅ Judul otomatis dibuat
- ✅ Langsung tampil di galeri

---

## 🚀 Keuntungan Fitur Ini

### ❌ Cara Lama (Ribet):
- Harus input judul setiap foto satu-satu
- Harus copy-paste file ke folder manual
- Harus input data ke database manual

### ✅ Cara Baru (Otomatis):
- **Pilih foto → Langsung jadi!**
- Judul dibuat otomatis
- File langsung tersimpan
- Database langsung terupdate
- Langsung tampil di website

---

## 📋 Spesifikasi Upload

- **Format:** JPG, PNG
- **Ukuran maksimal:** 20MB per file
- **Jumlah maksimal:** 20 foto per upload
- **Auto-generate judul:** Ya
- **Langsung tampil:** Ya

---

## 🎨 Fitur Tambahan

### Preview Foto
Sebelum upload, Anda bisa melihat preview semua foto yang dipilih.

### Drag & Drop
Bisa drag foto langsung dari folder ke area upload.

### Multiple Upload
Bisa pilih banyak foto sekaligus (Ctrl+A atau Shift+Click).

---

## 💡 Tips Penggunaan

1. **Beri nama album yang jelas** - Karena judul foto akan mengikuti nama album
2. **Pilih kategori yang tepat** - Agar foto muncul di halaman yang sesuai
3. **Upload foto berkualitas** - Untuk tampilan yang lebih baik
4. **Gunakan Quick Upload** - Untuk menambah foto ke album yang sudah ada

---

## 🔧 Technical Details

### File yang Dimodifikasi:
1. `app/Http/Controllers/GaleriController.php`
   - Method `store()` - Auto-generate judul foto
   - Method `quickUpload()` - Upload cepat ke album existing

2. `resources/views/galeri/index.blade.php`
   - Tombol "Upload Foto" di setiap card album
   - Modal quick upload dengan preview

3. `routes/web.php`
   - Route baru: `POST galeri/{id}/quick-upload`

### Database:
- Tabel `galery` - Menyimpan data album
- Tabel `foto` - Menyimpan data foto (auto-generated judul)
- Storage: `storage/app/public/galeri/`

---

## 📞 Support

Jika ada masalah atau pertanyaan, hubungi admin sistem.

**Dibuat:** 28 Oktober 2025
**Versi:** 1.0
