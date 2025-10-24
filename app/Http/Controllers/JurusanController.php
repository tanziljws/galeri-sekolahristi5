<?php

namespace App\Http\Controllers;

use App\Models\JurusanActivity;
use App\Models\Galery;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function pplg() 
    { 
        // Ambil kegiatan PPLG dari galeri berdasarkan kategori
        $activities = Galery::with(['post', 'fotos'])
            ->where('category', 'pplg')
            ->where('status', 1)
            ->orderBy('position', 'asc')
            ->take(8)
            ->get();
        return view('jurusan.pplg', compact('activities')); 
    }
    
    public function tjkt() 
    { 
        // Ambil kegiatan TJKT dari galeri berdasarkan kategori
        $activities = Galery::with(['post', 'fotos'])
            ->where('category', 'tjkt')
            ->where('status', 1)
            ->orderBy('position', 'asc')
            ->take(8)
            ->get();
        return view('jurusan.tjkt', compact('activities')); 
    }
    
    public function tpfl() 
    { 
        // Ambil kegiatan TPFL dari galeri berdasarkan kategori
        $activities = Galery::with(['post', 'fotos'])
            ->where('category', 'tpfl')
            ->where('status', 1)
            ->orderBy('position', 'asc')
            ->take(8)
            ->get();
        return view('jurusan.tpfl', compact('activities')); 
    }
    
    public function to() 
    { 
        // Ambil kegiatan TO dari galeri berdasarkan kategori
        $activities = Galery::with(['post', 'fotos'])
            ->where('category', 'to')
            ->where('status', 1)
            ->orderBy('position', 'asc')
            ->take(8)
            ->get();
        return view('jurusan.to', compact('activities')); 
    }
}
