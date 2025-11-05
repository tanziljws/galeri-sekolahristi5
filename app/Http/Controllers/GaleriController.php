<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galery;
use App\Models\Foto;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class GaleriController extends Controller
{
    public function public()
    {
        // Ambil semua foto dari galeri yang aktif, KECUALI galeri berita
        $allPhotos = Foto::with(['galery', 'galery.post', 'interactions', 'comments'])
            ->whereHas('galery', function ($q) {
                $q->where('status', 1)
                  ->where('category', '!=', 'berita'); // Exclude galeri berita
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Foto dari galeri prestasi
        $prestasiPhotos = $allPhotos->filter(function($photo) {
            return $photo->galery->category === 'prestasi';
        });

        // Foto dari galeri umum (bukan prestasi dan bukan berita)
        $generalPhotos = $allPhotos->filter(function($photo) {
            return $photo->galery->category !== 'prestasi' && $photo->galery->category !== 'berita';
        });

        // Kumpulkan kategori yang ada untuk filter
        $categories = $allPhotos
            ->map(function($photo) {
                return $photo->galery ? $photo->galery->category : null;
            })
            ->unique()
            ->filter()
            ->values();

        // Label kategori
        $categoryLabels = [
            'umum' => 'Umum',
            'ekstrakurikuler' => 'Ekstrakurikuler',
            'prestasi' => 'Prestasi',
            'pplg' => 'PPLG',
            'tjkt' => 'TJKT',
            'tpfl' => 'TPFL',
            'to' => 'TO',
            'transforkrab' => 'Transforkrab',
            'maulid-nabi' => 'Maulid Nabi',
            'neospragma' => 'Neospragma',
            'p5' => 'P5 (Projek Penguatan Profil Pelajar Pancasila)',
            'upacara' => 'Upacara',
            'adiwiyata' => 'Adiwiyata',
            'pmr' => 'PMR (Palang Merah Remaja)',
            'pramuka' => 'Pramuka',
            'osis' => 'OSIS',
            'lainnya' => 'Lainnya'
        ];

        return view('galeri.public', compact('generalPhotos', 'prestasiPhotos', 'categories', 'categoryLabels', 'allPhotos'));
    }
    public function index()
    {
        // Tampilkan semua galeri yang aktif, diurutkan berdasarkan posisi
        $galeries = Galery::with(['post', 'fotos'])
            ->where('status', 1)
            ->orderBy('position', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Group by category for better organization
        $categorizedGaleries = $galeries->groupBy('category');
        
        return view('galeri.index', compact('galeries', 'categorizedGaleries'));
    }

    

    public function create()
    {
        return view('galeri.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'position' => 'required|integer|min:1',
                'status' => 'required|in:1,0',
                'category' => 'required|in:umum,ekstrakurikuler,pplg,tjkt,tpfl,to,transforkrab,prestasi,maulid-nabi,neospragma,p5,upacara,adiwiyata,pmr,pramuka,osis,lainnya',
                'fotos' => 'nullable|array',
                'fotos.*' => 'image|mimes:jpeg,jpg,png,JPEG,JPG,PNG|max:20480'
            ], [
                'judul.required' => 'Judul/keterangan kegiatan harus diisi.',
                'judul.max' => 'Judul/keterangan kegiatan maksimal 255 karakter. Silakan singkat judul Anda.',
                'position.required' => 'Posisi harus diisi.',
                'position.integer' => 'Posisi harus berupa angka.',
                'position.min' => 'Posisi minimal 1.',
                'status.required' => 'Status harus dipilih.',
                'status.in' => 'Status tidak valid.',
                'category.required' => 'Kategori galeri harus dipilih.',
                'category.in' => 'Kategori galeri tidak valid.',
                'fotos.*.max' => 'Ukuran file foto maksimal 20MB per file.',
                'fotos.*.image' => 'File harus berupa gambar (JPG, PNG).',
                'fotos.*.mimes' => 'Format file harus JPG atau PNG.'
            ]);

            // Buat galeri tanpa post (post_id nullable)
            $galery = Galery::create([
                'post_id' => null,
                'judul' => $request->judul,
                'position' => $request->position,
                'status' => $request->status,
                'category' => $request->category
            ]);

            // Upload foto jika ada - OTOMATIS TANPA INPUT MANUAL
            if ($request->hasFile('fotos')) {
                $photoNumber = 1;
                foreach ($request->file('fotos') as $uploaded) {
                    if ($uploaded && $uploaded->isValid()) {
                        $ext = strtolower($uploaded->getClientOriginalExtension() ?: 'jpg');
                        $fileName = time() . '_' . uniqid() . '.' . $ext;
                        
                        // Simpan ke storage/app/public/galeri
                        Storage::disk('public')->putFileAs('galeri', $uploaded, $fileName);
                        
                        // WINDOWS FIX: Copy juga ke public/storage/galeri (karena symlink sering tidak berfungsi di Windows)
                        $publicPath = public_path('storage/galeri/' . $fileName);
                        if (!file_exists(dirname($publicPath))) {
                            mkdir(dirname($publicPath), 0755, true);
                        }
                        copy($uploaded->getRealPath(), $publicPath);
                        
                        // Auto-generate judul dari nama file atau judul album
                        $originalName = pathinfo($uploaded->getClientOriginalName(), PATHINFO_FILENAME);
                        $autoJudul = $request->judul . ' - Foto ' . $photoNumber;
                        
                        $galery->fotos()->create([
                            'file' => $fileName,
                            'judul' => $autoJudul
                        ]);
                        $photoNumber++;
                    }
                }
            }

            // Refresh data to ensure photos are loaded
            $galery->load('fotos');
            
            return redirect()->route('galeri.index')->with('success', 'Album berhasil dibuat!');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        $galery = Galery::with(['post', 'fotos'])->findOrFail($id);
        return view('galeri.show', compact('galery'));
    }

    public function edit($id)
    {
        $galery = Galery::with(['post', 'fotos'])->findOrFail($id);
        $posts = Post::whereIn('status', ['Published', 'published'])->get();
        return view('galeri.edit', compact('galery', 'posts'));
    }

    public function update(Request $request, $id)
    {
        $galery = Galery::findOrFail($id);
        
        // Debug: log request data
        \Log::info('Update Galeri Request:', [
            'galery_id' => $id,
            'fotos_count' => count($request->fotos ?? []),
            'has_files' => $request->hasFile('fotos'),
            'files_data' => $request->file('fotos')
        ]);
        
        $request->validate([
            'post_title' => 'required|string|max:255',
            'position' => 'required|integer|min:1',
            'status' => 'required|in:1,0',
            'category' => 'required|in:umum,ekstrakurikuler,pplg,tjkt,tpfl,to,transforkrab,prestasi,maulid-nabi,neospragma,p5,upacara,adiwiyata,pmr,pramuka,osis,lainnya',
            'fotos' => 'nullable|array',
            'fotos.*.id' => 'nullable|integer',
            'fotos.*.judul' => 'nullable|string|max:255',
            'fotos.*.file' => 'nullable|image|mimes:jpeg,jpg,png,JPEG,JPG,PNG|max:10240',
            'fotos.*.existing_file' => 'nullable|string',
            'fotos.*.keep' => 'nullable|in:1'
        ]);

        // Update judul galeri
        $galery->update([
            'judul' => $request->post_title,
            'position' => $request->position,
            'status' => $request->status,
            'category' => $request->category
        ]);
        
        // Update judul post terkait jika ada
        if ($galery->post) {
            $galery->post->update([
                'judul' => $request->post_title,
            ]);
        }

        // Update atau tambah foto
        // STRATEGI BARU: SEMUA foto di database TETAP ADA, kecuali yang dihapus manual via tombol hapus
        // Hanya update foto yang ada perubahan
        $fotoInputs = $request->input('fotos', []);
        
        $fotosInDb = $galery->fotos()->count();
        $fotosInRequest = count($fotoInputs);
        
        \Log::info('Processing fotos:', [
            'total_fotos_in_request' => $fotosInRequest,
            'total_fotos_in_db' => $fotosInDb,
            'foto_inputs' => $fotoInputs
        ]);
        
        // PENTING: Jika tidak ada foto di request, SKIP proses foto (jangan hapus apapun)
        if (empty($fotoInputs)) {
            \Log::warning('No fotos in request - SKIPPING foto processing to preserve existing photos');
        } else {
            foreach ($fotoInputs as $index => $fotoInput) {
            $existingId = $fotoInput['id'] ?? null;
            $newTitle = $fotoInput['judul'] ?? null;
            $keepFlag = $fotoInput['keep'] ?? null;

            if ($existingId) {
                // Update foto yang sudah ada
                $fotoModel = $galery->fotos()->where('id', $existingId)->first();
                if ($fotoModel) {
                    $hasChanges = false;
                    
                    \Log::info("Processing existing foto ID {$existingId}:", [
                        'current_judul' => $fotoModel->judul,
                        'new_judul' => $newTitle,
                        'has_new_file' => $request->hasFile("fotos.$index.file"),
                        'keep_flag' => $keepFlag
                    ]);
                    
                    // Foto dengan keep flag akan dipertahankan
                    if ($keepFlag) {
                        \Log::info("Foto ID {$existingId} has keep flag, will be preserved");
                    }
                    
                    // Update judul jika berbeda dari yang lama
                    if ($newTitle !== null && $newTitle !== '' && $newTitle !== $fotoModel->judul) {
                        $fotoModel->judul = $newTitle;
                        $hasChanges = true;
                        \Log::info("Updated judul for foto ID {$existingId}");
                    }
                    
                    // Ganti file bila diupload file baru
                    if ($request->hasFile("fotos.$index.file") && $request->file("fotos.$index.file")->isValid()) {
                        $uploaded = $request->file("fotos.$index.file");
                        $ext = strtolower($uploaded->getClientOriginalExtension() ?: 'jpg');
                        $fileName = time() . '_' . uniqid() . '.' . $ext;
                        
                        // Upload file baru
                        Storage::disk('public')->putFileAs('galeri', $uploaded, $fileName);
                        \Log::info("Uploaded new file for foto ID {$existingId}: {$fileName}");
                        
                        // Hapus file lama
                        if ($fotoModel->file && Storage::exists('public/galeri/' . $fotoModel->file)) {
                            Storage::delete('public/galeri/' . $fotoModel->file);
                            \Log::info("Deleted old file for foto ID {$existingId}: {$fotoModel->file}");
                        }
                        
                        $fotoModel->file = $fileName;
                        $hasChanges = true;
                    }
                    
                    // Simpan hanya jika ada perubahan
                    if ($hasChanges) {
                        $fotoModel->save();
                        \Log::info("Saved changes for foto ID {$existingId}");
                    } else {
                        \Log::info("No changes for foto ID {$existingId}, foto preserved as-is");
                    }
                } else {
                    \Log::warning("Foto ID {$existingId} not found in galery {$id}");
                }
            } else {
                // Tambah foto baru jika ada file
                if ($request->hasFile("fotos.$index.file") && $request->file("fotos.$index.file")->isValid()) {
                    $uploaded = $request->file("fotos.$index.file");
                    $ext = strtolower($uploaded->getClientOriginalExtension() ?: 'jpg');
                    $fileName = time() . '_' . uniqid() . '.' . $ext;
                    Storage::disk('public')->putFileAs('galeri', $uploaded, $fileName);
                    
                    $newFoto = $galery->fotos()->create([
                        'file' => $fileName,
                        'judul' => $newTitle ?? ('Foto ' . ($galery->fotos()->count() + 1))
                    ]);
                    \Log::info("Created new foto ID {$newFoto->id}: {$fileName}");
                } else {
                    \Log::warning("No file uploaded for new foto at index {$index}");
                }
            }
            } // Close foreach
        } // Close else block from line 223
        
        // Log untuk debugging
        \Log::info('Galeri Update Complete:', [
            'galery_id' => $id,
            'total_fotos_after_update' => $galery->fotos()->count(),
            'processed_fotos' => count($fotoInputs)
        ]);

        // Refresh relations to ensure latest data
        $galery->load('post');

        return redirect()
            ->route('galeri.index')
            ->with('success', 'Galeri berhasil diupdate!')
            ->with('highlight_id', $galery->id);
    }

    public function destroy($id)
    {
        $galery = Galery::findOrFail($id);
        
        // Delete all photo files
        foreach ($galery->fotos as $foto) {
            if (Storage::exists('public/galeri/' . $foto->file)) {
                Storage::delete('public/galeri/' . $foto->file);
            }
        }
        
        $galery->fotos()->delete();
        $galery->delete();

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil dihapus!');
    }

    public function destroyPhoto(Galery $galery, Foto $foto)
    {
        // Ensure the photo belongs to the galery
        if ($foto->galery_id !== $galery->id) {
            abort(404);
        }
        if (Storage::exists('public/galeri/' . $foto->file)) {
            Storage::delete('public/galeri/' . $foto->file);
        }
        $foto->delete();
        return back()->with('success', 'Foto berhasil dihapus');
    }

    public function updatePhoto(Request $request, Galery $galery, Foto $foto)
    {
        if ($foto->galery_id !== $galery->id) {
            abort(404);
        }

        $request->validate([
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'judul' => 'nullable|string|max:255'
        ]);

        $updates = [];
        if ($request->filled('judul')) {
            $updates['judul'] = $request->input('judul');
        }
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            if (Storage::exists('public/galeri/' . $foto->file)) {
                Storage::delete('public/galeri/' . $foto->file);
            }
            $fileName = time() . '_' . uniqid() . '.' . $request->file('file')->getClientOriginalExtension();
            
            try {
                // Try to use Intervention Image if GD is available
                $image = Image::read($request->file('file')->getRealPath())
                    ->cover(225, 225)
                    ->toJpeg(85);
                Storage::put('public/galeri/' . $fileName, (string) $image);
            } catch (\Exception $e) {
                // Fallback: just copy the file without processing
                $request->file('file')->storeAs('public/galeri', $fileName);
            }
            $updates['file'] = $fileName;
        }
        if (!empty($updates)) {
            $foto->update($updates);
        }
        return back()->with('success', 'Foto berhasil diperbarui');
    }

    public function deletePhoto(Request $request, Galery $galery, Foto $foto)
    {
        if ($foto->galery_id !== $galery->id) {
            abort(404);
        }

        // Delete file from storage
        if (Storage::exists('public/galeri/' . $foto->file)) {
            Storage::delete('public/galeri/' . $foto->file);
        }

        // Delete from database
        $foto->delete();

        return back()->with('success', 'Foto berhasil dihapus');
    }

    public function byCategory($category)
    {
        $validCategories = ['umum', 'ekstrakurikuler', 'prestasi', 'pplg', 'tjkt', 'tpfl', 'to', 'transforkrab', 'maulid-nabi', 'neospragma', 'p5', 'upacara', 'adiwiyata', 'pmr', 'pramuka', 'siswa', 'lainnya', 'prestasi'];
        
        if (!in_array($category, $validCategories)) {
            abort(404);
        }

        $galeries = Galery::with(['post', 'fotos'])
            ->where('category', $category)
            ->where('status', 1)
            ->orderBy('position', 'asc')
            ->get();

        $categoryNames = [
            'umum' => 'Galeri Umum',
            'ekstrakurikuler' => 'Ekstrakurikuler',
            'pplg' => 'PPLG (Pengembangan Perangkat Lunak & Gim)',
            'tjkt' => 'TJKT (Teknik Jaringan Komputer & Telekomunikasi)',
            'tpfl' => 'TPFL (Teknik Pengelasan & Fabrikasi Logam)',
            'to' => 'TO (Teknik Otomotif)',
            'transforkrab' => 'Transforkrab',
            'prestasi' => 'Galeri Prestasi'
        ];

        return view('galeri.by-category', compact('galeries', 'category', 'categoryNames'));
    }

    public function report()
    {
        return view('galeri.report');
    }

    /**
     * Show individual photo for sharing (public access via WhatsApp/Ngrok)
     */
    public function showPhoto($id)
    {
        $foto = Foto::with(['galery.post'])->findOrFail($id);
        
        // Get the gallery this photo belongs to
        $galery = $foto->galery;
        
        // Get photo URL
        $imageUrl = \App\Helpers\ImageHelper::getImageUrl($foto->file);
        
        // Get photo interactions
        $likesCount = $foto->likesCount();
        $commentsCount = $foto->comments()->count();
        
        return view('galeri.show-photo', compact('foto', 'galery', 'imageUrl', 'likesCount', 'commentsCount'));
    }

    public function dashboard()
    {
        // Get statistics for gallery dashboard
        $totalGaleries = Galery::count();
        $activeGaleries = Galery::where('status', 1)->count();
        $inactiveGaleries = Galery::where('status', 0)->count();
        $totalPhotos = Foto::count();
        
        // Get galleries by category
        $galleriesByCategory = Galery::selectRaw('category, COUNT(*) as count')
            ->groupBy('category')
            ->get()
            ->pluck('count', 'category');
        
        // Get recent galleries
        $recentGaleries = Galery::with(['fotos'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        return view('galeri.dashboard', compact(
            'totalGaleries',
            'activeGaleries',
            'inactiveGaleries',
            'totalPhotos',
            'galleriesByCategory',
            'recentGaleries'
        ));
    }

    /**
     * Quick upload photos to existing gallery
     * Admin tinggal pilih foto, langsung masuk database dan tampil
     */
    public function quickUpload(Request $request, $id)
    {
        try {
            $galery = Galery::findOrFail($id);
            
            $request->validate([
                'photos' => 'required|array|min:1',
                'photos.*' => 'image|mimes:jpeg,jpg,png,JPEG,JPG,PNG|max:20480'
            ], [
                'photos.required' => 'Pilih minimal 1 foto untuk diupload.',
                'photos.*.max' => 'Ukuran file foto maksimal 20MB per file.',
                'photos.*.image' => 'File harus berupa gambar (JPG, PNG).',
                'photos.*.mimes' => 'Format file harus JPG atau PNG.'
            ]);

            $uploadedCount = 0;
            $photoNumber = $galery->fotos()->count() + 1;

            foreach ($request->file('photos') as $uploaded) {
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
                    
                    // Auto-generate judul
                    $autoJudul = $galery->judul . ' - Foto ' . $photoNumber;
                    
                    $galery->fotos()->create([
                        'file' => $fileName,
                        'judul' => $autoJudul
                    ]);
                    
                    $uploadedCount++;
                    $photoNumber++;
                }
            }

            return redirect()->back()->with('success', "Berhasil upload {$uploadedCount} foto ke album \"{$galery->judul}\"!");
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
