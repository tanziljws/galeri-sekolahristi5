<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Kategori;
use App\Models\Galery;
use App\Models\Foto;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPosts = Post::count();
        $totalKategori = Kategori::count();
        $totalGalery = Galery::count();
        $totalFoto = Foto::count();
        
        return view('dashboard', compact('totalPosts', 'totalKategori', 'totalGalery', 'totalFoto'));
    }
}
