<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\MessageController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');

// Auth routes (Admin)
Route::get('/loginadmin', [AuthController::class, 'showLogin'])->name('login');
Route::post('/loginadmin', [AuthController::class, 'login']);
// Fallback route untuk /login agar redirect ke admin login
Route::get('/login', function() {
    return redirect('/loginadmin');
});
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Public Gallery page (no login) - use unique URI to avoid conflict with admin resource
Route::get('/galeri-foto', [GaleriController::class, 'public'])->name('galeri.public');

// Public Photo View (shareable link via WhatsApp/Ngrok)
Route::get('/foto/{id}', [GaleriController::class, 'showPhoto'])->name('foto.show');

// Storage file access route (fallback jika symbolic link tidak berfungsi)
Route::get('/storage-file/{path}', function ($path) {
    $filePath = storage_path('app/public/' . $path);
    
    if (!file_exists($filePath)) {
        abort(404);
    }
    
    $mimeType = mime_content_type($filePath);
    return response()->file($filePath, [
        'Content-Type' => $mimeType,
        'Cache-Control' => 'public, max-age=31536000',
    ]);
})->where('path', '.*')->name('storage.file');

// Protected routes (perlu login)
Route::middleware(['auth.check'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Admin Management Routes (Petugas CRUD)
    Route::prefix('admin')->name('admin.')->group(function () {
        // Petugas/Admin Management
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/create', [AdminController::class, 'create'])->name('create');
        Route::post('/', [AdminController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminController::class, 'destroy'])->name('destroy');
        
        // Messages Routes
        Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show');
        Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('messages.destroy');
        Route::patch('/messages/{id}/approve-testimonial', [MessageController::class, 'approveTestimonial'])->name('messages.approve-testimonial');
        Route::patch('/messages/{id}/reject-testimonial', [MessageController::class, 'rejectTestimonial'])->name('messages.reject-testimonial');
        Route::patch('/messages/{id}/reset-testimonial', [MessageController::class, 'resetTestimonialStatus'])->name('messages.reset-testimonial');
        
        // Galeri Upload Alias
        Route::get('/galeri/upload', [GaleriController::class, 'create'])->name('galeri.upload');
        
        // Galeri Dashboard
        Route::get('/galeri/dashboard', [GaleriController::class, 'dashboard'])->name('galeri.dashboard');
    });
    
    // Kategori Management Routes
    Route::resource('kategori', KategoriController::class);
    
    // Post Management Routes
    Route::resource('post', PostController::class);
    
    // Galeri Management Routes
    Route::resource('galeri', GaleriController::class);

    // Galeri Photo routes
    Route::post('galeri/{galery}/foto/{foto}', [GaleriController::class, 'updatePhoto'])->name('galeri.foto.update');
    Route::delete('galeri/{galery}/foto/{foto}', [GaleriController::class, 'destroyPhoto'])->name('galeri.foto.destroy');
    
    // Quick Upload - Upload foto cepat ke album yang sudah ada
    Route::post('galeri/{id}/quick-upload', [GaleriController::class, 'quickUpload'])->name('galeri.quick-upload');
    
    // Galeri Report Route
    Route::get('/galeri-report', [GaleriController::class, 'report'])->name('galeri.report');
});

// Jurusan Routes
Route::get('/jurusan/pplg', [App\Http\Controllers\JurusanController::class, 'pplg'])->name('jurusan.pplg');
Route::get('/jurusan/tjkt', [App\Http\Controllers\JurusanController::class, 'tjkt'])->name('jurusan.tjkt');
Route::get('/jurusan/tpfl', [App\Http\Controllers\JurusanController::class, 'tpfl'])->name('jurusan.tpfl');
Route::get('/jurusan/to', [App\Http\Controllers\JurusanController::class, 'to'])->name('jurusan.to');

// Profil Sekolah Routes
Route::get('/profil/visi-misi', function () {
    return view('profil.visi-misi');
})->name('profil.visi-misi');

Route::get('/profil/adiwiyata', function () {
    return view('profil.adiwiyata');
})->name('profil.adiwiyata');

Route::get('/profil/sejarah', function () {
    return view('profil.sejarah');
})->name('profil.sejarah');

Route::get('/profil/fasilitas', function () {
    return view('profil.fasilitas');
})->name('profil.fasilitas');



// Admin Jurusan Activities Routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('jurusan-activities', App\Http\Controllers\Admin\JurusanActivityController::class);
    Route::patch('jurusan-activities/{jurusanActivity}/toggle-status', [App\Http\Controllers\Admin\JurusanActivityController::class, 'toggleStatus'])->name('jurusan-activities.toggle-status');
    
    // School Gallery Routes (Terpisah dari jurusan activities)
    Route::resource('school-galleries', App\Http\Controllers\Admin\SchoolGalleryController::class);
    Route::patch('school-galleries/{schoolGallery}/toggle-status', [App\Http\Controllers\Admin\SchoolGalleryController::class, 'toggleStatus'])->name('school-galleries.toggle-status');
});

// Contact Form Routes
Route::post('/contact', [MessageController::class, 'store'])->name('contact.store');

// User Authentication Routes (for public users)
Route::get('/user/register', [App\Http\Controllers\Auth\UserAuthController::class, 'showRegisterForm'])->name('user.register.form');
Route::post('/user/register', [App\Http\Controllers\Auth\UserAuthController::class, 'register'])->name('user.register');
Route::get('/user/login', [App\Http\Controllers\Auth\UserAuthController::class, 'showLoginForm'])->name('user.login.form');
Route::post('/user/login', [App\Http\Controllers\Auth\UserAuthController::class, 'login'])->name('user.login');
Route::post('/user/logout', [App\Http\Controllers\Auth\UserAuthController::class, 'logout'])->name('user.logout');

// User Profile Routes (protected by session check in controller)
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
Route::put('/profile/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password');
Route::delete('/profile/photo', [App\Http\Controllers\ProfileController::class, 'deletePhoto'])->name('profile.photo.delete');



// API routes dipindah ke routes/api.php
