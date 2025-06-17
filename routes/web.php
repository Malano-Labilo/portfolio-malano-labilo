<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\ProfileController;

//Halaman Home
Route::get('/', function () {
    return view('pages.home');
})->name('home');

//Halaman About
Route::get('/about', function(){
    return view('pages.about');
})->name('about');

Route::get('/works', [WorkController::class, 'index'])->name('works');

Route::get('/all-works', [WorkController::class, 'works'])->name('works.all');
Route::get('/works/{work:slug}', [WorkController::class, 'work'])->name('works.work');

// Route::get('/all-works?creator={user:username}', [WorkController::class, 'users'])->name('works.user');
// Route::get('/all-works?category={category:slug}', [CategoryController::class, 'show'])->name('works.category');

//Halaman Contact
Route::get('/contact', function(){
    return view('pages.contact');
})->name('contact');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
