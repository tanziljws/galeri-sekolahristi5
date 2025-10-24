<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JurusanActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JurusanActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = JurusanActivity::latest()->paginate(10);
        return view('admin.jurusan-activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusanList = ['PPLG', 'TJKT', 'TPFL', 'TO'];
        $activityTypes = ['lab', 'workshop', 'competition', 'project', 'field_trip', 'seminar', 'other'];
        return view('admin.jurusan-activities.create', compact('jurusanList', 'activityTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jurusan' => 'required|in:PPLG,TJKT,TPFL,TO',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'activity_type' => 'required|string',
            'activity_date' => 'required|date'
        ]);

        $imagePath = $request->file('image')->store('jurusan-activities', 'public');

        JurusanActivity::create([
            'jurusan' => $request->jurusan,
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath,
            'activity_type' => $request->activity_type,
            'activity_date' => $request->activity_date,
            'is_active' => true
        ]);

        return redirect()->route('admin.jurusan-activities.index')
            ->with('success', 'Kegiatan jurusan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JurusanActivity $jurusanActivity)
    {
        return view('admin.jurusan-activities.show', compact('jurusanActivity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JurusanActivity $jurusanActivity)
    {
        $jurusanList = ['PPLG', 'TJKT', 'TPFL', 'TO'];
        $activityTypes = ['lab', 'workshop', 'competition', 'project', 'field_trip', 'seminar', 'other'];
        return view('admin.jurusan-activities.edit', compact('jurusanActivity', 'jurusanList', 'activityTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JurusanActivity $jurusanActivity)
    {
        $request->validate([
            'jurusan' => 'required|in:PPLG,TJKT,TPFL,TO',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'activity_type' => 'required|string',
            'activity_date' => 'required|date'
        ]);

        $data = [
            'jurusan' => $request->jurusan,
            'title' => $request->title,
            'description' => $request->description,
            'activity_type' => $request->activity_type,
            'activity_date' => $request->activity_date,
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if ($jurusanActivity->image_path) {
                Storage::disk('public')->delete($jurusanActivity->image_path);
            }
            $data['image_path'] = $request->file('image')->store('jurusan-activities', 'public');
        }

        $jurusanActivity->update($data);

        return redirect()->route('admin.jurusan-activities.index')
            ->with('success', 'Kegiatan jurusan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JurusanActivity $jurusanActivity)
    {
        if ($jurusanActivity->image_path) {
            Storage::disk('public')->delete($jurusanActivity->image_path);
        }
        
        $jurusanActivity->delete();

        return redirect()->route('admin.jurusan-activities.index')
            ->with('success', 'Kegiatan jurusan berhasil dihapus!');
    }

    /**
     * Toggle activity status
     */
    public function toggleStatus(JurusanActivity $jurusanActivity)
    {
        $jurusanActivity->update(['is_active' => !$jurusanActivity->is_active]);
        
        $status = $jurusanActivity->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->route('admin.jurusan-activities.index')
            ->with('success', "Kegiatan jurusan berhasil {$status}!");
    }
}
