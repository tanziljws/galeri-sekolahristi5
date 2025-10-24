<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

// ===== COMPREHENSIVE CRUD API FOR ALL TABLES =====

// ===== AUTH HELPERS =====
Route::prefix('auth')->group(function () {
	Route::post('/seed-admin', [ApiController::class, 'seedDefaultAdmin']);
	Route::post('/login', [ApiController::class, 'loginPetugas']);
});

// ===== USERS API =====
Route::prefix('users')->group(function () {
    Route::get('/', [ApiController::class, 'getUsers']);                    // GET all users
    Route::get('/{id}', [ApiController::class, 'getUserById']);             // GET user by ID
    Route::post('/', [ApiController::class, 'createUser']);                 // POST create user
    Route::put('/{id}', [ApiController::class, 'updateUser']);              // PUT update user
    Route::delete('/{id}', [ApiController::class, 'deleteUser']);           // DELETE user
    Route::get('/{id}/posts', [ApiController::class, 'getUserPosts']);      // GET user's posts
});

// ===== PETUGAS API =====
Route::prefix('petugas')->group(function () {
    Route::get('/', [ApiController::class, 'getPetugas']);                  // GET all petugas
    Route::get('/{id}', [ApiController::class, 'getPetugasById']);          // GET petugas by ID
    Route::post('/', [ApiController::class, 'createPetugas']);              // POST create petugas
    Route::put('/{id}', [ApiController::class, 'updatePetugas']);           // PUT update petugas
    Route::delete('/{id}', [ApiController::class, 'deletePetugas']);        // DELETE petugas
    Route::get('/{id}/posts', [ApiController::class, 'getPetugasPosts']);   // GET petugas's posts
});

// ===== KATEGORI API =====
Route::prefix('kategori')->group(function () {
    Route::get('/', [ApiController::class, 'getKategori']);                 // GET all kategori
    Route::get('/{id}', [ApiController::class, 'getKategoriById']);         // GET kategori by ID
    Route::post('/', [ApiController::class, 'createKategori']);             // POST create kategori
    Route::put('/{id}', [ApiController::class, 'updateKategori']);          // PUT update kategori
    Route::delete('/{id}', [ApiController::class, 'deleteKategori']);       // DELETE kategori
    Route::get('/{id}/posts', [ApiController::class, 'getKategoriPosts']);  // GET kategori's posts
});

// ===== POSTS API =====
Route::prefix('posts')->group(function () {
    Route::get('/', [ApiController::class, 'getPosts']);                    // GET all posts
    Route::get('/{id}', [ApiController::class, 'getPostById']);             // GET post by ID
    Route::post('/', [ApiController::class, 'createPost']);                 // POST create post
    Route::put('/{id}', [ApiController::class, 'updatePost']);              // PUT update post
    Route::delete('/{id}', [ApiController::class, 'deletePost']);           // DELETE post
    Route::get('/{id}/galeries', [ApiController::class, 'getPostGaleries']); // GET post's galeries
});

// ===== PROFILES API =====
Route::prefix('profiles')->group(function () {
    Route::get('/', [ApiController::class, 'getProfiles']);                 // GET all profiles
    Route::get('/{id}', [ApiController::class, 'getProfileById']);          // GET profile by ID
    Route::post('/', [ApiController::class, 'createProfile']);              // POST create profile
    Route::put('/{id}', [ApiController::class, 'updateProfile']);           // PUT update profile
    Route::delete('/{id}', [ApiController::class, 'deleteProfile']);        // DELETE profile
});

// ===== GALERIES API =====
Route::prefix('galeries')->group(function () {
    Route::get('/', [ApiController::class, 'getGaleries']);                 // GET all galeries
    Route::get('/{id}', [ApiController::class, 'getGaleryById']);           // GET galery by ID
    Route::post('/', [ApiController::class, 'createGalery']);               // POST create galery
    Route::put('/{id}', [ApiController::class, 'updateGalery']);            // PUT update galery
    Route::delete('/{id}', [ApiController::class, 'deleteGalery']);         // DELETE galery
    Route::get('/{id}/fotos', [ApiController::class, 'getGaleryFotos']);    // GET galery's fotos
    Route::get('/category/{category}', [ApiController::class, 'getGaleriesByCategory']); // GET galeries by category
});

// ===== GALERI REPORT API =====
Route::get('/galeri/report', [ApiController::class, 'getGaleriReport']);    // GET galeri report with filters
Route::get('/galeri/{id}/comments', [ApiController::class, 'getGaleriComments']);  // GET comments for specific galery
Route::get('/galeri/{id}/likes', [ApiController::class, 'getGaleriLikes']);  // GET likes for specific galery

// ===== FOTOS API =====
Route::prefix('fotos')->group(function () {
    Route::get('/', [ApiController::class, 'getFotos']);                    // GET all fotos
    Route::get('/{id}', [ApiController::class, 'getFotoById']);             // GET foto by ID
    Route::post('/', [ApiController::class, 'createFoto']);                 // POST create foto
    Route::put('/{id}', [ApiController::class, 'updateFoto']);              // PUT update foto
    Route::delete('/{id}', [ApiController::class, 'deleteFoto']);           // DELETE foto
    Route::post('/multiple', [ApiController::class, 'createMultipleFotos']); // POST create multiple fotos
});

// ===== JURUSAN ACTIVITIES API =====
Route::prefix('jurusan-activities')->group(function () {
    Route::get('/', [ApiController::class, 'getJurusanActivities']);        // GET all jurusan activities
    Route::get('/{id}', [ApiController::class, 'getJurusanActivityById']);  // GET jurusan activity by ID
    Route::post('/', [ApiController::class, 'createJurusanActivity']);      // POST create jurusan activity
    Route::put('/{id}', [ApiController::class, 'updateJurusanActivity']);   // PUT update jurusan activity
    Route::delete('/{id}', [ApiController::class, 'deleteJurusanActivity']); // DELETE jurusan activity
    Route::get('/jurusan/{jurusan}', [ApiController::class, 'getActivitiesByJurusan']); // GET activities by jurusan
});

// ===== SCHOOL GALLERIES API =====
Route::prefix('school-galleries')->group(function () {
    Route::get('/', [ApiController::class, 'getSchoolGalleries']);          // GET all school galleries
    Route::get('/{id}', [ApiController::class, 'getSchoolGalleryById']);    // GET school gallery by ID
    Route::post('/', [ApiController::class, 'createSchoolGallery']);        // POST create school gallery
    Route::put('/{id}', [ApiController::class, 'updateSchoolGallery']);     // PUT update school gallery
    Route::delete('/{id}', [ApiController::class, 'deleteSchoolGallery']);  // DELETE school gallery
});

// ===== COMPLEX RELATIONSHIP APIs =====
Route::prefix('relationships')->group(function () {
    Route::get('/all-data', [ApiController::class, 'getAllDataWithRelations']);           // GET all data with relationships
    Route::get('/school-structure', [ApiController::class, 'getSchoolDataStructure']);    // GET school data structure
    Route::get('/data-by-relationships', [ApiController::class, 'getDataByRelationships']); // GET data by relationships
    Route::get('/dashboard-summary', [ApiController::class, 'getDashboardSummary']);       // GET dashboard summary
    Route::get('/table-relationships', [ApiController::class, 'getTableRelationships']);   // GET table relationships
});

// ===== SPECIALIZED APIs =====
Route::prefix('specialized')->group(function () {
    Route::get('/users-with-posts', [ApiController::class, 'getUsersWithPosts']);                    // GET users with posts
    Route::get('/petugas-with-posts-kategori', [ApiController::class, 'getPetugasWithPostsAndKategori']); // GET petugas with posts and kategori
    Route::get('/kategori-with-posts-petugas', [ApiController::class, 'getKategoriWithPostsAndPetugas']); // GET kategori with posts and petugas
    Route::get('/posts-with-all-relations', [ApiController::class, 'getPostsWithAllRelations']);     // GET posts with all relations
    Route::get('/galeries-with-all-relations', [ApiController::class, 'getGaleriesWithAllRelations']); // GET galeries with all relations
    Route::get('/fotos-with-all-relations', [ApiController::class, 'getFotosWithAllRelations']);     // GET fotos with all relations
});

// ===== COMPLEX CREATION APIs =====
Route::prefix('complex')->group(function () {
    Route::post('/post-with-galery-fotos', [ApiController::class, 'createPostWithGaleryAndFoto']);   // POST create post with galery and fotos
    Route::post('/multiple-fotos', [ApiController::class, 'createMultipleFotos']);                   // POST create multiple fotos
});

// ===== MESSAGES/TESTIMONI API =====
Route::prefix('messages')->group(function () {
    Route::get('/', [ApiController::class, 'getMessages']);                    // GET all messages
    Route::get('/{id}', [ApiController::class, 'getMessageById']);             // GET message by ID
    Route::post('/', [ApiController::class, 'createMessage']);                 // POST create message
    Route::delete('/{id}', [ApiController::class, 'deleteMessage']);           // DELETE message
});

// ===== TESTIMONI API =====
Route::get('/testimoni', [ApiController::class, 'getTestimoni']);              // GET public testimonials

// ===== PHOTO INTERACTIONS API =====
Route::prefix('photo')->middleware('web')->group(function () {
    Route::post('/{id}/like', [ApiController::class, 'likePhoto']);            // POST like photo
    Route::post('/{id}/dislike', [ApiController::class, 'dislikePhoto']);      // POST dislike photo
    Route::post('/{id}/comment', [ApiController::class, 'addComment']);        // POST add comment
    Route::get('/{id}/interactions', [ApiController::class, 'getPhotoInteractions']); // GET photo interactions
});


// ===== UTILITY APIs =====
Route::prefix('utility')->group(function () {
    Route::get('/database-stats', [ApiController::class, 'getDatabaseStats']);                       // GET database statistics
    Route::get('/all-data-simple', [ApiController::class, 'getAllDataSimple']);                      // GET all data in simple format
    Route::get('/search/{table}', [ApiController::class, 'searchInTable']);                          // GET search in specific table
    Route::get('/count/{table}', [ApiController::class, 'getTableCount']);                           // GET count of specific table
});

// ===== LEGACY ROUTES (for backward compatibility) =====
Route::get('/users', [ApiController::class, 'getUsers']);
Route::get('/petugas', [ApiController::class, 'getPetugas']);
Route::get('/kategori', [ApiController::class, 'getKategori']);
Route::get('/posts', [ApiController::class, 'getPosts']);
Route::get('/profiles', [ApiController::class, 'getProfiles']);
Route::get('/galeries', [ApiController::class, 'getGaleries']);
Route::get('/fotos', [ApiController::class, 'getFotos']);
Route::get('/all-data-with-relations', [ApiController::class, 'getAllDataWithRelations']);
Route::get('/school-data-structure', [ApiController::class, 'getSchoolDataStructure']);
Route::get('/data-by-relationships', [ApiController::class, 'getDataByRelationships']);
Route::get('/dashboard-summary', [ApiController::class, 'getDashboardSummary']);
Route::get('/table-relationships', [ApiController::class, 'getTableRelationships']);
Route::get('/database-stats', [ApiController::class, 'getDatabaseStats']);
Route::get('/all-data-simple', [ApiController::class, 'getAllDataSimple']);
Route::get('/users-with-posts', [ApiController::class, 'getUsersWithPosts']);
Route::get('/petugas-with-posts-kategori', [ApiController::class, 'getPetugasWithPostsAndKategori']);
Route::get('/kategori-with-posts-petugas', [ApiController::class, 'getKategoriWithPostsAndPetugas']);
Route::get('/posts-with-all-relations', [ApiController::class, 'getPostsWithAllRelations']);
Route::get('/galeries-with-all-relations', [ApiController::class, 'getGaleriesWithAllRelations']);
Route::get('/fotos-with-all-relations', [ApiController::class, 'getFotosWithAllRelations']);
Route::post('/users', [ApiController::class, 'createUser']);
Route::post('/petugas', [ApiController::class, 'createPetugas']);
Route::post('/kategori', [ApiController::class, 'createKategori']);
Route::post('/posts', [ApiController::class, 'createPost']);
Route::post('/profiles', [ApiController::class, 'createProfile']);
Route::post('/galeries', [ApiController::class, 'createGalery']);
Route::post('/fotos', [ApiController::class, 'createFoto']);
Route::post('/posts-with-galery-fotos', [ApiController::class, 'createPostWithGaleryAndFoto']);
Route::post('/multiple-fotos', [ApiController::class, 'createMultipleFotos']);
