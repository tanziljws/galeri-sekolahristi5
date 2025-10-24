# 🎯 Setup reCAPTCHA v2 Invisible (Selalu Ada Challenge Gambar)

## 📌 Apa itu reCAPTCHA Invisible?

reCAPTCHA Invisible adalah mode yang:
- ✅ **SELALU** menampilkan challenge gambar saat submit form
- ✅ Tidak ada checkbox "I'm not a robot"
- ✅ Challenge muncul otomatis saat klik tombol submit
- ✅ User **WAJIB** menyelesaikan challenge (pilih gambar)

**Contoh Challenge:**
```
┌─────────────────────────────────────┐
│  Select all images with             │
│  taxis                              │
│  ┌───┬───┬───┐                      │
│  │ 🚕│   │   │                      │
│  ├───┼───┼───┤                      │
│  │   │ 🚕│   │                      │
│  ├───┼───┼───┤                      │
│  │   │   │ 🚕│                      │
│  └───┴───┴───┘                      │
│          [VERIFY]                   │
└─────────────────────────────────────┘
```

---

## 🚀 Langkah Setup

### **Langkah 1: Daftar reCAPTCHA v2 Invisible di Google**

1. **Buka Google reCAPTCHA Console:**
   ```
   https://www.google.com/recaptcha/admin/create
   ```

2. **Login dengan akun Google**

3. **Isi Form Pendaftaran:**
   - **Label:** `Galeri SMK Negeri 4 Bogor - Invisible`
   - **reCAPTCHA type:** Pilih **reCAPTCHA v2**
   - **Pilih:** **Invisible reCAPTCHA badge** ← PENTING!
   - **Domains:** 
     ```
     127.0.0.1
     localhost
     ```

4. **Submit**

5. **Copy Keys:**
   - **Site Key** (untuk frontend)
   - **Secret Key** (untuk backend)

---

### **Langkah 2: Update File .env**

Buka file `.env` dan **GANTI** keys yang lama dengan keys Invisible yang baru:

```env
# Google reCAPTCHA v2 Invisible
RECAPTCHA_SITE_KEY=paste_invisible_site_key_disini
RECAPTCHA_SECRET_KEY=paste_invisible_secret_key_disini
```

**Contoh:**
```env
RECAPTCHA_SITE_KEY=6LcXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
RECAPTCHA_SECRET_KEY=6LcYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYY
```

---

### **Langkah 3: Clear Cache**

Jalankan di terminal:

```bash
php artisan config:clear
php artisan cache:clear
```

---

### **Langkah 4: Restart Server**

```bash
php artisan serve
```

---

## ✅ Cara Kerja

### **Sebelum (Checkbox Mode):**
```
1. User isi form
2. User centang "I'm not a robot"
3. Kadang langsung verified ✓
4. Kadang muncul challenge gambar
5. Submit form
```

### **Sesudah (Invisible Mode):**
```
1. User isi form
2. User klik "Kirim Pesan"
3. Challenge gambar SELALU muncul ← PASTI!
4. User pilih gambar yang benar
5. Klik "Verify"
6. Form otomatis submit
```

---

## 🎯 Testing

### **Test 1: Submit Form**

1. Buka: `http://127.0.0.1:8000`
2. Scroll ke "Hubungi Kami"
3. Isi form:
   - Nama: Test User
   - Email: test@example.com
   - Pesan: Testing Invisible reCAPTCHA
4. Klik tombol **"Kirim Pesan"**

**Yang Terjadi:**
- ✅ Challenge gambar **LANGSUNG MUNCUL**
- ✅ User **WAJIB** pilih gambar
- ✅ Setelah verify, form otomatis submit

### **Test 2: Verifikasi Challenge**

**Challenge yang mungkin muncul:**
- Select all images with **taxis**
- Select all images with **traffic lights**
- Select all images with **buses**
- Select all images with **bicycles**
- Select all images with **crosswalks**
- dll.

**Cara Menyelesaikan:**
1. Klik semua gambar yang sesuai
2. Klik tombol **"VERIFY"**
3. Jika benar, form otomatis submit
4. Jika salah, challenge baru muncul

---

## 🔍 Troubleshooting

### **Problem 1: Challenge tidak muncul**

**Penyebab:**
- Masih menggunakan Site Key Checkbox (bukan Invisible)

**Solusi:**
1. Pastikan daftar **Invisible reCAPTCHA badge** di Google
2. Copy Site Key yang baru
3. Update `.env` dengan Site Key Invisible
4. Clear cache: `php artisan config:clear`

---

### **Problem 2: Error "Invalid site key"**

**Solusi:**
1. Periksa Site Key di `.env` benar
2. Pastikan tidak ada spasi atau kutip
3. Clear cache dan restart server

---

### **Problem 3: Form submit tanpa challenge**

**Penyebab:**
- JavaScript callback belum berfungsi

**Solusi:**
1. Cek Console Browser (F12)
2. Pastikan tidak ada error JavaScript
3. Pastikan script reCAPTCHA dimuat

---

## 📊 Perbandingan

| Fitur | Checkbox Mode | Invisible Mode |
|-------|---------------|----------------|
| Challenge gambar | Kadang-kadang | **SELALU** ✅ |
| User experience | Lebih mudah | Lebih aman |
| Keamanan | Baik | **Sangat baik** ✅ |
| Spam protection | Baik | **Sangat baik** ✅ |

---

## ⚠️ Catatan Penting

### **Kelebihan Invisible Mode:**
- ✅ Challenge **SELALU** muncul
- ✅ Keamanan maksimal
- ✅ Spam berkurang drastis

### **Kekurangan Invisible Mode:**
- ⚠️ User **WAJIB** menyelesaikan challenge
- ⚠️ Proses submit lebih lama
- ⚠️ Bisa mengganggu UX jika terlalu sering

---

## 🎊 Hasil Akhir

Setelah setup Invisible reCAPTCHA:

**Setiap kali user submit form:**
1. Klik "Kirim Pesan"
2. **Challenge gambar PASTI muncul** ✅
3. User pilih gambar yang benar
4. Klik "Verify"
5. Form otomatis submit

**Tidak ada cara untuk skip challenge!**

---

## 📝 Checklist

- [ ] Daftar reCAPTCHA v2 **Invisible** di Google
- [ ] Copy Site Key dan Secret Key
- [ ] Update `.env` dengan keys Invisible
- [ ] Clear cache Laravel
- [ ] Restart server
- [ ] Test di browser
- [ ] Challenge gambar muncul saat submit
- [ ] Form berhasil submit setelah verify

---

## 🔗 Referensi

- **Google reCAPTCHA Invisible Docs:**
  https://developers.google.com/recaptcha/docs/invisible

- **Google reCAPTCHA Admin:**
  https://www.google.com/recaptcha/admin

---

**Dibuat:** 22 Oktober 2025
**Status:** ✅ READY TO IMPLEMENT
**Mode:** reCAPTCHA v2 Invisible (Challenge Selalu Muncul)
