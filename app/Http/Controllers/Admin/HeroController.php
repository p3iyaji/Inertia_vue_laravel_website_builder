<?php

namespace App\Http\Controllers\Admin;

use Str;
use App\Models\Hero;
use App\Models\HeroImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HeroController extends Controller
{
    public function index() 
    {
        $heroes = Hero::orderBy('created_at', 'desc')->get();
        return Inertia::render('Admin/Settings/PageHero', ['heroes' => $heroes]);
    }

    public function create()
    {
        return Inertia::render('Admin/Settings/CreatePageHero');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2053',
            'caption' => 'nullable|string|max:255',
            'sub_caption' => 'nullable|string|max:255',
            'contact_title' => 'nullable|string|max:255',
            'contact_link' => 'nullable|string|max:255',
            'learn_title' => 'nullable|string|max:255',
            'learn_link' => 'nullable|string|max:255',
        ]);

        $hero = Hero::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $uniqueName = time().'-'. Str::random(10) . '.'. $image->getClientOriginalExtension();
                $path = $image->storeAs('images', $uniqueName, 'public'); 
        
                HeroImage::create([
                    'hero_id' => $hero->id,
                    'image' => $path, // Saves as "images/abc123.jpg"
                ]);
            }
        }

        return to_route('pagehero');

    }

    public function edit($id)
    {
        $heropage = Hero::find($id);
        $hero = $heropage->load('images');
        
        return Inertia::render('Admin/Settings/EditPageHero', 
        [
            'hero' => $hero,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2053',
            'caption' => 'nullable|string|max:255',
            'sub_caption' => 'nullable|string|max:255',
            'contact_title' => 'nullable|string|max:255',
            'contact_link' => 'nullable|string|max:255',
            'learn_title' => 'nullable|string|max:255',
            'learn_link' => 'nullable|string|max:255',      
        ]);

        $hero = Hero::find($id);

        $hero->update($validated);

        // Handle image uploads if present
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Generate unique filename
                $filename = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();

                // Store the image (using the public disk)
                $path = $image->storeAs('images', $filename, 'public');

                // Create product image record
                $hero->images()->create([
                    'image' => $path
                ]);
            }
        }
        return to_route('pagehero');
    }

    public function destroy($id)
    {
        $hero = Hero::find($id);
        $hero->delete();
        return to_route('pagehero');
    }
}
