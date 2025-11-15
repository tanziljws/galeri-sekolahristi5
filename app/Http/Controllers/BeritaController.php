<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Kategori;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['kategori', 'petugas', 'galeries.fotos'])
            ->whereIn('status', ['Published', 'published'])
            ->where('isi', 'not like', 'Album foto:%')
            ->orderBy('created_at', 'desc');

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%$search%")
                  ->orWhere('isi', 'like', "%$search%");
            });
        }

        if ($request->filled('kategori')) {
            $kategoriId = $request->kategori;
            $query->where('kategori_id', $kategoriId);
        }

        $posts = $query->get();
        
        // Separate upcoming news from regular news
        $upcomingNews = $posts->filter(function ($post) {
            return $post->isUpcoming();
        })->sortBy('tanggal_jadwal');
        
        $regularNews = $posts->filter(function ($post) {
            return !$post->isUpcoming();
        });
        
        $kategoris = Kategori::withCount('posts')->get();

        return view('berita.index', compact('posts', 'upcomingNews', 'regularNews', 'kategoris'));
    }

    public function show($id)
    {
        $post = Post::with(['kategori', 'petugas', 'galeries.fotos'])->findOrFail($id);
        $latest = Post::with(['galeries.fotos'])
            ->where('status', 'Published')
            ->where('isi', 'not like', 'Album foto:%')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('berita.show', compact('post', 'latest'));
    }
}
