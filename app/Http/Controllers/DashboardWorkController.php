<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        //Untuk Mengvalidasi Data yang akan di masukkan ke dalam database, biasanya dimasukkan dari mengisi form=
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
        return redirect()->route('dashboard')->with('success', 'Work created successfully!');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
