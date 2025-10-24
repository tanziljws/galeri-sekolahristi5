# 🔐 Panduan Lengkap Setup Google reCAPTCHA v2

## 📌 Daftar Isi
1. [Mendaftar reCAPTCHA di Google](#langkah-1-mendaftar-recaptcha-di-google)
2. [Konfigurasi di Laravel](#langkah-2-konfigurasi-di-laravel)
3. [Update Controller](#langkah-3-update-controller)
4. [Testing](#langkah-4-testing)
5. [Troubleshooting](#troubleshooting)

---

## Langkah 1: Mendaftar reCAPTCHA di Google

### 1.1 Buka Google reCAPTCHA Admin Console
- Kunjungi: **https://www.google.com/recaptcha/admin/create**
- Login dengan akun Google Anda

### 1.2 Isi Form Pendaftaran

**Label:**
```
Galeri Sekolah SMK Negeri 4 Bogor
```

**reCAPTCHA type:**
- Pilih: **reCAPTCHA v2**
- Pilih: **"I'm not a robot" Checkbox**

**Domains:**
Tambahkan domain-domain berikut (satu per baris):
```
127.0.0.1
localhost
smkn4bogor.sch.id
```
> **Catatan:** Tambahkan domain production Anda jika sudah ada

**Accept reCAPTCHA Terms of Service:**
- ✅ Centang checkbox

### 1.3 Submit dan Dapatkan Keys

Klik tombol **Submit**

Anda akan mendapatkan:
- **Site Key** (Public Key) - untuk frontend
- **Secret Key** (Private Key) - untuk backend

**Contoh:**
```
Site Key: 6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
Secret Key: 6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe
```

> ⚠️ **PENTING:** Simpan kedua key ini dengan aman!

---

## Langkah 2: Konfigurasi di Laravel

### 2.1 Tambahkan Keys ke File `.env`

Buka file `.env` di root project Anda dan tambahkan di bagian bawah:

```env
# Google reCAPTCHA v2
RECAPTCHA_SITE_KEY=your_site_key_here
RECAPTCHA_SECRET_KEY=your_secret_key_here
```

**Ganti dengan key Anda yang sebenarnya:**
```env
# Google reCAPTCHA v2
RECAPTCHA_SITE_KEY=6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
RECAPTCHA_SECRET_KEY=6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe
```

### 2.2 Tambahkan ke `.env.example`

Buka file `.env.example` dan tambahkan di bagian bawah:

```env
# Google reCAPTCHA v2
RECAPTCHA_SITE_KEY=
RECAPTCHA_SECRET_KEY=
```

### 2.3 Clear Config Cache

Jalankan command berikut di terminal:

```bash
php artisan config:clear
php artisan cache:clear
```

---

## Langkah 3: Update Controller

### 3.1 Buka File ContactController

File: `app/Http/Controllers/ContactController.php`

Pastikan method `store` sudah menggunakan validasi reCAPTCHA:

```php
public function store(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string',
        'g-recaptcha-response' => 'required',
    ], [
        'g-recaptcha-response.required' => 'Silakan centang reCAPTCHA untuk memverifikasi bahwa Anda bukan robot.',
    ]);

    // Verifikasi reCAPTCHA
    $recaptchaResponse = $request->input('g-recaptcha-response');
    $secretKey = env('RECAPTCHA_SECRET_KEY');

    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secretKey . '&response=' . $recaptchaResponse);
    $responseData = json_decode($verifyResponse);

    if (!$responseData->success) {
        return back()->withErrors([
            'recaptcha' => 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.'
        ])->withInput();
    }

    // Simpan data
    Contact::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'message' => $validated['message'],
    ]);

    return redirect()->route('home')
        ->with('success', 'Pesan Anda telah terkirim! Terima kasih atas masukan Anda.')
        ->with('scroll_to_testimoni', true);
}
```

---

## Langkah 4: Update View (Frontend)

### 4.1 Buka File home.blade.php

File: `resources/views/home.blade.php`

Cari bagian reCAPTCHA dan update site key:

**SEBELUM (Testing Key):**
```html
<div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
```

**SESUDAH (Production Key):**
```html
<div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
```

### 4.2 Pastikan Script reCAPTCHA Sudah Ada

Di bagian bawah file sebelum `</body>`, pastikan ada:

```html
<!-- Google reCAPTCHA v2 -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
```

---

## Langkah 5: Testing

### 5.1 Testing di Development (localhost)

1. **Restart Laravel Server:**
   ```bash
   php artisan serve
   ```

2. **Buka Browser:**
   ```
   http://127.0.0.1:8000
   ```

3. **Scroll ke Section Contact**

4. **Isi Form:**
   - Nama: Test User
   - Email: test@example.com
   - Pesan: Testing reCAPTCHA

5. **Centang reCAPTCHA:**
   - Klik checkbox "I'm not a robot"
   - Selesaikan challenge jika muncul

6. **Klik Tombol "Kirim Pesan"**

7. **Verifikasi:**
   - ✅ Pesan berhasil terkirim
   - ✅ Redirect ke halaman home
   - ✅ Muncul notifikasi sukses
   - ✅ Data tersimpan di database

### 5.2 Testing di Production

Setelah deploy ke server production:

1. **Update Domain di Google reCAPTCHA Console:**
   - Kembali ke: https://www.google.com/recaptcha/admin
   - Pilih site Anda
   - Tambahkan domain production (misal: `smkn4bogor.sch.id`)

2. **Update `.env` di Server Production:**
   ```env
   RECAPTCHA_SITE_KEY=your_production_site_key
   RECAPTCHA_SECRET_KEY=your_production_secret_key
   ```

3. **Clear Cache di Server:**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

4. **Test seperti di development**

---

## Troubleshooting

### ❌ Problem 1: reCAPTCHA tidak muncul

**Solusi:**
1. Pastikan script reCAPTCHA sudah dimuat:
   ```html
   <script src="https://www.google.com/recaptcha/api.js" async defer></script>
   ```

2. Cek Console Browser (F12) untuk error JavaScript

3. Pastikan site key benar di `.env`

4. Clear cache browser (Ctrl + Shift + Delete)

---

### ❌ Problem 2: Error "Invalid site key"

**Solusi:**
1. Periksa site key di `.env` sudah benar
2. Pastikan domain sudah terdaftar di Google reCAPTCHA Console
3. Clear config cache:
   ```bash
   php artisan config:clear
   ```

---

### ❌ Problem 3: Validasi selalu gagal

**Solusi:**
1. Periksa secret key di `.env` sudah benar
2. Pastikan koneksi internet aktif (untuk verifikasi ke Google)
3. Cek response dari Google:
   ```php
   dd($responseData); // Tambahkan di controller untuk debug
   ```

---

### ❌ Problem 4: "This reCAPTCHA is for testing purposes only"

**Solusi:**
Anda masih menggunakan testing key. Ganti dengan key production Anda sendiri.

**Testing Keys (hanya untuk development):**
- Site Key: `6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI`
- Secret Key: `6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe`

**Production Keys:**
Dapatkan dari: https://www.google.com/recaptcha/admin/create

---

### ❌ Problem 5: reCAPTCHA muncul tapi tidak bisa diklik

**Solusi:**
1. Cek z-index CSS yang mungkin menutupi reCAPTCHA
2. Pastikan tidak ada overlay/modal yang menghalangi
3. Cek CSS:
   ```css
   .g-recaptcha {
       position: relative;
       z-index: 999;
   }
   ```

---

## 📊 Monitoring reCAPTCHA

### Melihat Statistik

1. Buka: https://www.google.com/recaptcha/admin
2. Pilih site Anda
3. Lihat dashboard untuk:
   - Jumlah request
   - Success rate
   - Suspicious traffic
   - Score distribution (untuk v3)

---

## 🔒 Security Best Practices

### 1. Jangan Commit Secret Key ke Git

Pastikan `.env` ada di `.gitignore`:
```gitignore
.env
.env.backup
```

### 2. Gunakan Key yang Berbeda untuk Development dan Production

**Development (.env.local):**
```env
RECAPTCHA_SITE_KEY=dev_site_key
RECAPTCHA_SECRET_KEY=dev_secret_key
```

**Production (.env):**
```env
RECAPTCHA_SITE_KEY=prod_site_key
RECAPTCHA_SECRET_KEY=prod_secret_key
```

### 3. Validasi di Backend

Jangan hanya validasi di frontend. Selalu verifikasi di backend (controller).

---

## 📝 Checklist Setup

- [ ] Daftar di Google reCAPTCHA Console
- [ ] Dapatkan Site Key dan Secret Key
- [ ] Tambahkan keys ke `.env`
- [ ] Tambahkan keys ke `.env.example`
- [ ] Update controller untuk verifikasi
- [ ] Update view dengan site key dari env
- [ ] Clear config cache
- [ ] Testing di localhost
- [ ] Tambahkan domain production di Google Console
- [ ] Deploy ke production
- [ ] Testing di production

---

## 🎯 Hasil Akhir

Setelah setup selesai:

✅ reCAPTCHA muncul di form contact
✅ User harus centang "I'm not a robot"
✅ Verifikasi berjalan di backend
✅ Spam berkurang drastis
✅ Form lebih aman

---

## 📚 Referensi

- **Google reCAPTCHA Docs:** https://developers.google.com/recaptcha/docs/display
- **Laravel Validation:** https://laravel.com/docs/validation
- **reCAPTCHA Admin Console:** https://www.google.com/recaptcha/admin

---

## 💡 Tips

1. **Gunakan reCAPTCHA v2 Checkbox** untuk form yang tidak terlalu sering diakses
2. **Gunakan reCAPTCHA v3** untuk form yang sering diakses (invisible)
3. **Monitor statistik** di Google Console untuk melihat efektivitas
4. **Backup keys** Anda di tempat yang aman

---

**Dibuat untuk:** Galeri Sekolah SMK Negeri 4 Bogor
**Tanggal:** 22 Oktober 2025
**Versi:** 1.0
