# 📥 Import SQL Dump ke Railway

Dokumentasi cara mengimport data dari SQL dump MySQL ke Railway (SQLite).

---

## 🎯 Overview

Seeder `ImportSqlDumpSeeder` mengkonversi data dari SQL dump MySQL menjadi data yang kompatibel dengan SQLite menggunakan Eloquent models.

---

## 📋 Cara Menggunakan

### **Option 1: Import via Seeder (Recommended untuk Railway)**

```bash
# Jalankan seeder khusus untuk import SQL dump
php artisan db:seed --class=ImportSqlDumpSeeder
```

### **Option 2: Update DatabaseSeeder**

Edit `database/seeders/DatabaseSeeder.php`:

```php
public function run(): void
{
    // Import dari SQL dump
    $this->call([ImportSqlDumpSeeder::class]);
    
    // Atau gunakan default seeders
    // $this->call([
    //     PetugasSeeder::class,
    //     KategoriSeeder::class,
    //     PostSeeder::class,
    //     GaleriSeeder::class,
    // ]);
}
```

Kemudian jalankan:
```bash
php artisan db:seed
```

---

## 🚀 Deploy ke Railway

### **Step 1: Pastikan Migration Sudah Berjalan**

```bash
php artisan migrate
```

### **Step 2: Import Data**

```bash
php artisan db:seed --class=ImportSqlDumpSeeder
```

### **Step 3: Atau Setup di Railway**

Tambahkan di Railway build command atau startup command:

```bash
php artisan migrate --force && php artisan db:seed --class=ImportSqlDumpSeeder --force
```

---

## 📊 Data yang Diimport

Seeder ini mengimport data berikut dari SQL dump:

1. ✅ **Kategori** (6 kategori)
2. ✅ **Petugas** (2 admin)
3. ✅ **Users** (6 users)
4. ✅ **Posts** (2 posts)
5. ✅ **Galery** (45 galleries)
6. ✅ **Foto** (47 photos)
7. ✅ **Messages** (2 messages)
8. ✅ **Photo Interactions** (69 likes)
9. ✅ **Photo Comments** (4 comments)

---

## ⚙️ Fitur Seeder

### **Database Agnostic**
- ✅ Kompatibel dengan SQLite (Railway)
- ✅ Kompatibel dengan MySQL
- ✅ Kompatibel dengan PostgreSQL

### **Smart Import**
- ✅ Menggunakan `updateOrCreate()` untuk menghindari duplikasi
- ✅ Mempertahankan ID asli dari SQL dump
- ✅ Mempertahankan timestamps asli
- ✅ Menghormati foreign key relationships

### **Error Handling**
- ✅ Auto-detect database driver
- ✅ Skip jika data sudah ada
- ✅ Progress indicator

---

## 🔧 Troubleshooting

### **Error: Foreign Key Constraint**

Jika ada error foreign key, pastikan urutan import benar:
1. Kategori
2. Petugas
3. Users
4. Posts
5. Galery
6. Foto
7. Messages
8. Photo Interactions
9. Photo Comments

### **Error: Duplicate Entry**

Seeder menggunakan `updateOrCreate()`, jadi data yang sudah ada akan diupdate, bukan error.

### **Data Tidak Muncul**

1. Cek apakah migration sudah berjalan: `php artisan migrate:status`
2. Cek apakah seeder berhasil: `php artisan db:seed --class=ImportSqlDumpSeeder -v`
3. Cek database: `php artisan tinker` → `\App\Models\Galery::count()`

---

## 📝 Catatan Penting

### **File Foto**
Seeder hanya mengimport **metadata** foto ke database. File foto fisik harus diupload secara terpisah ke:
- `storage/app/public/galeri/` (untuk storage)
- `public/storage/galeri/` (untuk public access)

### **Password Hash**
Password di SQL dump sudah di-hash dengan bcrypt, jadi langsung bisa digunakan.

### **Timestamps**
Timestamps dipertahankan sesuai SQL dump asli.

---

## 🎯 Quick Start untuk Railway

```bash
# 1. Deploy code ke Railway
git push origin main

# 2. Set environment variables di Railway dashboard
# DB_CONNECTION=sqlite
# DB_DATABASE=/app/database/database.sqlite

# 3. Railway akan otomatis run:
# php artisan migrate --force
# php artisan db:seed --class=ImportSqlDumpSeeder --force
```

---

## 📚 File Terkait

- `database/seeders/ImportSqlDumpSeeder.php` - Seeder utama
- `database/seeders/DatabaseSeeder.php` - Main seeder
- `risti_ujikom (7).sql` - SQL dump source

---

## ✅ Checklist Sebelum Deploy

- [ ] Migration sudah berjalan (`php artisan migrate`)
- [ ] Seeder sudah ditest lokal (`php artisan db:seed --class=ImportSqlDumpSeeder`)
- [ ] File foto sudah diupload (jika ada)
- [ ] Environment variables sudah diset di Railway
- [ ] Database connection sudah benar

---

**Done!** Data dari SQL dump sekarang bisa diimport ke Railway dengan mudah! 🎉

