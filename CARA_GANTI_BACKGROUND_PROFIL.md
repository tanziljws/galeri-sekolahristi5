# 🎨 Cara Mengganti Background Halaman Profil

## 📍 Lokasi File

File yang perlu diedit:
```
resources/views/home.blade.php
```

Baris kode: **sekitar baris 1976-1984**

---

## 🖼️ Background Saat Ini

Background halaman profil menggunakan:
- **Foto:** `images/smk-gedung.jpg`
- **Overlay:** Gradient ungu transparan (untuk membuat foto lebih gelap)

---

## 🔧 Cara Mengganti Background

### **Metode 1: Ganti dengan Foto Lain yang Sudah Ada**

1. **Buka file:** `resources/views/home.blade.php`

2. **Cari baris ini** (sekitar baris 1977-1978):
```php
background: linear-gradient(rgba(102, 126, 234, 0.85), rgba(118, 75, 162, 0.85)), 
            url('{{ asset('images/smk-gedung.jpg') }}');
```

3. **Ganti nama file foto:**
```php
background: linear-gradient(rgba(102, 126, 234, 0.85), rgba(118, 75, 162, 0.85)), 
            url('{{ asset('images/NAMA_FOTO_BARU.jpg') }}');
```

**Contoh:**
```php
background: linear-gradient(rgba(102, 126, 234, 0.85), rgba(118, 75, 162, 0.85)), 
            url('{{ asset('images/hero.jpg') }}');
```

4. **Save file**

5. **Clear cache:**
```bash
php artisan view:clear
```

6. **Refresh browser** (Ctrl + R)

---

### **Metode 2: Upload Foto Baru**

#### **Langkah 1: Siapkan Foto**
- Format: JPG, PNG, atau JPEG
- Ukuran: Minimal 1920x1080px (Full HD)
- Nama file: Contoh `profil-bg.jpg`

#### **Langkah 2: Upload Foto**
1. Buka folder: `public/images/`
2. Copy foto Anda ke folder tersebut
3. Contoh: `public/images/profil-bg.jpg`

#### **Langkah 3: Update Kode**
1. Buka file: `resources/views/home.blade.php`
2. Cari baris 1977-1978
3. Ganti dengan:
```php
background: linear-gradient(rgba(102, 126, 234, 0.85), rgba(118, 75, 162, 0.85)), 
            url('{{ asset('images/profil-bg.jpg') }}');
```

#### **Langkah 4: Clear Cache & Test**
```bash
php artisan view:clear
```
Refresh browser!

---

## 🎨 Cara Mengatur Overlay (Warna Transparan di Atas Foto)

### **Overlay Saat Ini:**
```php
linear-gradient(rgba(102, 126, 234, 0.85), rgba(118, 75, 162, 0.85))
```

**Penjelasan:**
- `rgba(102, 126, 234, 0.85)` = Warna ungu atas (85% opacity)
- `rgba(118, 75, 162, 0.85)` = Warna ungu bawah (85% opacity)
- `0.85` = Tingkat transparansi (0.0 = transparan penuh, 1.0 = solid)

---

### **Contoh Overlay Lain:**

#### **1. Overlay Hitam Gelap:**
```php
background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
            url('{{ asset('images/profil-bg.jpg') }}');
```

#### **2. Overlay Biru:**
```php
background: linear-gradient(rgba(33, 150, 243, 0.8), rgba(21, 101, 192, 0.8)), 
            url('{{ asset('images/profil-bg.jpg') }}');
```

#### **3. Overlay Hijau:**
```php
background: linear-gradient(rgba(76, 175, 80, 0.8), rgba(56, 142, 60, 0.8)), 
            url('{{ asset('images/profil-bg.jpg') }}');
```

#### **4. Overlay Merah:**
```php
background: linear-gradient(rgba(244, 67, 54, 0.8), rgba(211, 47, 47, 0.8)), 
            url('{{ asset('images/profil-bg.jpg') }}');
```

#### **5. Tanpa Overlay (Foto Asli):**
```php
background: url('{{ asset('images/profil-bg.jpg') }}');
```

---

## 🔍 Lokasi Kode Lengkap

Cari kode ini di `resources/views/home.blade.php`:

```php
<div class="profile-page-wrapper" style="
    background: linear-gradient(rgba(102, 126, 234, 0.85), rgba(118, 75, 162, 0.85)), 
                url('{{ asset('images/smk-gedung.jpg') }}');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    min-height: 100vh;
    padding: 3rem 0;
">
```

**Penjelasan Properti:**
- `background-size: cover;` = Foto memenuhi seluruh area
- `background-position: center;` = Foto di tengah
- `background-attachment: fixed;` = Foto tetap saat scroll (parallax effect)
- `min-height: 100vh;` = Tinggi minimal 100% viewport

---

## 📝 Contoh Lengkap

### **Contoh 1: Ganti dengan hero.jpg + Overlay Biru**
```php
<div class="profile-page-wrapper" style="
    background: linear-gradient(rgba(33, 150, 243, 0.8), rgba(21, 101, 192, 0.8)), 
                url('{{ asset('images/hero.jpg') }}');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    min-height: 100vh;
    padding: 3rem 0;
">
```

### **Contoh 2: Ganti dengan profil-bg.jpg + Tanpa Overlay**
```php
<div class="profile-page-wrapper" style="
    background: url('{{ asset('images/profil-bg.jpg') }}');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    min-height: 100vh;
    padding: 3rem 0;
">
```

### **Contoh 3: Ganti dengan smk-lapangan.jpg + Overlay Hitam**
```php
<div class="profile-page-wrapper" style="
    background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                url('{{ asset('images/smk-lapangan.jpg') }}');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    min-height: 100vh;
    padding: 3rem 0;
">
```

---

## 🎯 Tips Memilih Foto Background

### **Foto yang Bagus:**
- ✅ Resolusi tinggi (minimal 1920x1080px)
- ✅ Tidak terlalu ramai (agar teks tetap terbaca)
- ✅ Warna netral atau sesuai tema
- ✅ Fokus di tengah (karena ada konten di atasnya)

### **Foto yang Kurang Bagus:**
- ❌ Resolusi rendah (akan blur)
- ❌ Terlalu ramai (teks sulit dibaca)
- ❌ Warna terlalu terang (silau)
- ❌ Fokus di pinggir (akan terpotong)

---

## 🚀 Checklist Setelah Ganti Background

- [ ] Upload foto ke `public/images/`
- [ ] Update kode di `home.blade.php`
- [ ] Sesuaikan overlay jika perlu
- [ ] Clear cache: `php artisan view:clear`
- [ ] Refresh browser
- [ ] Cek di desktop
- [ ] Cek di mobile
- [ ] Pastikan teks tetap terbaca

---

## 🐛 Troubleshooting

### **Problem 1: Foto tidak muncul**
**Solusi:**
1. Pastikan foto ada di `public/images/`
2. Cek nama file (case-sensitive!)
3. Clear cache: `php artisan view:clear`
4. Hard refresh browser: Ctrl + Shift + R

### **Problem 2: Foto blur/pecah**
**Solusi:**
- Upload foto dengan resolusi lebih tinggi
- Minimal 1920x1080px

### **Problem 3: Teks tidak terbaca**
**Solusi:**
- Tambah overlay lebih gelap
- Ubah opacity overlay (contoh: 0.85 → 0.9)

### **Problem 4: Foto terlalu terang**
**Solusi:**
- Tambah overlay hitam:
```php
background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
            url('{{ asset('images/foto.jpg') }}');
```

---

## 📸 Rekomendasi Foto

### **Foto yang Sudah Ada:**
- `images/smk-gedung.jpg` ← Default saat ini
- `images/hero.jpg`
- `images/smk-logo.png` (tidak cocok untuk background)

### **Foto yang Bisa Ditambahkan:**
- Foto gedung sekolah dari luar
- Foto lapangan sekolah
- Foto kelas
- Foto laboratorium
- Foto perpustakaan
- Foto kegiatan siswa (blur background)

---

## ✅ Hasil Akhir

Setelah mengganti background:
- ✅ Halaman profil lebih menarik
- ✅ Background foto sesuai tema sekolah
- ✅ Overlay membuat teks tetap terbaca
- ✅ Parallax effect saat scroll

---

**Dibuat:** 22 Oktober 2025, 09:52 WIB
**Status:** ✅ READY TO USE
**Lokasi File:** `resources/views/home.blade.php` (baris ~1976-1984)
