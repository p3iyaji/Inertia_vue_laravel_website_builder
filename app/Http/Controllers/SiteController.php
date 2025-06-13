<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\Navbar;
use App\Models\Footer;
use App\Models\Contact;
use App\Models\Service;
use App\Models\About;
use App\Models\Welcome;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SiteController extends Controller
{
    public function index() {
       $footer = Footer::latest('created_at')->first() ?? [];
       $navbar = Navbar::latest('created_at')->first() ?? [];
       $hero = Hero::latest('created_at')->with('images')->first();
       $welcome = Welcome::with('welcomeserves', 'welcomeourserves', 'companylogos')->first() ?? [];
       
        return Inertia::render('Welcome', [
            'footer' => $footer,
            'navbar' => $navbar,
            'hero'  => $hero,
            'welcome' => $welcome,
        ]);
    }

    public function contact() {
        $footer = Footer::latest('created_at')->first() ?? [];
        $navbar = Navbar::latest('created_at')->first() ?? [];
        $hero = Hero::latest('created_at')->first() ?? [];
        $contact = Contact::latest('created_at')->first() ?? [];
        return Inertia::render('Contact', [
            'footer' => $footer,
            'navbar' => $navbar,
            'hero'  => $hero,
            'contact' => $contact,
        ]);
    }

    public function about() {
        $footer = Footer::latest('created_at')->first() ?? [];
        $navbar = Navbar::latest('created_at')->first() ?? [];
        $hero = Hero::latest('created_at')->first() ?? [];
        
        $about = About::with('teammembers', 'mivis')->first();
        
        return Inertia::render('About', [
            'footer' => $footer,
            'navbar' => $navbar,
            'hero'  => $hero,
            'about' => $about,
        ]);
    }

    public function services() {
        $footer = Footer::latest('created_at')->first() ?? [];
        $navbar = Navbar::latest('created_at')->first() ?? [];
        $hero = Hero::latest('created_at')->first() ?? [];
        $service =Service::with('allserves', 'someservs')->first();     
        
        return Inertia::render('Services', [
            'footer' => $footer,
            'navbar' => $navbar,
            'hero'  => $hero,
            'service' => $service,
        ]);
    }
}
