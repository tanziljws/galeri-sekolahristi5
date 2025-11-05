<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galery;
use App\Models\Foto;
use App\Models\Post;
use App\Models\PhotoInteraction;
use App\Models\PhotoComment;
use App\Models\VisitorTracking;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Admin index - show list of petugas/admins
     */
    public function index()
    {
        $admins = \App\Models\Petugas::all();
        return view('admin.index', compact('admins'));
    }

    /**
     * Show create admin form
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store new admin (Laravel resource method)
     */
    public function store(Request $request)
    {
        // Check if this is a gallery upload (old functionality)
        if ($request->has('photos') || $request->has('post_title')) {
            return $this->storeGallery($request);
        }

        // Otherwise, store admin/petugas
        $request->validate([
            'username' => 'required|string|max:255|unique:petugas,username',
            'email' => 'required|email|max:255|unique:petugas,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        \App\Models\Petugas::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan!');
    }

    /**
     * Store gallery (old functionality)
     */
    private function storeGallery(Request $request)
    {
        try {
            $request->validate([
                'post_title' => 'required|string|max:255',
                'category' => 'required|string|in:prestasi,maulid nabi,neospragma,ekstrakurikuler,lainnya',
                'photos' => 'required|array|min:1',
                'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
                'captions' => 'array',
                'captions.*' => 'nullable|string|max:255'
            ]);

            // Get or create kategori based on category
            $kategoriMap = [
                'prestasi' => 2, // Galery Sekolah
                'maulid nabi' => 2, // Galery Sekolah
                'neospragma' => 2, // Galery Sekolah
                'ekstrakurikuler' => 2, // Galery Sekolah
                'lainnya' => 2 // Galery Sekolah
            ];
            
            $kategoriId = $kategoriMap[$request->category] ?? 2; // Default to 'Galery Sekolah'

            // Create post
            $post = Post::create([
                'judul' => $request->post_title,
                'kategori_id' => $kategoriId,
                'isi' => $request->post_title,
                'petugas_id' => 1, // Default admin
                'status' => 'published'
            ]);

            // Create gallery
            $galery = Galery::create([
                'post_id' => $post->id,
                'category' => $request->category,
                'position' => 1, // Default position
                'status' => 1 // Default status active
            ]);

            // Handle photo uploads
            $photos = $request->file('photos');
            $captions = $request->captions ?? [];

            foreach ($photos as $index => $photo) {
                $filename = time() . '_' . $index . '.' . $photo->getClientOriginalExtension();
                $path = $photo->storeAs('public/galeri', $filename);

                Foto::create([
                    'galery_id' => $galery->id,
                    'judul' => $captions[$index] ?? 'Foto ' . ($index + 1),
                    'file' => $filename
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Foto berhasil diupload!',
                'data' => [
                    'galery_id' => $galery->id,
                    'photos_count' => count($photos)
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error uploading photos: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show edit admin form
     */
    public function edit($id)
    {
        $admin = \App\Models\Petugas::findOrFail($id);
        return view('admin.edit', compact('admin'));
    }

    /**
     * Update admin
     */
    public function update(Request $request, $id)
    {
        $admin = \App\Models\Petugas::findOrFail($id);
        
        $request->validate([
            'username' => 'required|string|max:255|unique:petugas,username,' . $id,
            'email' => 'required|email|max:255|unique:petugas,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $data = [
            'username' => $request->username,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = password_hash($request->password, PASSWORD_DEFAULT);
        }

        $admin->update($data);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil diupdate!');
    }

    /**
     * Delete admin
     */
    public function destroy($id)
    {
        $admin = \App\Models\Petugas::findOrFail($id);
        
        // Prevent deleting yourself or the last admin
        if ($admin->id == session('user_id')) {
            return redirect()->route('admin.index')->with('error', 'Tidak dapat menghapus akun sendiri!');
        }

        if (\App\Models\Petugas::count() <= 1) {
            return redirect()->route('admin.index')->with('error', 'Tidak dapat menghapus admin terakhir!');
        }

        $admin->delete();

        return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus!');
    }

    /**
     * Show upload form
     */
    public function upload()
    {
        // Get all categories from kategori_post table
        $categories = \App\Models\KategoriPost::orderBy('judul', 'asc')->get();
        
        return view('admin.upload', compact('categories'));
    }

    /**
     * Show dashboard
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Show reports
     */
    public function reports()
    {
        return view('admin.reports');
    }

    /**
     * Get admin statistics
     */
    public function getStats()
    {
        try {
            $totalPhotos = Foto::count();
            $totalAlbums = Galery::count();
            $totalLikes = PhotoInteraction::where('type', 'like')->count();
            $totalDislikes = PhotoInteraction::where('type', 'dislike')->count();
            $totalComments = PhotoComment::count();
            $totalVisitors = VisitorTracking::distinct('ip_address')->count();

            return response()->json([
                'success' => true,
                'data' => [
                    'total_photos' => $totalPhotos,
                    'total_albums' => $totalAlbums,
                    'total_likes' => $totalLikes,
                    'total_dislikes' => $totalDislikes,
                    'total_comments' => $totalComments,
                    'total_visitors' => $totalVisitors
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading stats: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Track visitor
     */
    public function trackVisitor(Request $request)
    {
        try {
            $ipAddress = $request->ip();
            $userAgent = $request->userAgent();
            $referer = $request->header('referer');
            $page = $request->get('page', 'galeri');

            // Check if visitor already exists today
            $existingVisitor = VisitorTracking::where('ip_address', $ipAddress)
                ->whereDate('created_at', today())
                ->first();

            if (!$existingVisitor) {
                VisitorTracking::create([
                    'ip_address' => $ipAddress,
                    'user_agent' => $userAgent,
                    'referer' => $referer,
                    'page' => $page,
                    'visited_at' => now()
                ]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false], 500);
        }
    }

    /**
     * Get detailed analytics
     */
    public function getAnalytics(Request $request)
    {
        try {
            $period = $request->get('period', '7'); // days
            
            // Visitor stats
            $visitors = VisitorTracking::where('created_at', '>=', now()->subDays($period))
                ->selectRaw('DATE(created_at) as date, COUNT(DISTINCT ip_address) as unique_visitors, COUNT(*) as total_visits')
                ->groupBy('date')
                ->orderBy('date')
                ->get();

            // Interaction stats
            $interactions = PhotoInteraction::where('created_at', '>=', now()->subDays($period))
                ->selectRaw('DATE(created_at) as date, type, COUNT(*) as count')
                ->groupBy('date', 'type')
                ->orderBy('date')
                ->get();

            // Comment stats
            $comments = PhotoComment::where('created_at', '>=', now()->subDays($period))
                ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->groupBy('date')
                ->orderBy('date')
                ->get();

            // Top photos by interactions
            $topPhotos = Foto::with(['galery.post', 'interactions'])
                ->withCount(['interactions as likes_count' => function($query) {
                    $query->where('type', 'like');
                }])
                ->withCount(['interactions as dislikes_count' => function($query) {
                    $query->where('type', 'dislike');
                }])
                ->withCount('comments')
                ->orderBy('likes_count', 'desc')
                ->limit(10)
                ->get();

            return response()->json([
                'success' => true,
                'data' => [
                    'visitors' => $visitors,
                    'interactions' => $interactions,
                    'comments' => $comments,
                    'top_photos' => $topPhotos,
                    'period' => $period
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading analytics: ' . $e->getMessage()
            ], 500);
        }
    }
}