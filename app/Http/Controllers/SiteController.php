<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SiteController extends Controller
{
    public function index() {
       $footer = Footer::latest('created_at')->first() ?? [];
        return Inertia::render('Welcome', [
            'footer' => $footer
        ]);
    }

    public function contact() {
        $footer = Footer::latest('created_at')->first() ?? [];
        return Inertia::render('Contact', 
    [
        'footer' => $footer,
    ]);
    }

    public function about() {
        $footer = Footer::latest('created_at')->first() ?? [];
        return Inertia::render('About', 
    [
        'footer' => $footer,
    ]);
    }

    public function services() {
        $footer = Footer::latest('created_at')->first() ?? [];
        return Inertia::render('Services', 
    [
        'footer' => $footer,
    ]);
    }
}
