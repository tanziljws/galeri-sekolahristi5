<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Petugas;
use App\Models\Kategori;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Galery;
use App\Models\Foto;
use App\Models\JurusanActivity;
use App\Models\SchoolGallery;
use App\Models\Message;
use App\Models\PhotoInteraction;
use App\Models\PhotoComment;
use App\Helpers\ContentFilter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{


    // ===== API INDIVIDUAL UNTUK SETIAP TABEL =====
    
    /**
     * Get all users
     */
    public function getUsers()
    {
        try {
            $users = User::all();
            return response()->json([
                'success' => true,
                'message' => 'Users retrieved successfully',
                'data' => $users,
                'count' => $users->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving users',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all petugas
     */
    public function getPetugas()
    {
        try {
            $petugas = Petugas::with(['posts'])->get();
            return response()->json([
                'success' => true,
                'message' => 'Petugas retrieved successfully',
                'data' => $petugas,
                'count' => $petugas->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving petugas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all kategori
     */
    public function getKategori()
    {
        try {
            $kategori = Kategori::with(['posts'])->get();
            return response()->json([
                'success' => true,
                'message' => 'Kategori retrieved successfully',
                'data' => $kategori,
                'count' => $kategori->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving kategori',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all posts
     */
    public function getPosts()
    {
        try {
            $posts = Post::with(['kategori', 'petugas', 'galeries.fotos'])->get();
            return response()->json([
                'success' => true,
                'message' => 'Posts retrieved successfully',
                'data' => $posts,
                'count' => $posts->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving posts',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all profiles
     */
    public function getProfiles()
    {
        try {
            $profiles = Profile::all();
            return response()->json([
                'success' => true,
                'message' => 'Profiles retrieved successfully',
                'data' => $profiles,
                'count' => $profiles->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving profiles',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all galeries
     */
    public function getGaleries()
    {
        try {
            $galeries = Galery::with(['post.kategori', 'post.petugas', 'fotos'])->get();
            return response()->json([
                'success' => true,
                'message' => 'Galeries retrieved successfully',
                'data' => $galeries,
                'count' => $galeries->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving galeries',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all fotos
     */
    public function getFotos()
    {
        try {
            $fotos = Foto::with(['galery.post.kategori', 'galery.post.petugas'])->get();
            return response()->json([
                'success' => true,
                'message' => 'Fotos retrieved successfully',
                'data' => $fotos,
                'count' => $fotos->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving fotos',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ===== API COMPLETE UNTUK SEMUA TABEL SEKALIGUS =====

    /**
     * Get all data with complete relationships
     */
    public function getAllDataWithRelations()
    {
        try {
            $data = [
                'users' => User::all(),
                'petugas' => Petugas::with(['posts'])->get(),
                'kategori' => Kategori::with(['posts'])->get(),
                'posts' => Post::with(['kategori', 'petugas', 'galeries.fotos'])->get(),
                'profiles' => Profile::all(),
                'galeries' => Galery::with(['post.kategori', 'post.petugas', 'fotos'])->get(),
                'fotos' => Foto::with(['galery.post.kategori', 'galery.post.petugas'])->get()
            ];

            $counts = [
                'users_count' => $data['users']->count(),
                'petugas_count' => $data['petugas']->count(),
                'kategori_count' => $data['kategori']->count(),
                'posts_count' => $data['posts']->count(),
                'profiles_count' => $data['profiles']->count(),
                'galeries_count' => $data['galeries']->count(),
                'fotos_count' => $data['fotos']->count()
            ];

            return response()->json([
                'success' => true,
                'message' => 'All data with relationships retrieved successfully',
                'data' => $data,
                'counts' => $counts,
                'total_records' => array_sum($counts)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving all data with relationships',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get complete school data structure
     */
    public function getSchoolDataStructure()
    {
        try {
            $schoolData = [
                'school_info' => [
                    'name' => 'SMK Negeri 4 Kota Bogor',
                    'description' => 'Sistem Galeri Sekolah Risti'
                ],
                'users' => User::all(),
                'staff' => [
                    'petugas' => Petugas::with(['posts'])->get(),
                    'total_staff' => Petugas::count()
                ],
                'content' => [
                    'kategori' => Kategori::with(['posts'])->get(),
                    'posts' => Post::with(['kategori', 'petugas', 'galeries.fotos'])->get(),
                    'total_categories' => Kategori::count(),
                    'total_posts' => Post::count()
                ],
                'media' => [
                    'galeries' => Galery::with(['post.kategori', 'post.petugas', 'fotos'])->get(),
                    'fotos' => Foto::with(['galery.post.kategori', 'galery.post.petugas'])->get(),
                    'total_galeries' => Galery::count(),
                    'total_fotos' => Foto::count()
                ],
                'profiles' => Profile::all()
            ];

            return response()->json([
                'success' => true,
                'message' => 'Complete school data structure retrieved successfully',
                'data' => $schoolData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving school data structure',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get data by specific relationships
     */
    public function getDataByRelationships()
    {
        try {
            $relationships = [
                'posts_with_full_info' => Post::with([
                    'kategori', 
                    'petugas', 
                    'galeries.fotos'
                ])->get(),
                
                'galeries_with_full_info' => Galery::with([
                    'post.kategori', 
                    'post.petugas', 
                    'fotos'
                ])->get(),
                
                'fotos_with_full_info' => Foto::with([
                    'galery.post.kategori', 
                    'galery.post.petugas'
                ])->get(),
                
                'users_simple' => User::all(),
                
                'petugas_with_posts' => Petugas::with([
                    'posts.kategori', 
                    'posts.galeries.fotos'
                ])->get(),
                
                'kategori_with_posts' => Kategori::with([
                    'posts.petugas', 
                    'posts.galeries.fotos'
                ])->get()
            ];

            return response()->json([
                'success' => true,
                'message' => 'Data by relationships retrieved successfully',
                'data' => $relationships
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving data by relationships',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get dashboard summary with relationships
     */
    public function getDashboardSummary()
    {
        try {
            $summary = [
                'overview' => [
                    'total_users' => User::count(),
                    'total_staff' => Petugas::count(),
                    'total_categories' => Kategori::count(),
                    'total_posts' => Post::count(),
                    'total_galeries' => Galery::count(),
                    'total_fotos' => Foto::count()
                ],
                'recent_activities' => [
                    'latest_posts' => Post::with(['kategori', 'petugas'])->latest()->take(5)->get(),
                    'latest_galeries' => Galery::with(['post.kategori'])->latest()->take(5)->get(),
                    'latest_fotos' => Foto::with(['galery.post'])->latest()->take(5)->get()
                ],
                'content_distribution' => [
                    'posts_by_category' => Kategori::withCount('posts')->get(),
                    'galeries_by_post' => Post::withCount('galeries')->get(),
                    'fotos_by_galery' => Galery::withCount('fotos')->get()
                ],
                'staff_contributions' => [
                    'posts_by_petugas' => Petugas::withCount('posts')->get(),
                    'petugas_with_most_posts' => Petugas::withCount('posts')->orderBy('posts_count', 'desc')->take(5)->get()
                ]
            ];

            return response()->json([
                'success' => true,
                'message' => 'Dashboard summary retrieved successfully',
                'data' => $summary
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving dashboard summary',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get complete table relationships
     */
    public function getTableRelationships()
    {
        try {
            $relationships = [
                'table_structure' => [
                    'users' => [
                        'description' => 'Tabel untuk menyimpan data user/admin',
                        'fields' => ['id', 'name', 'email', 'password', 'created_at', 'updated_at']
                    ],
                    'petugas' => [
                        'has_many' => 'posts',
                        'description' => 'Tabel untuk menyimpan data petugas/staff',
                        'fields' => ['id', 'username', 'password', 'email', 'created_at', 'updated_at']
                    ],
                    'kategori' => [
                        'has_many' => 'posts',
                        'description' => 'Tabel untuk menyimpan kategori post',
                        'fields' => ['id', 'nama', 'deskripsi', 'created_at', 'updated_at']
                    ],
                    'posts' => [
                        'belongs_to' => ['kategori', 'petugas'],
                        'has_many' => 'galeries',
                        'description' => 'Tabel untuk menyimpan artikel/berita',
                        'fields' => ['id', 'judul', 'isi', 'status', 'kategori_id', 'petugas_id', 'created_at', 'updated_at']
                    ],
                    'galeries' => [
                        'belongs_to' => 'post',
                        'has_many' => 'fotos',
                        'description' => 'Tabel untuk menyimpan album galeri',
                        'fields' => ['id', 'nama', 'deskripsi', 'status', 'post_id', 'created_at', 'updated_at']
                    ],
                    'fotos' => [
                        'belongs_to' => 'galery',
                        'description' => 'Tabel untuk menyimpan foto dalam galeri',
                        'fields' => ['id', 'judul', 'file', 'deskripsi', 'galery_id', 'created_at', 'updated_at']
                    ],
                    'profiles' => [
                        'description' => 'Tabel untuk menyimpan profil sekolah',
                        'fields' => ['id', 'judul', 'isi', 'created_at', 'updated_at']
                    ]
                ],
                'data_with_relations' => [
                    'users_simple' => User::all(),
                    'petugas_with_posts' => Petugas::with(['posts.kategori'])->get(),
                    'kategori_with_posts' => Kategori::with(['posts.petugas'])->get(),
                    'posts_with_all_relations' => Post::with(['kategori', 'petugas', 'galeries.fotos'])->get(),
                    'galeries_with_all_relations' => Galery::with(['post.kategori', 'post.petugas', 'fotos'])->get(),
                    'fotos_with_all_relations' => Foto::with(['galery.post.kategori', 'galery.post.petugas'])->get()
                ]
            ];

            return response()->json([
                'success' => true,
                'message' => 'Table relationships retrieved successfully',
                'data' => $relationships
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving table relationships',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ===== API TAMBAHAN UNTUK TESTING =====

    /**
     * Get database statistics
     */
    public function getDatabaseStats()
    {
        try {
            $stats = [
                'total_records' => [
                    'users' => User::count(),
                    'petugas' => Petugas::count(),
                    'kategori' => Kategori::count(),
                    'posts' => Post::count(),
                    'profiles' => Profile::count(),
                    'galeries' => Galery::count(),
                    'fotos' => Foto::count()
                ],
                'latest_records' => [
                    'latest_user' => User::latest()->first(),
                    'latest_petugas' => Petugas::latest()->first(),
                    'latest_kategori' => Kategori::latest()->first(),
                    'latest_post' => Post::latest()->first(),
                    'latest_galery' => Galery::latest()->first(),
                    'latest_foto' => Foto::latest()->first()
                ],
                'table_info' => [
                    'users_table' => 'Tabel untuk menyimpan data user/admin',
                    'petugas_table' => 'Tabel untuk menyimpan data petugas/staff',
                    'kategori_table' => 'Tabel untuk menyimpan kategori post',
                    'posts_table' => 'Tabel untuk menyimpan artikel/berita',
                    'profiles_table' => 'Tabel untuk menyimpan profil sekolah',
                    'galeries_table' => 'Tabel untuk menyimpan album galeri',
                    'fotos_table' => 'Tabel untuk menyimpan foto dalam galeri'
                ]
            ];

            return response()->json([
                'success' => true,
                'message' => 'Database statistics retrieved successfully',
                'data' => $stats
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving database statistics',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all data in simple format
     */
    public function getAllDataSimple()
    {
        try {
            $data = [
                'users' => User::select('id', 'name', 'email', 'created_at')->get(),
                'petugas' => Petugas::select('id', 'username', 'email', 'created_at')->get(),
                'kategori' => Kategori::select('id', 'nama', 'deskripsi', 'created_at')->get(),
                'posts' => Post::select('id', 'judul', 'status', 'created_at')->get(),
                'profiles' => Profile::select('id', 'judul', 'isi', 'created_at')->get(),
                'galeries' => Galery::select('id', 'nama', 'deskripsi', 'status', 'created_at')->get(),
                'fotos' => Foto::select('id', 'judul', 'file', 'deskripsi', 'created_at')->get()
            ];

            return response()->json([
                'success' => true,
                'message' => 'All data in simple format retrieved successfully',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving all data in simple format',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ===== API KHUSUS UNTUK SETIAP TABEL =====

    /**
     * Get users with their posts
     */
    public function getUsersWithPosts()
    {
        try {
            $users = User::with(['posts'])->get();
            return response()->json([
                'success' => true,
                'message' => 'Users with posts retrieved successfully',
                'data' => $users,
                'count' => $users->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving users with posts',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get petugas with their posts and kategori
     */
    public function getPetugasWithPostsAndKategori()
    {
        try {
            $petugas = Petugas::with(['posts.kategori'])->get();
            return response()->json([
                'success' => true,
                'message' => 'Petugas with posts and kategori retrieved successfully',
                'data' => $petugas,
                'count' => $petugas->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving petugas with posts and kategori',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get kategori with their posts and petugas
     */
    public function getKategoriWithPostsAndPetugas()
    {
        try {
            $kategori = Kategori::with(['posts.petugas'])->get();
            return response()->json([
                'success' => true,
                'message' => 'Kategori with posts and petugas retrieved successfully',
                'data' => $kategori,
                'count' => $kategori->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving kategori with posts and petugas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get posts with all relationships
     */
    public function getPostsWithAllRelations()
    {
        try {
            $posts = Post::with(['kategori', 'petugas', 'galeries.fotos'])->get();
            return response()->json([
                'success' => true,
                'message' => 'Posts with all relationships retrieved successfully',
                'data' => $posts,
                'count' => $posts->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving posts with all relationships',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get galeries with all relationships
     */
    public function getGaleriesWithAllRelations()
    {
        try {
            $galeries = Galery::with(['post.kategori', 'post.petugas', 'fotos'])->get();
            return response()->json([
                'success' => true,
                'message' => 'Galeries with all relationships retrieved successfully',
                'data' => $galeries,
                'count' => $galeries->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving galeries with all relationships',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get fotos with all relationships
     */
    public function getFotosWithAllRelations()
    {
        try {
            $fotos = Foto::with(['galery.post.kategori', 'galery.post.petugas'])->get();
            return response()->json([
                'success' => true,
                'message' => 'Fotos with all relationships retrieved successfully',
                'data' => $fotos,
                'count' => $fotos->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving fotos with all relationships',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ===== API POST UNTUK MEMBUAT DATA BARU =====

    /**
     * Create new user
     */
    public function createUser(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6'
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
                'data' => $user
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create new petugas
     */
    public function createPetugas(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|string|max:255|unique:petugas,username',
                'email' => 'required|email|unique:petugas,email',
                'password' => 'required|string|min:6'
            ]);

            $petugas = Petugas::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Petugas created successfully',
                'data' => $petugas
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating petugas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create new kategori
     */
    public function createKategori(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required|string|max:255'
            ]);

            $kategori = Kategori::create([
                'judul' => $request->judul
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Kategori created successfully',
                'data' => $kategori
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating kategori',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create new post
     */
    public function createPost(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'isi' => 'required|string',
                'status' => 'required|in:draft,published',
                'kategori_id' => 'required|exists:kategori,id',
                'petugas_id' => 'required|exists:petugas,id'
            ]);

            $post = Post::create([
                'judul' => $request->judul,
                'isi' => $request->isi,
                'status' => $request->status,
                'kategori_id' => $request->kategori_id,
                'petugas_id' => $request->petugas_id
            ]);

            // Load relationships
            $post->load(['kategori', 'petugas']);

            return response()->json([
                'success' => true,
                'message' => 'Post created successfully',
                'data' => $post
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating post',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create new profile
     */
    public function createProfile(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'isi' => 'required|string'
            ]);

            $profile = Profile::create([
                'judul' => $request->judul,
                'isi' => $request->isi
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Profile created successfully',
                'data' => $profile
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating profile',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create new galery
     */
    public function createGalery(Request $request)
    {
        try {
            // Sesuai schema: galery => post_id, position (int), status (int)
            $request->validate([
                'post_id' => 'required|exists:posts,id',
                'position' => 'required|integer',
                'status' => 'required|integer'
            ]);

            $galery = Galery::create([
                'post_id' => $request->post_id,
                'position' => $request->position,
                'status' => $request->status
            ]);

            // Load relationships
            $galery->load(['post.kategori', 'post.petugas']);

            return response()->json([
                'success' => true,
                'message' => 'Galery created successfully',
                'data' => $galery
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating galery',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create new foto
     */
    public function createFoto(Request $request)
    {
        try {
            // Sesuai schema: foto => galery_id, file, judul
            $request->validate([
                'judul' => 'required|string|max:255',
                'galery_id' => 'required|exists:galery,id',
                'file' => 'required|string|max:255'
            ]);

            $foto = Foto::create([
                'judul' => $request->judul,
                'galery_id' => $request->galery_id,
                'file' => $request->file
            ]);

            // Load relationships
            $foto->load(['galery.post.kategori', 'galery.post.petugas']);

            return response()->json([
                'success' => true,
                'message' => 'Foto created successfully',
                'data' => $foto
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating foto',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ===== API POST UNTUK MEMBUAT DATA DENGAN RELASI =====

    /**
     * Get galeri report with filters
     */
    public function getGaleriReport(Request $request)
    {
        try {
            $period = $request->get('period', 'all');
            $category = $request->get('category', 'all');
            $status = $request->get('status', 'all');

            // Build query
            $query = Galery::with(['post', 'fotos']);

            // Apply filters
            if ($category !== 'all') {
                $query->where('category', $category);
            }

            if ($status !== 'all') {
                $query->where('status', $status);
            }

            // Apply period filter
            switch ($period) {
                case 'today':
                    $query->whereDate('created_at', today());
                    break;
                case 'week':
                    $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'month':
                    $query->whereMonth('created_at', now()->month)
                          ->whereYear('created_at', now()->year);
                    break;
                case 'year':
                    $query->whereYear('created_at', now()->year);
                    break;
            }

            $galeries = $query->orderBy('created_at', 'desc')->get();

            // Get all foto IDs from all galeries
            $allFotoIds = $galeries->flatMap(function($g) { 
                return $g->fotos->pluck('id'); 
            })->toArray();

            // Calculate statistics
            $statistics = [
                'total_albums' => $galeries->count(),
                'total_photos' => $galeries->sum(function($g) { return $g->fotos->count(); }),
                'total_likes' => !empty($allFotoIds) ? PhotoInteraction::whereIn('foto_id', $allFotoIds)->where('type', 'like')->count() : 0,
                'total_comments' => !empty($allFotoIds) ? PhotoComment::whereIn('foto_id', $allFotoIds)->count() : 0
            ];

            // Format data for report
            $reportData = $galeries->map(function($galery) {
                $fotoIds = $galery->fotos->pluck('id');
                
                return [
                    'id' => $galery->id,
                    'title' => $galery->post->judul ?? 'Tanpa Judul',
                    'category' => $galery->category ?? 'umum',
                    'photos_count' => $galery->fotos->count(),
                    'likes_count' => PhotoInteraction::whereIn('foto_id', $fotoIds)->where('type', 'like')->count(),
                    'comments_count' => PhotoComment::whereIn('foto_id', $fotoIds)->count(),
                    'status' => $galery->status,
                    'created_at' => $galery->created_at
                ];
            });

            return response()->json([
                'success' => true,
                'message' => 'Galeri report retrieved successfully',
                'data' => $reportData,
                'statistics' => $statistics
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving galeri report',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get comments for a specific galery
     */
    public function getGaleriComments($id)
    {
        try {
            $galery = Galery::with(['fotos'])->findOrFail($id);
            
            // Get all foto IDs from this galery
            $fotoIds = $galery->fotos->pluck('id');
            
            // Get all comments for these fotos
            $comments = PhotoComment::with(['foto'])
                ->whereIn('foto_id', $fotoIds)
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function($comment) {
                    return [
                        'id' => $comment->id,
                        'name' => $comment->name,
                        'email' => $comment->email,
                        'comment' => $comment->comment,
                        'status' => $comment->status,
                        'foto_title' => $comment->foto->judul ?? null,
                        'created_at' => $comment->created_at
                    ];
                });

            return response()->json([
                'success' => true,
                'message' => 'Comments retrieved successfully',
                'data' => $comments,
                'count' => $comments->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving comments',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get likes for a specific galery
     */
    public function getGaleriLikes($id)
    {
        try {
            $galery = Galery::with(['fotos'])->findOrFail($id);
            
            // Get all foto IDs from this galery
            $fotoIds = $galery->fotos->pluck('id');
            
            // Get all likes for these fotos
            $likes = PhotoInteraction::with(['foto'])
                ->whereIn('foto_id', $fotoIds)
                ->where('type', 'like')
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function($like) {
                    // Try to get user info, fallback to session or IP
                    $userName = 'Anonymous';
                    $userEmail = null;
                    
                    if ($like->user_id) {
                        $user = User::find($like->user_id);
                        if ($user) {
                            $userName = $user->name;
                            $userEmail = $user->email;
                        }
                    } else if ($like->session_id) {
                        $userName = 'Guest (' . substr($like->session_id, 0, 8) . ')';
                    } else if ($like->ip_address) {
                        $userName = 'Guest (' . $like->ip_address . ')';
                    }
                    
                    return [
                        'id' => $like->id,
                        'user_name' => $userName,
                        'user_email' => $userEmail,
                        'foto_title' => $like->foto->judul ?? 'Tanpa Judul',
                        'created_at' => $like->created_at
                    ];
                });

            return response()->json([
                'success' => true,
                'message' => 'Likes retrieved successfully',
                'data' => $likes,
                'count' => $likes->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving likes',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create post with galery and foto
     */
    public function createPostWithGaleryAndFoto(Request $request)
    {
        try {
            $request->validate([
                'post' => 'required|array',
                'post.judul' => 'required|string|max:255',
                'post.isi' => 'required|string',
                'post.status' => 'required|in:draft,published',
                'post.kategori_id' => 'required|exists:kategori,id',
                'post.petugas_id' => 'required|exists:petugas,id',
                'galery' => 'required|array',
                'galery.position' => 'required|integer',
                'galery.status' => 'required|integer',
                'fotos' => 'array',
                'fotos.*.judul' => 'required|string|max:255',
                'fotos.*.file' => 'required|string|max:255'
            ]);

            // Create post
            $post = Post::create($request->post);
            
            // Create galery
            $galery = Galery::create([
                'position' => $request->galery['position'],
                'status' => $request->galery['status'],
                'post_id' => $post->id
            ]);

            // Create fotos
            $fotos = [];
            if ($request->has('fotos')) {
                foreach ($request->fotos as $fotoData) {
                    $foto = Foto::create([
                        'judul' => $fotoData['judul'],
                        'file' => $fotoData['file'],
                        'galery_id' => $galery->id
                    ]);
                    $fotos[] = $foto;
                }
            }

            // Load all relationships
            $post->load(['kategori', 'petugas', 'galeries.fotos']);

            return response()->json([
                'success' => true,
                'message' => 'Post with galery and fotos created successfully',
                'data' => [
                    'post' => $post,
                    'galery' => $galery,
                    'fotos' => $fotos
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating post with galery and fotos',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create multiple fotos for a galery
     */
    public function createMultipleFotos(Request $request)
    {
        try {
            $request->validate([
                'galery_id' => 'required|exists:galery,id',
                'fotos' => 'required|array|min:1',
                'fotos.*.judul' => 'required|string|max:255',
                'fotos.*.deskripsi' => 'nullable|string',
                'fotos.*.file' => 'required|string|max:255'
            ]);

            $fotos = [];
            foreach ($request->fotos as $fotoData) {
                $foto = Foto::create([
                    'judul' => $fotoData['judul'],
                    'deskripsi' => $fotoData['deskripsi'],
                    'file' => $fotoData['file'],
                    'galery_id' => $request->galery_id
                ]);
                $fotos[] = $foto;
            }

            // Load galery with fotos
            $galery = Galery::with(['post.kategori', 'post.petugas', 'fotos'])->find($request->galery_id);

            return response()->json([
                'success' => true,
                'message' => count($fotos) . ' fotos created successfully',
                'data' => [
                    'galery' => $galery,
                    'new_fotos' => $fotos
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating multiple fotos',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ===== NEW CRUD METHODS FOR ALL TABLES =====

    // ===== USERS CRUD =====
    
    /**
     * Get user by ID
     */
    public function getUserById($id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'User retrieved successfully',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update user
     */
    public function updateUser(Request $request, $id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|email|unique:users,email,' . $id,
                'password' => 'sometimes|required|string|min:6'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $updateData = $request->only(['name', 'email']);
            if ($request->has('password')) {
                $updateData['password'] = bcrypt($request->password);
            }

            $user->update($updateData);

            return response()->json([
                'success' => true,
                'message' => 'User updated successfully',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete user
     */
    public function deleteUser($id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }

            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user's posts
     */
    public function getUserPosts($id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }

            $posts = $user->posts()->with(['kategori', 'petugas'])->get();

            return response()->json([
                'success' => true,
                'message' => 'User posts retrieved successfully',
                'data' => $posts,
                'count' => $posts->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving user posts',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ===== PETUGAS CRUD =====

    /**
     * Get petugas by ID
     */
    public function getPetugasById($id)
    {
        try {
            $petugas = Petugas::with(['posts'])->find($id);
            if (!$petugas) {
                return response()->json([
                    'success' => false,
                    'message' => 'Petugas not found'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Petugas retrieved successfully',
                'data' => $petugas
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving petugas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update petugas
     */
    public function updatePetugas(Request $request, $id)
    {
        try {
            $petugas = Petugas::find($id);
            if (!$petugas) {
                return response()->json([
                    'success' => false,
                    'message' => 'Petugas not found'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'username' => 'sometimes|required|string|max:255|unique:petugas,username,' . $id,
                'email' => 'sometimes|required|email|unique:petugas,email,' . $id,
                'password' => 'sometimes|required|string|min:6'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $updateData = $request->only(['username', 'email']);
            if ($request->has('password')) {
                $updateData['password'] = bcrypt($request->password);
            }

            $petugas->update($updateData);

            return response()->json([
                'success' => true,
                'message' => 'Petugas updated successfully',
                'data' => $petugas
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating petugas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete petugas
     */
    public function deletePetugas($id)
    {
        try {
            $petugas = Petugas::find($id);
            if (!$petugas) {
                return response()->json([
                    'success' => false,
                    'message' => 'Petugas not found'
                ], 404);
            }

            $petugas->delete();

            return response()->json([
                'success' => true,
                'message' => 'Petugas deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting petugas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get petugas's posts
     */
    public function getPetugasPosts($id)
    {
        try {
            $petugas = Petugas::find($id);
            if (!$petugas) {
                return response()->json([
                    'success' => false,
                    'message' => 'Petugas not found'
                ], 404);
            }

            $posts = $petugas->posts()->with(['kategori'])->get();

            return response()->json([
                'success' => true,
                'message' => 'Petugas posts retrieved successfully',
                'data' => $posts,
                'count' => $posts->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving petugas posts',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ===== KATEGORI CRUD =====

    /**
     * Get kategori by ID
     */
    public function getKategoriById($id)
    {
        try {
            $kategori = Kategori::with(['posts'])->find($id);
            if (!$kategori) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kategori not found'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Kategori retrieved successfully',
                'data' => $kategori
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving kategori',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update kategori
     */
    public function updateKategori(Request $request, $id)
    {
        try {
            $kategori = Kategori::find($id);
            if (!$kategori) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kategori not found'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'judul' => 'required|string|max:255'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $kategori->update($request->only(['judul']));

            return response()->json([
                'success' => true,
                'message' => 'Kategori updated successfully',
                'data' => $kategori
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating kategori',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete kategori
     */
    public function deleteKategori($id)
    {
        try {
            $kategori = Kategori::find($id);
            if (!$kategori) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kategori not found'
                ], 404);
            }

            $kategori->delete();

            return response()->json([
                'success' => true,
                'message' => 'Kategori deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting kategori',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get kategori's posts
     */
    public function getKategoriPosts($id)
    {
        try {
            $kategori = Kategori::find($id);
            if (!$kategori) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kategori not found'
                ], 404);
            }

            $posts = $kategori->posts()->with(['petugas'])->get();

            return response()->json([
                'success' => true,
                'message' => 'Kategori posts retrieved successfully',
                'data' => $posts,
                'count' => $posts->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving kategori posts',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ===== POSTS CRUD =====

    /**
     * Get post by ID
     */
    public function getPostById($id)
    {
        try {
            $post = Post::with(['kategori', 'petugas', 'galeries.fotos'])->find($id);
            if (!$post) {
                return response()->json([
                    'success' => false,
                    'message' => 'Post not found'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Post retrieved successfully',
                'data' => $post
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving post',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update post
     */
    public function updatePost(Request $request, $id)
    {
        try {
            $post = Post::find($id);
            if (!$post) {
                return response()->json([
                    'success' => false,
                    'message' => 'Post not found'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'judul' => 'sometimes|required|string|max:255',
                'isi' => 'sometimes|required|string',
                'status' => 'sometimes|required|in:draft,published',
                'kategori_id' => 'sometimes|required|exists:kategori,id',
                'petugas_id' => 'sometimes|required|exists:petugas,id'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $post->update($request->only(['judul', 'isi', 'status', 'kategori_id', 'petugas_id']));
            $post->load(['kategori', 'petugas']);

            return response()->json([
                'success' => true,
                'message' => 'Post updated successfully',
                'data' => $post
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating post',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete post
     */
    public function deletePost($id)
    {
        try {
            $post = Post::find($id);
            if (!$post) {
                return response()->json([
                    'success' => false,
                    'message' => 'Post not found'
                ], 404);
            }

            $post->delete();

            return response()->json([
                'success' => true,
                'message' => 'Post deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting post',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get post's galeries
     */
    public function getPostGaleries($id)
    {
        try {
            $post = Post::find($id);
            if (!$post) {
                return response()->json([
                    'success' => false,
                    'message' => 'Post not found'
                ], 404);
            }

            $galeries = $post->galeries()->with(['fotos'])->get();

            return response()->json([
                'success' => true,
                'message' => 'Post galeries retrieved successfully',
                'data' => $galeries,
                'count' => $galeries->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving post galeries',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ===== PROFILES CRUD =====

    /**
     * Get profile by ID
     */
    public function getProfileById($id)
    {
        try {
            $profile = Profile::find($id);
            if (!$profile) {
                return response()->json([
                    'success' => false,
                    'message' => 'Profile not found'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Profile retrieved successfully',
                'data' => $profile
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving profile',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update profile
     */
    public function updateProfile(Request $request, $id)
    {
        try {
            $profile = Profile::find($id);
            if (!$profile) {
                return response()->json([
                    'success' => false,
                    'message' => 'Profile not found'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'judul' => 'sometimes|required|string|max:255',
                'isi' => 'sometimes|required|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $profile->update($request->only(['judul', 'isi']));

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully',
                'data' => $profile
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating profile',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete profile
     */
    public function deleteProfile($id)
    {
        try {
            $profile = Profile::find($id);
            if (!$profile) {
                return response()->json([
                    'success' => false,
                    'message' => 'Profile not found'
                ], 404);
            }

            $profile->delete();

            return response()->json([
                'success' => true,
                'message' => 'Profile deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting profile',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ===== GALERIES CRUD =====

    /**
     * Get galery by ID
     */
    public function getGaleryById($id)
    {
        try {
            $galery = Galery::with(['post.kategori', 'post.petugas', 'fotos'])->find($id);
            if (!$galery) {
                return response()->json([
                    'success' => false,
                    'message' => 'Galery not found'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Galery retrieved successfully',
                'data' => $galery
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving galery',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update galery
     */
    public function updateGalery(Request $request, $id)
    {
        try {
            $galery = Galery::find($id);
            if (!$galery) {
                return response()->json([
                    'success' => false,
                    'message' => 'Galery not found'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'post_id' => 'sometimes|required|exists:posts,id',
                'position' => 'sometimes|required|integer',
                'status' => 'sometimes|required|integer',
                'category' => 'sometimes|required|in:umum,pplg,tjkt,tpfl,to,transforkrab'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $galery->update($request->only(['post_id', 'position', 'status', 'category']));
            $galery->load(['post.kategori', 'post.petugas', 'fotos']);

            return response()->json([
                'success' => true,
                'message' => 'Galery updated successfully',
                'data' => $galery
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating galery',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete galery
     */
    public function deleteGalery($id)
    {
        try {
            $galery = Galery::find($id);
            if (!$galery) {
                return response()->json([
                    'success' => false,
                    'message' => 'Galery not found'
                ], 404);
            }

            $galery->delete();

            return response()->json([
                'success' => true,
                'message' => 'Galery deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting galery',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get galery's fotos
     */
    public function getGaleryFotos($id)
    {
        try {
            $galery = Galery::find($id);
            if (!$galery) {
                return response()->json([
                    'success' => false,
                    'message' => 'Galery not found'
                ], 404);
            }

            $fotos = $galery->fotos;

            return response()->json([
                'success' => true,
                'message' => 'Galery fotos retrieved successfully',
                'data' => $fotos,
                'count' => $fotos->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving galery fotos',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get galeries by category
     */
    public function getGaleriesByCategory($category)
    {
        try {
            $galeries = Galery::with(['post.kategori', 'post.petugas', 'fotos'])
                ->where('category', $category)
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Galeries by category retrieved successfully',
                'data' => $galeries,
                'count' => $galeries->count(),
                'category' => $category
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving galeries by category',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ===== FOTOS CRUD =====

    /**
     * Get foto by ID
     */
    public function getFotoById($id)
    {
        try {
            $foto = Foto::with(['galery.post.kategori', 'galery.post.petugas'])->find($id);
            if (!$foto) {
                return response()->json([
                    'success' => false,
                    'message' => 'Foto not found'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Foto retrieved successfully',
                'data' => $foto
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving foto',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update foto
     */
    public function updateFoto(Request $request, $id)
    {
        try {
            $foto = Foto::find($id);
            if (!$foto) {
                return response()->json([
                    'success' => false,
                    'message' => 'Foto not found'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'judul' => 'sometimes|required|string|max:255',
                'file' => 'sometimes|required|string|max:255',
                'galery_id' => 'sometimes|required|exists:galery,id'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $foto->update($request->only(['judul', 'file', 'galery_id']));
            $foto->load(['galery.post.kategori', 'galery.post.petugas']);

            return response()->json([
                'success' => true,
                'message' => 'Foto updated successfully',
                'data' => $foto
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating foto',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete foto
     */
    public function deleteFoto($id)
    {
        try {
            $foto = Foto::find($id);
            if (!$foto) {
                return response()->json([
                    'success' => false,
                    'message' => 'Foto not found'
                ], 404);
            }

            $foto->delete();

            return response()->json([
                'success' => true,
                'message' => 'Foto deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting foto',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ===== JURUSAN ACTIVITIES CRUD =====

    /**
     * Get all jurusan activities
     */
    public function getJurusanActivities()
    {
        try {
            $activities = JurusanActivity::all();
            return response()->json([
                'success' => true,
                'message' => 'Jurusan activities retrieved successfully',
                'data' => $activities,
                'count' => $activities->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving jurusan activities',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get jurusan activity by ID
     */
    public function getJurusanActivityById($id)
    {
        try {
            $activity = JurusanActivity::find($id);
            if (!$activity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Jurusan activity not found'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Jurusan activity retrieved successfully',
                'data' => $activity
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving jurusan activity',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create jurusan activity
     */
    public function createJurusanActivity(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'jurusan' => 'required|in:PPLG,TJKT,TPFL,TO',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'image_path' => 'required|string|max:255',
                'activity_type' => 'required|string|max:255',
                'activity_date' => 'required|date',
                'is_active' => 'boolean'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $activity = JurusanActivity::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Jurusan activity created successfully',
                'data' => $activity
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating jurusan activity',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update jurusan activity
     */
    public function updateJurusanActivity(Request $request, $id)
    {
        try {
            $activity = JurusanActivity::find($id);
            if (!$activity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Jurusan activity not found'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'jurusan' => 'sometimes|required|in:PPLG,TJKT,TPFL,TO',
                'title' => 'sometimes|required|string|max:255',
                'description' => 'sometimes|required|string',
                'image_path' => 'sometimes|required|string|max:255',
                'activity_type' => 'sometimes|required|string|max:255',
                'activity_date' => 'sometimes|required|date',
                'is_active' => 'boolean'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $activity->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Jurusan activity updated successfully',
                'data' => $activity
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating jurusan activity',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete jurusan activity
     */
    public function deleteJurusanActivity($id)
    {
        try {
            $activity = JurusanActivity::find($id);
            if (!$activity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Jurusan activity not found'
                ], 404);
            }

            $activity->delete();

            return response()->json([
                'success' => true,
                'message' => 'Jurusan activity deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting jurusan activity',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get activities by jurusan
     */
    public function getActivitiesByJurusan($jurusan)
    {
        try {
            $activities = JurusanActivity::where('jurusan', $jurusan)
                ->where('is_active', true)
                ->orderBy('activity_date', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Activities by jurusan retrieved successfully',
                'data' => $activities,
                'count' => $activities->count(),
                'jurusan' => $jurusan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving activities by jurusan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ===== SCHOOL GALLERIES CRUD =====

    /**
     * Get all school galleries
     */
    public function getSchoolGalleries()
    {
        try {
            $galleries = SchoolGallery::all();
            return response()->json([
                'success' => true,
                'message' => 'School galleries retrieved successfully',
                'data' => $galleries,
                'count' => $galleries->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving school galleries',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get school gallery by ID
     */
    public function getSchoolGalleryById($id)
    {
        try {
            $gallery = SchoolGallery::find($id);
            if (!$gallery) {
                return response()->json([
                    'success' => false,
                    'message' => 'School gallery not found'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'School gallery retrieved successfully',
                'data' => $gallery
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving school gallery',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create school gallery
     */
    public function createSchoolGallery(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'image_path' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'is_active' => 'boolean'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $gallery = SchoolGallery::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'School gallery created successfully',
                'data' => $gallery
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating school gallery',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update school gallery
     */
    public function updateSchoolGallery(Request $request, $id)
    {
        try {
            $gallery = SchoolGallery::find($id);
            if (!$gallery) {
                return response()->json([
                    'success' => false,
                    'message' => 'School gallery not found'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'title' => 'sometimes|required|string|max:255',
                'description' => 'sometimes|required|string',
                'image_path' => 'sometimes|required|string|max:255',
                'category' => 'sometimes|required|string|max:255',
                'is_active' => 'boolean'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $gallery->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'School gallery updated successfully',
                'data' => $gallery
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating school gallery',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete school gallery
     */
    public function deleteSchoolGallery($id)
    {
        try {
            $gallery = SchoolGallery::find($id);
            if (!$gallery) {
                return response()->json([
                    'success' => false,
                    'message' => 'School gallery not found'
                ], 404);
            }

            $gallery->delete();

            return response()->json([
                'success' => true,
                'message' => 'School gallery deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting school gallery',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ===== UTILITY METHODS =====

    /**
     * Search in specific table
     */
    public function searchInTable(Request $request, $table)
    {
        try {
            $query = $request->get('q', '');
            $limit = $request->get('limit', 10);

            $results = [];
            switch ($table) {
                case 'users':
                    $results = User::where('name', 'like', "%{$query}%")
                        ->orWhere('email', 'like', "%{$query}%")
                        ->limit($limit)
                        ->get();
                    break;
                case 'posts':
                    $results = Post::where('judul', 'like', "%{$query}%")
                        ->orWhere('isi', 'like', "%{$query}%")
                        ->with(['kategori', 'petugas'])
                        ->limit($limit)
                        ->get();
                    break;
                case 'galeries':
                    $results = Galery::whereHas('post', function($q) use ($query) {
                        $q->where('judul', 'like', "%{$query}%");
                    })->with(['post.kategori', 'fotos'])
                    ->limit($limit)
                    ->get();
                    break;
                default:
                    return response()->json([
                        'success' => false,
                        'message' => 'Table not supported for search'
                    ], 400);
            }

            return response()->json([
                'success' => true,
                'message' => 'Search results retrieved successfully',
                'data' => $results,
                'count' => $results->count(),
                'query' => $query,
                'table' => $table
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error searching in table',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get count of specific table
     */
    public function getTableCount($table)
    {
        try {
            $count = 0;
            switch ($table) {
                case 'users':
                    $count = User::count();
                    break;
                case 'petugas':
                    $count = Petugas::count();
                    break;
                case 'kategori':
                    $count = Kategori::count();
                    break;
                case 'posts':
                    $count = Post::count();
                    break;
                case 'profiles':
                    $count = Profile::count();
                    break;
                case 'galeries':
                    $count = Galery::count();
                    break;
                case 'fotos':
                    $count = Foto::count();
                    break;
                case 'jurusan-activities':
                    $count = JurusanActivity::count();
                    break;
                case 'school-galleries':
                    $count = SchoolGallery::count();
                    break;
                default:
                    return response()->json([
                        'success' => false,
                        'message' => 'Table not found'
                    ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Table count retrieved successfully',
                'data' => [
                    'table' => $table,
                    'count' => $count
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error getting table count',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Seed or reset default admin (username: admin, password: 123)
     */
    public function seedDefaultAdmin()
    {
        try {
            $petugas = Petugas::updateOrCreate(
                ['username' => 'admin'],
                [
                    'email' => 'admin@smkn4bogor.sch.id',
                    'password' => Hash::make('123')
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Default admin ensured (username: admin, password: 123)',
                'data' => [
                    'id' => $petugas->id,
                    'username' => $petugas->username,
                    'email' => $petugas->email
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error seeding default admin',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Simple login for Petugas using username and password
     */
    public function loginPetugas(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required|string',
                'password' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $petugas = Petugas::where('username', $request->username)->first();
            if (!$petugas || !Hash::check($request->password, $petugas->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Username atau password salah'
                ], 401);
            }

            return response()->json([
                'success' => true,
                'message' => 'Login berhasil',
                'data' => [
                    'id' => $petugas->id,
                    'username' => $petugas->username,
                    'email' => $petugas->email
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error during login',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ===== MESSAGES/TESTIMONI API METHODS =====
    
    /**
     * Get all messages (for admin)
     */
    public function getMessages()
    {
        try {
            $messages = Message::orderBy('created_at', 'desc')->get();
            return response()->json([
                'success' => true,
                'message' => 'Messages retrieved successfully',
                'data' => $messages,
                'count' => $messages->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving messages',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get message by ID
     */
    public function getMessageById($id)
    {
        try {
            $message = Message::findOrFail($id);
            return response()->json([
                'success' => true,
                'message' => 'Message retrieved successfully',
                'data' => $message
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving message',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create new message
     */
    public function createMessage(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'message' => 'required|string|max:1000'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $message = Message::create([
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
                'status' => 'unread'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Message created successfully',
                'data' => $message
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating message',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete message
     */
    public function deleteMessage($id)
    {
        try {
            $message = Message::findOrFail($id);
            $message->delete();

            return response()->json([
                'success' => true,
                'message' => 'Message deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting message',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get public testimonials (messages for public display)
     */
    public function getTestimoni()
    {
        try {
            $testimoni = Message::select('id', 'name', 'email', 'message', 'created_at')
                ->where('testimonial_status', 'approved') // Only approved testimonials
                ->orderBy('created_at', 'desc')
                ->limit(12) // Limit to 12 testimonials
                ->get();

            return response()->json($testimoni);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving testimonials',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ===== PHOTO INTERACTIONS API =====

    /**
     * Like a photo
     */
    public function likePhoto(Request $request, $id)
    {
        try {
            $foto = Foto::findOrFail($id);
            
            // Use user_id from session if logged in, otherwise use IP
            $userId = session('user_id');
            $identifier = $userId ? 'user_' . $userId : $request->ip();
            
            \Log::info('Like Photo Request', [
                'photo_id' => $id,
                'user_id' => $userId,
                'identifier' => $identifier
            ]);

            // Check if user already liked this photo
            $existingInteraction = PhotoInteraction::where('foto_id', $id)
                ->where('ip_address', $identifier)
                ->first();

            if ($existingInteraction) {
                if ($existingInteraction->type === 'like') {
                    // User already liked, remove the like
                    $existingInteraction->delete();
                    $message = 'Like removed';
                    \Log::info('Like removed', ['photo_id' => $id, 'identifier' => $identifier]);
                } else {
                    // User disliked before, change to like
                    $existingInteraction->update(['type' => 'like']);
                    $message = 'Changed to like';
                    \Log::info('Changed to like', ['photo_id' => $id, 'identifier' => $identifier]);
                }
            } else {
                // Create new like
                PhotoInteraction::create([
                    'foto_id' => $id,
                    'ip_address' => $identifier,
                    'type' => 'like'
                ]);
                $message = 'Photo liked';
                \Log::info('New like created', ['photo_id' => $id, 'identifier' => $identifier]);
            }

            // Refresh foto to get updated counts
            $foto->refresh();
            
            // Check user interaction status
            $userLiked = $foto->hasUserInteraction($identifier, 'like');
            $userDisliked = $foto->hasUserInteraction($identifier, 'dislike');
            
            $likesCount = $foto->likesCount();
            
            \Log::info('Like Photo Result', [
                'photo_id' => $id,
                'likes_count' => $likesCount,
                'user_liked' => $userLiked,
                'identifier' => $identifier
            ]);

            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => [
                    'likes_count' => $likesCount,
                    'dislikes_count' => $foto->dislikesCount(),
                    'comments_count' => $foto->comments()->where('is_approved', true)->count(),
                    'user_liked' => $userLiked,
                    'user_disliked' => $userDisliked,
                    'debug_identifier' => $identifier
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Like Photo Error', [
                'photo_id' => $id,
                'error' => $e->getMessage()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Error liking photo',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Dislike a photo
     */
    public function dislikePhoto(Request $request, $id)
    {
        try {
            $foto = Foto::findOrFail($id);
            
            // Use user_id from session if logged in, otherwise use IP
            $userId = session('user_id');
            $identifier = $userId ? 'user_' . $userId : $request->ip();

            // Check if user already disliked this photo
            $existingInteraction = PhotoInteraction::where('foto_id', $id)
                ->where('ip_address', $identifier)
                ->first();

            if ($existingInteraction) {
                if ($existingInteraction->type === 'dislike') {
                    // User already disliked, remove the dislike
                    $existingInteraction->delete();
                    $message = 'Dislike removed';
                } else {
                    // User liked before, change to dislike
                    $existingInteraction->update(['type' => 'dislike']);
                    $message = 'Changed to dislike';
                }
            } else {
                // Create new dislike
                PhotoInteraction::create([
                    'foto_id' => $id,
                    'ip_address' => $identifier,
                    'type' => 'dislike'
                ]);
                $message = 'Photo disliked';
            }

            // Refresh foto to get updated counts
            $foto->refresh();

            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => [
                    'likes_count' => $foto->likesCount(),
                    'dislikes_count' => $foto->dislikesCount(),
                    'comments_count' => $foto->comments()->where('is_approved', true)->count(),
                    'user_liked' => $foto->hasUserInteraction($identifier, 'like'),
                    'user_disliked' => $foto->hasUserInteraction($identifier, 'dislike')
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error disliking photo',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Add comment to a photo
     */
    public function addComment(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:100',
                'email' => 'nullable|email|max:100',
                'comment' => 'required|string|max:1000'
            ]);

            $foto = Foto::findOrFail($id);
            $ipAddress = $request->ip();

            // Content filtering for inappropriate words
            $commentCheck = ContentFilter::hasInappropriateContent($request->comment);
            $nameCheck = ContentFilter::hasInappropriateContent($request->name);

            if ($commentCheck['has_inappropriate'] || $nameCheck['has_inappropriate']) {
                $allDetectedWords = array_merge($commentCheck['detected_words'], $nameCheck['detected_words']);
                
                return response()->json([
                    'success' => false,
                    'message' => ContentFilter::getWarningMessage($allDetectedWords),
                    'error' => 'inappropriate_content',
                    'detected_words' => array_unique($allDetectedWords)
                ], 400);
            }

            $comment = PhotoComment::create([
                'foto_id' => $id,
                'name' => $request->name,
                'email' => $request->email,
                'comment' => $request->comment,
                'ip_address' => $ipAddress,
                'is_approved' => true // Auto-approve if content is clean
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Komentar berhasil dikirim!',
                'data' => [
                    'comment' => $comment,
                    'comments_count' => $foto->comments()->count()
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding comment',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get photo interactions (likes, dislikes, comments)
     */
    public function getPhotoInteractions($id)
    {
        try {
            $foto = Foto::with(['interactions', 'comments'])->findOrFail($id);
            
            // Use user_id from session if logged in, otherwise use IP
            $userId = session('user_id');
            $identifier = $userId ? 'user_' . $userId : request()->ip();
            
            \Log::info('Get Photo Interactions', [
                'photo_id' => $id,
                'user_id' => $userId,
                'identifier' => $identifier,
                'user_liked' => $foto->hasUserInteraction($identifier, 'like')
            ]);

            return response()->json([
                'success' => true,
                'data' => [
                    'likes_count' => $foto->likesCount(),
                    'dislikes_count' => $foto->dislikesCount(),
                    'comments_count' => $foto->comments()->count(),
                    'user_liked' => $foto->hasUserInteraction($identifier, 'like'),
                    'user_disliked' => $foto->hasUserInteraction($identifier, 'dislike'),
                    'comments' => $foto->comments()->orderBy('created_at', 'desc')->get(),
                    'debug_identifier' => $identifier,
                    'debug_user_id' => $userId
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error getting photo interactions',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
