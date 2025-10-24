# 🚀 Quick Start - Setup reCAPTCHA

## Langkah Cepat (5 Menit)

### 1️⃣ Daftar di Google reCAPTCHA
- Buka: https://www.google.com/recaptcha/admin/create
- Login dengan Google
- Isi form:
  - **Label**: Galeri SMK Negeri 4 Bogor
  - **Type**: reCAPTCHA v2 → "I'm not a robot"
  - **Domains**: 127.0.0.1, localhost
- Klik **Submit**
- **COPY** Site Key dan Secret Key

### 2️⃣ Tambahkan ke File .env
Buka file `.env` di root project, tambahkan di bawah:

```env
# Google reCAPTCHA v2
RECAPTCHA_SITE_KEY=paste_site_key_anda_disini
RECAPTCHA_SECRET_KEY=paste_secret_key_anda_disini
```

**Contoh:**
```env
RECAPTCHA_SITE_KEY=6LcXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
RECAPTCHA_SECRET_KEY=6LcYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYY
```

### 3️⃣ Clear Cache
Jalankan di terminal:

```bash
php artisan config:clear
php artisan cache:clear
```

### 4️⃣ Test
1. Restart server: `php artisan serve`
2. Buka: http://127.0.0.1:8000
3. Scroll ke form Contact
4. Isi form dan centang reCAPTCHA
5. Klik "Kirim Pesan"

✅ **SELESAI!** reCAPTCHA sudah berfungsi!

---

## 📝 Catatan Penting

### ⚠️ Jangan Gunakan Testing Key di Production!

**Testing Keys (hanya untuk development):**
```
Site Key: 6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
Secret Key: 6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe
```

**Untuk Production:**
- Daftar key baru di Google reCAPTCHA Console
- Tambahkan domain production Anda
- Update `.env` dengan key production

---

## 🔧 Troubleshooting

### reCAPTCHA tidak muncul?
1. Cek koneksi internet
2. Clear cache browser (Ctrl + Shift + Delete)
3. Pastikan site key benar di `.env`

### Validasi selalu gagal?
1. Pastikan secret key benar di `.env`
2. Jalankan `php artisan config:clear`
3. Restart server

### "Invalid site key"?
1. Pastikan domain sudah terdaftar di Google Console
2. Untuk localhost gunakan: `127.0.0.1` atau `localhost`

---

## 📚 Dokumentasi Lengkap

Lihat file: `SETUP_RECAPTCHA.md` untuk panduan detail

---

**Update Terakhir:** 22 Oktober 2025
