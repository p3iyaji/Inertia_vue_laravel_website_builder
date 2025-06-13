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
use App\Http\Controllers\Admin\WelcomeOurServeController;
use App\Http\Controllers\Admin\WelcomeClientsController;
use App\Http\Controllers\Admin\AboutPageController;
use App\Http\Controllers\Admin\MiviController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SomeServController;
use App\Http\Controllers\Admin\AllServController;
use App\Http\Controllers\Admin\ContactController;

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

    Route::get('welcomepage/oservices/create/{id}', [WelcomeOurServeController::class, 'create'])->name('welcomepage.oservices.create');
    Route::get('welcomepage/oservices/{id}', [WelcomeOurServeController::class, 'show'])->name('welcomepage.oservices');
    Route::post('welcomepage/oservices/store/{id}', [WelcomeOurServeController::class, 'store'])->name('welcomepage.oservices.store');
    Route::post('welcomepage/oservices/update/{id}', [WelcomeOurServeController::class, 'update'])->name('welcomepage.oservices.update');
    Route::delete('welcomepage/oservices/destroy/{id}', [WelcomeOurServeController::class, 'destroy'])->name('welcomepage.oservices.destroy');

    Route::get('welcomepage/clients/create/{id}', [WelcomeClientsController::class, 'create'])->name('welcomepage.clients.create');
    Route::get('welcomepage/clients/{id}', [WelcomeClientsController::class, 'show'])->name('welcomepage.clients');
    Route::post('welcomepage/clients/store/{id}', [WelcomeClientsController::class, 'store'])->name('welcomepage.clients.store');
    Route::post('welcomepage/clients/update/{id}', [WelcomeClientsController::class, 'update'])->name('welcomepage.clients.update');
    Route::delete('welcomepage/clients/destroy/{id}', [WelcomeClientsController::class, 'destroy'])->name('welcomepage.clients.destroy');
    
    // About routes and sub routes for relationships
    Route::get('aboutpage', [AboutPageController::class, 'index'])->name('aboutpage');
    Route::get('aboutpage/create', [AboutPageController::class, 'create'])->name('aboutpage.create');
    Route::post('aboutpage/store', [AboutPageController::class, 'store'])->name('aboutpage.store');
    Route::get('aboutpage/edit/{id}', [AboutPageController::class, 'edit'])->name('aboutpage.edit');
    Route::post('aboutpage/update/{id}', [AboutPageController::class, 'update'])->name('aboutpage.update');
    Route::get('aboutpage/show/{id}', [AboutPageController::class, 'show'])->name('aboutpage.show');

    Route::post('aboutpage/update/{id}', [AboutPageController::class, 'update'])->name('aboutpage.update');
    Route::delete('aboutpage/destroy/{id}', [AboutPageController::class, 'destroy'])->name('aboutpage.destroy');

    Route::get('aboutpage/teammembers/create/{id}', [TeamMemberController::class, 'create'])->name('aboutpage.teammembers.create');
    Route::post('aboutpage/teammembers/store/{id}', [TeamMemberController::class, 'store'])->name('aboutpage.teammembers.store');
    Route::post('aboutpage/teammembers/update/{id}', [TeamMemberController::class, 'update'])->name('aboutpage.teammembers.update');
    Route::delete('aboutpage/teammembers/destroy/{id}', [TeamMemberController::class, 'destroy'])->name('aboutpage.teammembers.destroy');

    Route::get('aboutpage/missionvision/create/{id}', [MiviController::class, 'create'])->name('aboutpage.missionvision.create');
    Route::post('aboutpage/missionvision/store/{id}', [MiviController::class, 'store'])->name('aboutpage.missionvision.store');
    Route::put('aboutpage/missionvision/update/{id}', [MiviController::class, 'update'])->name('aboutpage.missionvision.update');
    Route::delete('aboutpage/missionvision/destroy/{id}', [MiviController::class, 'destroy'])->name('aboutpage.missionvision.destroy');

    //Services Route
    Route::get('servicepage', [ServiceController::class, 'index'])->name('servicepage');
    Route::get('servicepage/create', [ServiceController::class, 'create'])->name('servicepage.create');
    Route::post('servicepage/store', [ServiceController::class, 'store'])->name('servicepage.store');
    Route::get('servicepage/show/{id}', [ServiceController::class, 'show'])->name('servicepage.show');
    Route::get('servicepage/edit/{id}', [ServiceController::class, 'edit'])->name('servicepage.edit');
    Route::post('servicepage/update/{id}', [ServiceController::class, 'update'])->name('servicepage.update');
    Route::delete('servicepage/destroy/{id}', [ServiceController::class, 'destroy'])->name('servicepage.destroy');
    
    Route::get('servicepage/someserv/create/{id}', [SomeServController::class, 'create'])->name('servicepage.someserv.create');
    Route::post('servicepage/someserv/store/{id}', [SomeServController::class, 'store'])->name('servicepage.someserv.store');
    Route::post('servicepage/someserv/update/{id}', [SomeServController::class, 'update'])->name('servicepage.someserv.update');
    Route::delete('servicepage/someserv/destroy/{id}', [SomeServController::class, 'destroy'])->name('servicepage.someserv.destroy');
    
    Route::get('servicepage/allserv/create/{id}', [AllServController::class, 'create'])->name('servicepage.allserv.create');
    Route::post('servicepage/allserv/store/{id}', [AllServController::class, 'store'])->name('servicepage.allserv.store');
    Route::post('servicepage/allserv/update/{id}', [AllServController::class, 'update'])->name('servicepage.allserv.update');
    Route::delete('servicepage/allserv/destroy/{id}', [AllServController::class, 'destroy'])->name('servicepage.allserv.destroy');
   
    // Routes for contact
    Route::get('contactpage', [ContactController::class, 'index'])->name('contactpage');
    Route::get('contactpage/create', [ContactController::class, 'create'])->name('contactpage.create');
    Route::post('contactpage/store', [ContactController::class, 'store'])->name('contactpage.store');
    Route::get('contactpage/edit/{id}', [ContactController::class, 'edit'])->name('contactpage.edit');
    Route::post('contactpage/update/{id}', [ContactController::class, 'update'])->name('contactpage.update');
    Route::delete('contactpage/destroy/{id}', [ContactController::class, 'destroy'])->name('contactpage.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});
 
require __DIR__.'/auth.php';
