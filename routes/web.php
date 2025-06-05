<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\NavbarController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\HeroImagesController;
use App\Http\Controllers\Admin\WelcomePageController;
use App\Http\Controllers\Admin\WelcomeServeController;


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
    //footer admin
    Route::get('pagefooter', [FooterController::class, 'index'])->name('pagefooter');
    Route::post('pagefooter/store', [FooterController::class, 'store'])->name('pagefooter.store');
    Route::post('pagefooter/update/{id}', [FooterController::class, 'update'])->name('pagefooter.update');
    Route::delete('pagefooter/destroy/{id}', [FooterController::class, 'destroy'])->name('pagefooter.destroy');
    //navbar admin
    Route::get('pagenavbar', [NavbarController::class, 'index'])->name('pagenavbar');
    Route::post('pagenavbar/store', [NavbarController::class, 'store'])->name('pagenavbar.store');
    Route::post('pagenavbar/update/{id}', [NavbarController::class, 'update'])->name('pagenavbar.update');
    Route::delete('pagenavbar/destroy/{id}', [NavbarController::class, 'destroy'])->name('pagenavbar.destroy');
    //Hero 
    Route::get('pagehero', [HeroController::class, 'index'])->name('pagehero');
    Route::get('pagehero.create', [HeroController::class, 'create'])->name('pagehero.create');
    Route::post('pagehero/store', [HeroController::class, 'store'])->name('pagehero.store');
    Route::get('pagehero/edit/{id}', [HeroController::class, 'edit'])->name('pagehero.edit');
    Route::delete('pagehero/images/{image}', [HeroImagesController::class, 'destroy'])->name('pagehero.images.destroy');
    Route::post('pagehero/update/{id}', [HeroController::class, 'update'])->name('pagehero.update');
    Route::delete('pagehero/destroy/{id}', [HeroController::class, 'destroy'])->name('pagehero.destroy');

    Route::get('welcomepage', [WelcomePageController::class, 'index'])->name('welcomepage');
    Route::get('welcomepage.create', [WelcomePageController::class, 'create'])->name('welcomepage.create');
    Route::post('welcomepage/store', [WelcomePageController::class, 'store'])->name('welcomepage.store');
    Route::get('welcomepage/edit/{id}', [WelcomePageController::class, 'edit'])->name('welcomepage.edit');
    Route::post('welcomepage/update/{id}', [WelcomePageController::class, 'update'])->name('welcomepage.update');
    Route::get('welcomepage/show/{id}', [WelcomePageController::class, 'show'])->name('welcomepage.show');
    Route::delete('welcomepage/destroy/{id}', [WelcomePageController::class, 'destroy'])->name('welcomepage.destroy');

    //Welcome 3 Services
    Route::get('welcomepage/services3/create/{id}', [WelcomeServeController::class, 'create'])->name('welcomepage.services3.create');
    Route::get('welcomepage/services3/{id}', [WelcomeServeController::class, 'show'])->name('welcomepage.services3');
    Route::post('welcomepage/services3/store/{id}', [WelcomeServeController::class, 'store'])->name('welcomepage.services3.store');
    Route::post('welcomepage/services3/update/{id}', [WelcomeServeController::class, 'update'])->name('welcomepage.services3.update');
    Route::delete('welcomepage/services3/destroy/{id}', [WelcomeServeController::class, 'destroy'])->name('welcomepage.services3.destroy');

    //Website pages admin
   
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
