# 📸 Instruksi Upload Foto Background

## 🎯 Foto yang Dibutuhkan

Untuk background section "SMK Pusat Keunggulan", Anda perlu upload **foto siswa upacara** (foto ke-3 yang Anda kirim).

---

## 📁 Lokasi Upload

**Simpan foto dengan nama:** `siswa-upacara.jpg`

**Di folder:** `c:\xampp\htdocs\galeri-sekolahristi\public\images\`

---

## 🔧 Langkah-langkah:

### 1. **Download/Simpan Foto**
- Foto siswa upacara (foto ke-3 yang Anda kirim)
- Rename menjadi: `siswa-upacara.jpg`

### 2. **Upload ke Folder Images**
- Buka folder: `c:\xampp\htdocs\galeri-sekolahristi\public\images\`
- Copy file `siswa-upacara.jpg` ke folder tersebut

### 3. **Refresh Browser**
- Buka homepage: `http://127.0.0.1:8000/`
- Tekan `Ctrl + F5` untuk hard refresh
- Background section "SMK Pusat Keunggulan" sekarang menggunakan foto siswa dengan efek blur

---

## ✨ Hasil yang Diharapkan

**Section "SMK Pusat Keunggulan" akan memiliki:**
- ✅ Background: Foto siswa upacara (blur 8px)
- ✅ Overlay: Dark overlay (opacity 0.6)
- ✅ Text: Putih dengan shadow untuk kontras
- ✅ Video: Tetap di kiri
- ✅ Feature items: Background putih semi-transparan

**Efek Visual:**
```
┌─────────────────────────────────────────┐
│  [Foto Siswa Blur + Dark Overlay]       │
│                                         │
│  [Video]    SMK Pusat Keunggulan       │
│             (Text Putih)                │
│                                         │
│             ✓ Pendidikan Berkualitas    │
│             ✓ Teknologi Terdepan        │
│             ✓ Komunitas Unggul          │
└─────────────────────────────────────────┘
```

---

## 🎨 Spesifikasi Foto

**Recommended:**
- Format: JPG
- Ukuran: 1920x1080px atau lebih
- Orientasi: Landscape
- Quality: High resolution

**Current Settings:**
- Blur: 8px
- Scale: 1.1 (untuk menghindari white edges)
- Overlay: rgba(0,0,0,0.6)

---

## 🔄 Jika Ingin Ganti Foto

Edit file: `resources/views/home.blade.php`

Cari baris:
```css
background-image: url('{{ asset("images/siswa-upacara.jpg") }}');
```

Ganti nama file sesuai foto baru Anda.

---

## 📞 Troubleshooting

**Foto tidak muncul?**
1. Pastikan nama file exact: `siswa-upacara.jpg`
2. Pastikan lokasi benar: `public/images/`
3. Clear cache browser: `Ctrl + F5`
4. Check console browser (F12) untuk error

**Foto terlalu blur?**
Edit CSS di `home.blade.php`:
```css
filter: blur(8px);  /* Kurangi angka untuk blur lebih sedikit */
```

**Overlay terlalu gelap?**
Edit CSS di `home.blade.php`:
```css
background: rgba(0, 0, 0, 0.6);  /* Kurangi 0.6 menjadi 0.4 untuk lebih terang */
```

---

**Dibuat:** 28 Oktober 2025  
**Status:** ✅ Ready to Upload
