<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Admin\FooterController;
use Inertia\Inertia;

Route::get('/', [SiteController::class, 'index'])->name('home');

Route::get('/contact', [SiteController::class, 'contact'])->name('contact');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('/services', [SiteController::class, 'services'])->name('services');


// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION
//     ]);
// });


Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('pagefooter', [FooterController::class, 'index'])->name('pagefooter');
    Route::post('pagefooter.store', [FooterController::class, 'store'])->name('pagefooter.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

require __DIR__.'/auth.php';
