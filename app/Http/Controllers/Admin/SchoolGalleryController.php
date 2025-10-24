<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SchoolGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = SchoolGallery::latest()->paginate(10);
        return view('admin.school-galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = [
            'kegiatan_sekolah' => 'Kegiatan Sekolah',
            'acara' => 'Acara Khusus',
            'prestasi' => 'Prestasi Siswa',
            'fasilitas' => 'Fasilitas Sekolah',
            'kegiatan_umum' => 'Kegiatan Umum',
            'lainnya' => 'Lainnya'
        ];
        return view('admin.school-galleries.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string',
            'event_date' => 'nullable|date'
        ]);

        $imagePath = $request->file('image')->store('school-gallery', 'public');

        SchoolGallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath,
            'category' => $request->category,
            'event_date' => $request->event_date,
            'is_active' => true
        ]);

        return redirect()->route('admin.school-galleries.index')
            ->with('success', 'Foto galeri sekolah berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(SchoolGallery $schoolGallery)
    {
        return view('admin.school-galleries.show', compact('schoolGallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolGallery $schoolGallery)
    {
        $categories = [
            'kegiatan_sekolah' => 'Kegiatan Sekolah',
            'acara' => 'Acara Khusus',
            'prestasi' => 'Prestasi Siswa',
            'fasilitas' => 'Fasilitas Sekolah',
            'kegiatan_umum' => 'Kegiatan Umum',
            'lainnya' => 'Lainnya'
        ];
        return view('admin.school-galleries.edit', compact('schoolGallery', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SchoolGallery $schoolGallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string',
            'event_date' => 'nullable|date'
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'event_date' => $request->event_date,
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if ($schoolGallery->image_path) {
                Storage::disk('public')->delete($schoolGallery->image_path);
            }
            $data['image_path'] = $request->file('image')->store('school-gallery', 'public');
        }

        $schoolGallery->update($data);

        return redirect()->route('admin.school-galleries.index')
            ->with('success', 'Foto galeri sekolah berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolGallery $schoolGallery)
    {
        if ($schoolGallery->image_path) {
            Storage::disk('public')->delete($schoolGallery->image_path);
        }
        
        $schoolGallery->delete();

        return redirect()->route('admin.school-galleries.index')
            ->with('success', 'Foto galeri sekolah berhasil dihapus!');
    }

    /**
     * Toggle gallery status
     */
    public function toggleStatus(SchoolGallery $schoolGallery)
    {
        $schoolGallery->update(['is_active' => !$schoolGallery->is_active]);
        
        $status = $schoolGallery->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->route('admin.school-galleries.index')
            ->with('success', "Foto galeri sekolah berhasil {$status}!");
    }
}
