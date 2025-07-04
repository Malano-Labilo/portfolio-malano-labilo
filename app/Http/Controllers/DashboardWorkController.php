<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DashboardWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $works = Work::latest()->where('user_id', Auth::user()->id);

        if (request('keyword')){
            $works->where('title', 'like', '%' . request('keyword') . '%');
        }
        
        return view('dashboard.index', ['works' => $works->paginate(8)->withQueryString()]);
    }

    public function create()
    {
        return view('dashboard.create');
    }

    public function store(Request $request){
        // Validasi inputan form
        Validator::make($request->all(), [
            'title' => 'required|max:255|unique:works,title' , // Validasi untuk title, harus diisi dan maksimal 255 karakter, dan harus unik di tabel works
            
            'category' => 'required|exists:categories,id', // Validasi untuk category, harus diisi dan harus ada di tabel categories
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png|max:20480', // Validasi untuk thumbnail, harus berupa file gambar dengan ekstensi jpg, jpeg, atau png dan maksimal -+20MB
            'excerpt' => 'required|max:255', // Validasi untuk excerpt, harus diisi dan maksimal 255 karakter
            'link' => 'nullable|url', // Validasi untuk link, boleh kosong tapi jika diisi harus berupa URL yang valid
            'has_page' => 'required|boolean', // Validasi untuk has_page, harus diisi dan harus berupa boolean (true/false)
            'description' => 'required|min:20', // Validasi untuk description, harus diisi
        ],[
            'required' => 'Kolom :attribute harus diisi.',
            'unique' => ':attribute sudah digunakan, silakan gunakan :attribute lain.',
            'max' => 'Kolom :attribute maksimal :max karakter.',
            'min' => 'Kolom :attribute minimal :min karakter.',
            'exists' => 'Kategori yang dipilih tidak valid.',
            'image' => 'File yang diunggah harus berupa gambar.',
            'mimes' => 'File yang diunggah harus berupa gambar dengan ekstensi: :values.',
            'url' => 'Kolom :attribute harus berupa URL yang valid.',
            'boolean' => 'Kolom :attribute harus berupa true atau false.',
        ],[
            'title' => 'Judul',
            'category' => 'Kategori',
            'thumbnail' => 'Thumbnail',
            'excerpt' => 'Ringkasan',
            'link' => 'Tautan',
            'has_page' => 'Halaman',
            'description' => 'Deskripsi',
        ])->validate();

        //Memasukkan Data yang akan di masukkan ke dalam database, biasanya dimasukkan dari mengisi form=
        Work::create([
            'title' => $request->input('title'), // Mengambil data dari inputan form dengan name="title"
            'slug' =>  Str::slug($request->input('title')), // Mengambil data dari inputan form dengan name="title" dan mengubahnya menjadi slug
            'user_id' => Auth::user()->id, // Mengambil ID user yang sedang login
            'category_id' => $request->input('category'), // Mengambil data dari inputan form dengan name="category"
            'thumbnail' => $request->file('thumbnail')->store('img/thumbnails', 'public'), // Mengambil file dari inputan form dengan name="thumbnail" dan menyimpannya di folder 'thumbnails' pada disk 'public'
            'excerpt' => $request->input('excerpt'), // Mengambil data dari inputan form dengan name="excerpt"
            'link' => $request->input('link'), // Mengambil data dari inputan form dengan name="link"
            'has_page' => $request->boolean('has_page'), // Mengambil data dari inputan form dengan name="pages"
            'description' => $request->input('description'), // Mengambil data dari inputan form dengan name="description"
            'published_at' => now(), // Mengambil waktu saat ini
        ]);
        return redirect()->route('dashboard')->with(['success' => 'Project created successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Work $work)
    {
        return view('dashboard.show', [
            'work' => $work
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Work $work)
    {
        return view('dashboard.edit', [
            'work' => $work
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Work $work)
    {
        //Validasi inputan form
        $data = $request->validate([
            'title' => 'required|max:255|unique:works,title,' . $work->id, // Validasi untuk title, harus diisi dan maksimal 255 karakter, dan harus unik di tabel works
            'category' => 'required|exists:categories,id', // Validasi untuk category, harus diisi dan harus ada di tabel categories
            'thumbnail' => 'nullable|string', // Validasi untuk thumbnail, harus berupa file gambar dengan ekstensi jpg, jpeg, atau png dan maksimal -+20MB
            'excerpt' => 'required|max:255', // Validasi untuk excerpt, harus diisi dan maksimal 255 karakter
            'link' => 'nullable|url', // Validasi untuk link, boleh kosong tapi jika diisi harus berupa URL yang valid
            'has_page' => 'required|boolean', // Validasi untuk has_page, harus diisi dan harus berupa boolean (true/false)
            'description' => 'required|min:20', // Validasi untuk description, harus diisi
        ],[
            'required' => 'Kolom :attribute harus diisi.',
            'unique' => 'Judul sudah digunakan, silakan gunakan judul lain.',
            'max' => 'Kolom :attribute maksimal :max karakter.',
            'min' => 'Kolom :attribute minimal :min karakter.',
            'exists' => 'Kategori yang dipilih tidak valid.',
            'image' => 'File yang diunggah harus berupa gambar.',
            'mimes' => 'File yang diunggah harus berupa gambar dengan ekstensi: :values.',
            'url' => 'Kolom :attribute harus berupa URL yang valid.',
            'boolean' => 'Kolom :attribute harus berupa true atau false.',
        ],[
            'title' => 'Judul',
            'category' => 'Kategori',
            'thumbnail' => 'Thumbnail',
            'excerpt' => 'Ringkasan',
            'link' => 'Tautan',
            'has_page' => 'Halaman',
            'description' => 'Deskripsi',
        ]);

            // Cek apakah request mengandung path thumbnail baru (hasil dari FilePond)
        if($request->filled('thumbnail') && $request->thumbnail !== $work->thumbnail) {
            $oldThumbnail = $work->thumbnail;
            $tempPath = $request->input('thumbnail');
            
            $thumbnailRaw = $request->thumbnail;
            $thumbnailPath = '';

            if (is_string($thumbnailRaw) && Str::startsWith($thumbnailRaw, 'tmp/thumbnail')) {
            // Langsung pakai kalau sudah path string
            $thumbnailPath = $thumbnailRaw;
            } elseif (is_string($thumbnailRaw) && Str::contains($thumbnailRaw, '{')) {
            // Kalau isinya JSON, ambil path dari JSON
            $decoded = json_decode($thumbnailRaw, true);
            $thumbnailPath = $decoded['path'] ?? '';
            }

            // Validasi bahwa path berasal dari direktori tmp/thumbnail
        if ($thumbnailPath && Str::startsWith($thumbnailPath, 'tmp/thumbnail')) {
        $fileName = Str::after($thumbnailPath, 'tmp/thumbnail/');
        Storage::disk('public')->move($thumbnailPath, 'img/thumbnails/' . $fileName);
        $data['thumbnail'] = 'img/thumbnails/' . $fileName;
            
            // Hapus thumbnail lama jika ada
            if ($oldThumbnail && Storage::disk('public')->exists($oldThumbnail)) {
                Storage::disk('public')->delete($oldThumbnail);
            }
        }

        }

    $data['slug'] = Str::slug($data['title']);
    $data['user_id'] = Auth::id();          
    $data['published_at'] = now();

    if(!isset($data['thumbnail']) || empty($data['thumbnail'])) {
        $data['thumbnail'] = $work->thumbnail; // Jika tidak ada thumbnail baru, gunakan thumbnail lama
    }

    // Update
    $updated = $work->update($data);
        
        return $updated ? redirect()->route('dashboard')->with(['success' => 'Project Edit successfully!']) : redirect()->route('dashboard')->with(['error' => 'Failed to Edit project!']);
    }

    public function uploadThumbnail(Request $request)
    {
        if($request->hasFile('thumbnail')){
            $path = $request->file('thumbnail')->store('tmp/thumbnail', 'public'); //path img yang akan disimpan
            return response()->json(['path' => $path]);
        }
        return response()->json(['error' => 'No file uploaded'], 400);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Work $work)
    {
        if ($work->thumbnail && Storage::disk('public')->exists($work->thumbnail)) {
            Storage::disk('public')->delete($work->thumbnail); // Hapus thumbnail jika ada
        }
        return $work->delete() ? redirect()->route('dashboard')->with(['success' => 'Project deleted successfully!']) : redirect()->route('dashboard')->with(['error' => 'Failed to delete project!']);
    }
}
