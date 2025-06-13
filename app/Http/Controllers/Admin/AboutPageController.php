<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreAboutPageRequest;
use App\Services\ColorConverter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;

use Inertia\Inertia;

class AboutPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = About::all();
        return Inertia::render('Admin/AboutPage/Index', [
            'abouts' => $abouts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/AboutPage/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, StoreAboutPageRequest $validated)
    {
        $validatedData = $validated->validated();

        if ($request->hasFile('slogan_image')) {
            $file = $request->file('slogan_image');
            $path = $file->store('abouts', 'public');
            $validatedData['slogan_image'] = $path;
        }

        $converter = new ColorConverter();

      if($request->hasFile('slogan_image')){
        $file = $request->file('slogan_image');
        $path = $file->store('abouts', 'public');
        $validatedData['slogan_image'] = $path;

        $about = About::create([
            'sectn_header' => $validatedData['sectn_header'],
            'sectn_header_title' => $validatedData['sectn_header_title'],
            'sectn_header_title_color' => $validatedData['sectn_header_title_color'],
            'sectn_header_description' => $validatedData['sectn_header_description'],
            'sectn_header_description_color' => $validatedData['sectn_header_description_color'],
            'sectn_header_bg_color' => $validatedData['sectn_header_bg_color'],
            'sectn_header_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_header_bg_color'], $converter),
            'sectn_mivi' => $validatedData['sectn_mivi'],
            'sectn_slogan' => $validatedData['sectn_slogan'],
            'sectn_slogan_caption' => $validatedData['sectn_slogan_caption'],
            'sectn_slogan_subcaption' => $validatedData['sectn_slogan_subcaption'],
            'slogan_image' => $validatedData['slogan_image'],
            'sectn_slogan_caption_color' => $validatedData['sectn_slogan_caption_color'],
            'sectn_slogan_caption_color_tw' => $this->getTailwindClass($validatedData['sectn_slogan_caption_color'], $converter),
            'sectn_slogan_bg_color' => $validatedData['sectn_slogan_bg_color'],
            'sectn_slogan_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_slogan_bg_color'], $converter),
            'sectn_slogan_subcaption_color' => $validatedData['sectn_slogan_subcaption_color'],
            'sectn_slogan_subcaption_color_tw' => $this->getTailwindClass($validatedData['sectn_slogan_subcaption_color'], $converter),
            'sectn_team' => $validatedData['sectn_team'],
            'team_title' => $validatedData['team_title'],
            'team_caption' => $validatedData['team_caption'],
            'team_title_color' => $validatedData['team_title_color'],
            'team_title_color_tw' => $this->getTailwindClass($validatedData['team_title_color'], $converter),
            'team_caption_color' => $validatedData['team_caption_color'],
            'team_caption_color_tw' => $this->getTailwindClass($validatedData['team_caption_color'], $converter),
            'team_bg_color' => $validatedData['team_bg_color'],
            'team_bg_color_tw' => $this->getTailwindClass($validatedData['team_bg_color'], $converter),
            'sectn_team_mem' => $validatedData['sectn_team_mem'],
        ]);
      } else {
        $about = About::create([
            'sectn_header' => $validatedData['sectn_header'],
            'sectn_header_title' => $validatedData['sectn_header_title'],
            'sectn_header_title_color' => $validatedData['sectn_header_title_color'],
            'sectn_header_title_color_tw' => $this->getTailwindClass($validatedData['sectn_header_title_color'], $converter),
            'sectn_header_description' => $validatedData['sectn_header_description'],
            'sectn_header_description_color' => $validatedData['sectn_header_description_color'],
            'sectn_header_description_color_tw' => $this->getTailwindClass($validatedData['sectn_header_description_color'], $converter),
            'sectn_header_bg_color' => $validatedData['sectn_header_bg_color'],
            'sectn_header_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_header_bg_color'], $converter),
            'sectn_mivi' => $validatedData['sectn_mivi'],
            'sectn_slogan' => $validatedData['sectn_slogan'],
            'sectn_slogan_caption' => $validatedData['sectn_slogan_caption'],
            'sectn_slogan_subcaption' => $validatedData['sectn_slogan_subcaption'],
            'sectn_slogan_caption_color' => $validatedData['sectn_slogan_caption_color'],
            'sectn_slogan_caption_color_tw' => $this->getTailwindClass($validatedData['sectn_slogan_caption_color'], $converter),
            'sectn_slogan_bg_color' => $validatedData['sectn_slogan_bg_color'],
            'sectn_slogan_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_slogan_bg_color'], $converter),
            'sectn_slogan_subcaption_color' => $validatedData['sectn_slogan_subcaption_color'],
            'sectn_slogan_subcaption_color_tw' => $this->getTailwindClass($validatedData['sectn_slogan_subcaption_color'], $converter),
            'sectn_team' => $validatedData['sectn_team'],
            'team_title' => $validatedData['team_title'],
            'team_caption' => $validatedData['team_caption'],
            'team_title_color' => $validatedData['team_title_color'],
            'team_title_color_tw' => $this->getTailwindClass($validatedData['team_title_color'], $converter),
            'team_caption_color' => $validatedData['team_caption_color'],
            'team_caption_color_tw' => $this->getTailwindClass($validatedData['team_caption_color'], $converter),
            'team_bg_color' => $validatedData['team_bg_color'],
            'team_bg_color_tw' => $this->getTailwindClass($validatedData['team_bg_color'], $converter),
            'sectn_team_mem' => $validatedData['sectn_team_mem'],
        ]);
      }

        return to_route('aboutpage')->with('success', 'About page created successfully');
    }

    protected function getTailwindClass(string $color, ColorConverter $converter): string
    {
        // If already in Tailwind format (like 'red-500'), return as-is
        if (preg_match('/^[a-z]+-\d{2,3}$/', $color)) {
            return $color;
        }
        
        // Otherwise convert from hex
        return $converter->hexToTailwind($color);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $about = About::findOrFail($id);
        return Inertia::render('Admin/AboutPage/Show', [
            'about' => $about
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $about = About::findOrFail($id);
        return Inertia::render('Admin/AboutPage/Edit', [
            'about' => $about
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAboutPageRequest $validated, string $id)
    {
        $validatedData = $validated->validated();

        if ($validated->hasFile('slogan_image')) {
            $file = $validated->file('slogan_image');
            $path = $file->store('abouts', 'public');
            $validatedData['slogan_image'] = $path;
        }

        $converter = new ColorConverter();

      if($validated->hasFile('slogan_image')){
        $file = $validated->file('slogan_image');
        $path = $file->store('abouts', 'public');
        $validatedData['slogan_image'] = $path;

        $about = About::findOrFail($id);
        $about->update([
            'sectn_header' => $validatedData['sectn_header'],
            'sectn_header_title' => $validatedData['sectn_header_title'],
            'sectn_header_title_color' => $validatedData['sectn_header_title_color'],
            'sectn_header_description' => $validatedData['sectn_header_description'],
            'sectn_header_description_color' => $validatedData['sectn_header_description_color'],
            'sectn_header_bg_color' => $validatedData['sectn_header_bg_color'],
            'sectn_header_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_header_bg_color'], $converter),
            'sectn_mivi' => $validatedData['sectn_mivi'],
            'sectn_slogan' => $validatedData['sectn_slogan'],
            'sectn_slogan_caption' => $validatedData['sectn_slogan_caption'],
            'sectn_slogan_subcaption' => $validatedData['sectn_slogan_subcaption'],
            'slogan_image' => $validatedData['slogan_image'],
            'sectn_slogan_caption_color' => $validatedData['sectn_slogan_caption_color'],
            'sectn_slogan_caption_color_tw' => $this->getTailwindClass($validatedData['sectn_slogan_caption_color'], $converter),
            'sectn_slogan_bg_color' => $validatedData['sectn_slogan_bg_color'],
            'sectn_slogan_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_slogan_bg_color'], $converter),
            'sectn_slogan_subcaption_color' => $validatedData['sectn_slogan_subcaption_color'],
            'sectn_slogan_subcaption_color_tw' => $this->getTailwindClass($validatedData['sectn_slogan_subcaption_color'], $converter),
            'sectn_team' => $validatedData['sectn_team'],
            'team_title' => $validatedData['team_title'],
            'team_caption' => $validatedData['team_caption'],
            'team_title_color' => $validatedData['team_title_color'],
            'team_title_color_tw' => $this->getTailwindClass($validatedData['team_title_color'], $converter),
            'team_caption_color' => $validatedData['team_caption_color'],
            'team_caption_color_tw' => $this->getTailwindClass($validatedData['team_caption_color'], $converter),
            'team_bg_color' => $validatedData['team_bg_color'],
            'team_bg_color_tw' => $this->getTailwindClass($validatedData['team_bg_color'], $converter),
            'sectn_team_mem' => $validatedData['sectn_team_mem'],
        ]);
      } else {
        $about = About::findOrFail($id);
        $about->update([
            'sectn_header' => $validatedData['sectn_header'],
            'sectn_header_title' => $validatedData['sectn_header_title'],
            'sectn_header_title_color' => $validatedData['sectn_header_title_color'],
            'sectn_header_title_color_tw' => $this->getTailwindClass($validatedData['sectn_header_title_color'], $converter),
            'sectn_header_description' => $validatedData['sectn_header_description'],
            'sectn_header_description_color' => $validatedData['sectn_header_description_color'],
            'sectn_header_description_color_tw' => $this->getTailwindClass($validatedData['sectn_header_description_color'], $converter),
            'sectn_header_bg_color' => $validatedData['sectn_header_bg_color'],
            'sectn_header_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_header_bg_color'], $converter),
            'sectn_mivi' => $validatedData['sectn_mivi'],
            'sectn_slogan' => $validatedData['sectn_slogan'],
            'sectn_slogan_caption' => $validatedData['sectn_slogan_caption'],
            'sectn_slogan_subcaption' => $validatedData['sectn_slogan_subcaption'],
            'sectn_slogan_caption_color' => $validatedData['sectn_slogan_caption_color'],
            'sectn_slogan_caption_color_tw' => $this->getTailwindClass($validatedData['sectn_slogan_caption_color'], $converter),
            'sectn_slogan_bg_color' => $validatedData['sectn_slogan_bg_color'],
            'sectn_slogan_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_slogan_bg_color'], $converter),
            'sectn_slogan_subcaption_color' => $validatedData['sectn_slogan_subcaption_color'],
            'sectn_slogan_subcaption_color_tw' => $this->getTailwindClass($validatedData['sectn_slogan_subcaption_color'], $converter),
            'sectn_team' => $validatedData['sectn_team'],
            'team_title' => $validatedData['team_title'],
            'team_caption' => $validatedData['team_caption'],
            'team_title_color' => $validatedData['team_title_color'],
            'team_title_color_tw' => $this->getTailwindClass($validatedData['team_title_color'], $converter),
            'team_caption_color' => $validatedData['team_caption_color'],
            'team_caption_color_tw' => $this->getTailwindClass($validatedData['team_caption_color'], $converter),
            'team_bg_color' => $validatedData['team_bg_color'],
            'team_bg_color_tw' => $this->getTailwindClass($validatedData['team_bg_color'], $converter),
            'sectn_team_mem' => $validatedData['sectn_team_mem'],
        ]);
      }

        return to_route('aboutpage')->with('success', 'About page updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
