<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Kategori;
use App\Models\Petugas;

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
            'tanggal_jadwal' => 'nullable|date|after_or_equal:today'
        ]);

        Post::create([
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'isi' => $request->isi,
            'petugas_id' => $request->petugas_id,
            'status' => $request->status,
            'tanggal_jadwal' => $request->tanggal_jadwal
        ]);

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
            'tanggal_jadwal' => 'nullable|date|after_or_equal:today'
        ]);

        $post->update([
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'isi' => $request->isi,
            'petugas_id' => $request->petugas_id,
            'status' => $request->status,
            'tanggal_jadwal' => $request->tanggal_jadwal
        ]);

        return redirect()->route('post.index')->with('success', 'Berita berhasil diupdate!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('post.index')->with('success', 'Berita berhasil dihapus!');
    }
}
