<?php

use App\Http\Controllers\DashboardWorkController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\ProfileController;

//Halaman Home
Route::get('/', function () {
    return view('pages.home',[
        'title' => 'Home',
    ]);
})->name('home');

//Halaman About
Route::get('/about', function(){
    return view('pages.about',[
        'title' => 'About',
    ]);
})->name('about');

Route::get('/works', [WorkController::class, 'index'])->name('works');

Route::get('/all-works', [WorkController::class, 'works'])->name('works.all');
Route::get('/works/{work:slug}', [WorkController::class, 'work'])->name('works.work');

//Halaman Contact
Route::get('/contact', function(){
    return view('pages.contact');
})->name('contact');

Route::get('/dashboard', [DashboardWorkController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/dashboard', [DashboardWorkController::class, 'store'])->middleware(['auth', 'verified'])->name('dashboard.store');
Route::get('/dashboard/create', [DashboardWorkController::class, 'create'])->middleware(['auth', 'verified'])->name('dashboard.work.create');
Route::get('/dashboard/{work:slug}', [DashboardWorkController::class, 'show'])->middleware(['auth', 'verified'])->name('dashboard.work');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
