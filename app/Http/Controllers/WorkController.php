<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Work;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class WorkController extends Controller
{

    //Halaman Work
    public function index(){
        $works = Work::latest()->get();
        return view('pages.works.index',[
        'title' => 'My Works',
        'works' => $works
        ]);
    }

    //halaman Detail Work atau detail dari 1 project
    public function work(Work $work){
            return view('pages.works.work',[
                'title' => $work->title,
                'work' => $work
            ]);
    }

    //halaman Show All Works atau menampilkan semua project
    public function works(){
        $works = Work::latest()->filter(request(['searching', 'category', 'creator']))->paginate(10)->withQueryString();
        return view('pages.works.show', [
            'title' => "All Projects",
            'show' => $works
        ]);
    }

    //halaman Show All Works atau menampilkan semua project dari seorang Creator
    public function users(User $user){
        return view('pages.works.show', [
            'title' => count($user->work) . " Project By Creator " . $user->username,
            'show' => $user->work
        ]);
    }

    //Proses Generate Slug Unique
    private function generateUniqueSlug(string $title): string{
        $slug = Str::slug($title);
        $count = Work::where('slug', 'LIKE', "{$slug}%")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    public function store(Request $request){

        //Untuk Mengvalidasi Data yang akan di masukkan ke dalam database, biasanya dimasukkan dari mengisi form
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
            'excerpt' => 'required|string',
            'link' => 'nullable|url',
            'user_ids' => 'required|array|min:1',
        ]);

        // Generate slug unik secara otomatis (Mengambil dari function generateUniqueSlug)
        // $slug = $this->generateUniqueSlug($validated['title']);
    }

}
