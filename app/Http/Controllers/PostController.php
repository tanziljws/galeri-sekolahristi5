<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Kategori;
use App\Models\Petugas;
use App\Models\Galery;
use App\Models\Foto;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['kategori', 'petugas'])->orderBy('created_at', 'desc')->get();
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        $petugas = Petugas::all();
        return view('post.create', compact('kategoris', 'petugas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'isi' => 'required',
            'petugas_id' => 'required|exists:petugas,id',
            'status' => 'required|in:Published,Draft',
            'tanggal_jadwal' => 'nullable|date|after_or_equal:today',
            'fotos' => 'nullable|array|max:10',
            'fotos.*' => 'image|mimes:jpeg,jpg,png,JPEG,JPG,PNG|max:20480'
        ]);

        $post = Post::create([
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'isi' => $request->isi,
            'petugas_id' => $request->petugas_id,
            'status' => $request->status,
            'tanggal_jadwal' => $request->tanggal_jadwal
        ]);

        // Upload foto jika ada
        if ($request->hasFile('fotos')) {
            // Buat galeri untuk berita ini
            $galery = Galery::create([
                'post_id' => $post->id,
                'judul' => $post->judul,
                'position' => 0,
                'status' => 1,
                'category' => 'berita'
            ]);

            $photoNumber = 1;
            foreach ($request->file('fotos') as $uploaded) {
                if ($uploaded && $uploaded->isValid()) {
                    $ext = strtolower($uploaded->getClientOriginalExtension() ?: 'jpg');
                    $fileName = time() . '_' . uniqid() . '.' . $ext;
                    
                    // Simpan ke storage/app/public/galeri
                    Storage::disk('public')->putFileAs('galeri', $uploaded, $fileName);
                    
                    // WINDOWS FIX: Copy juga ke public/storage/galeri
                    $publicPath = public_path('storage/galeri/' . $fileName);
                    if (!file_exists(dirname($publicPath))) {
                        mkdir(dirname($publicPath), 0755, true);
                    }
                    copy($uploaded->getRealPath(), $publicPath);
                    
                    // Simpan ke database
                    $galery->fotos()->create([
                        'file' => $fileName,
                        'judul' => $post->judul . ' - Foto ' . $photoNumber
                    ]);
                    $photoNumber++;
                }
            }
        }

        return redirect()->route('post.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function show($id)
    {
        $post = Post::with(['kategori', 'petugas'])->findOrFail($id);
        return view('post.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $kategoris = Kategori::all();
        $petugas = Petugas::all();
        return view('post.edit', compact('post', 'kategoris', 'petugas'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        
        $request->validate([
            'judul' => 'required|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'isi' => 'required',
            'petugas_id' => 'required|exists:petugas,id',
            'status' => 'required|in:Published,Draft',
            'tanggal_jadwal' => 'nullable|date|after_or_equal:today',
            'fotos' => 'nullable|array|max:10',
            'fotos.*' => 'image|mimes:jpeg,jpg,png,JPEG,JPG,PNG|max:20480'
        ]);

        $post->update([
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'isi' => $request->isi,
            'petugas_id' => $request->petugas_id,
            'status' => $request->status,
            'tanggal_jadwal' => $request->tanggal_jadwal
        ]);

        // Upload foto baru jika ada
        if ($request->hasFile('fotos')) {
            // Cari atau buat galeri untuk berita ini
            $galery = $post->galeries()->first();
            if (!$galery) {
                $galery = Galery::create([
                    'post_id' => $post->id,
                    'judul' => $post->judul,
                    'position' => 0,
                    'status' => 1,
                    'category' => 'berita'
                ]);
            }

            $photoNumber = $galery->fotos()->count() + 1;
            foreach ($request->file('fotos') as $uploaded) {
                if ($uploaded && $uploaded->isValid()) {
                    $ext = strtolower($uploaded->getClientOriginalExtension() ?: 'jpg');
                    $fileName = time() . '_' . uniqid() . '.' . $ext;
                    
                    // Simpan ke storage/app/public/galeri
                    Storage::disk('public')->putFileAs('galeri', $uploaded, $fileName);
                    
                    // WINDOWS FIX: Copy juga ke public/storage/galeri
                    $publicPath = public_path('storage/galeri/' . $fileName);
                    if (!file_exists(dirname($publicPath))) {
                        mkdir(dirname($publicPath), 0755, true);
                    }
                    copy($uploaded->getRealPath(), $publicPath);
                    
                    // Simpan ke database
                    $galery->fotos()->create([
                        'file' => $fileName,
                        'judul' => $post->judul . ' - Foto ' . $photoNumber
                    ]);
                    $photoNumber++;
                }
            }
        }

        return redirect()->route('post.index')->with('success', 'Berita berhasil diupdate!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('post.index')->with('success', 'Berita berhasil dihapus!');
    }
}
