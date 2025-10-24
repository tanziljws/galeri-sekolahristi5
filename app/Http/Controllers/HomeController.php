<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galery;
use App\Models\Post;
use App\Models\Kategori;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil galeri yang aktif dengan foto (hanya kategori umum) dan filter duplikat judul
        $allGaleries = Galery::with(['post', 'fotos'])
            ->where('status', 1)
            ->where('category', 'umum')
            ->orderBy('position', 'asc')
            ->get();
        
        // Filter untuk menghilangkan duplikat judul album
        $galeries = $allGaleries->unique(function ($item) {
            return $item->judul ?? ($item->post ? $item->post->judul : $item->id);
        });

        // Ambil post terbaru (kecuali yang berasal dari galeri)
        $latestPosts = Post::with(['kategori', 'petugas'])
            ->where('status', 'Published')
            ->where('isi', 'not like', 'Album foto:%')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Ambil semua kategori
        $kategoris = Kategori::withCount('posts')->get();

        // Ambil semua foto dikelompokkan berdasarkan judul album untuk carousel (hanya kategori umum)
        $photosByAlbumTitle = Galery::with(['post', 'fotos'])
            ->where('status', 1)
            ->where('category', 'umum')
            ->get()
            ->groupBy(function ($item) {
                return $item->judul ?? ($item->post ? $item->post->judul : 'gallery_' . $item->id);
            })
            ->map(function ($albums) {
                $allPhotos = collect();
                foreach ($albums as $album) {
                    $allPhotos = $allPhotos->merge($album->fotos);
                }
                return $allPhotos;
            });

        return view('home', compact('galeries', 'latestPosts', 'kategoris', 'photosByAlbumTitle'));
    }
}
