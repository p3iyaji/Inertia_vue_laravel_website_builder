<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mivi;
use App\Models\About;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Services\ColorConverter;

class MiviController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $about = About::findOrFail($id);
        $mivi = Mivi::where('about_id', $id)->get();
        return Inertia::render('Admin/AboutPage/MissionVision/Create', [
            'mivi' => $mivi,
            'about' => $about
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $about = About::findOrFail($id);
        $validated = $request->validate([
            'mission_title' => 'nullable|string|max:255',
            'mission_description' => 'nullable|string',
            'mission_title_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'mission_description_color' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'vision_title' => 'nullable|string|max:255',
            'vision_description' => 'nullable|string',
            'vision_title_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'vision_description_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
        ]);

        $converter = new ColorConverter();

        Mivi::create([
            'about_id' => $about->id,
            'mission_title' => $validated['mission_title'],
            'mission_description' => $validated['mission_description'],
            'mission_title_color' => $validated['mission_title_color'],
            'mission_description_color' => $validated['mission_description_color'],
            'vision_title' => $validated['vision_title'],
            'vision_description' => $validated['vision_description'],
            'vision_title_color' => $validated['vision_title_color'],
            'vision_description_color' => $validated['vision_description_color'],
            'mission_title_color_tw' => $this->getTailwindClass($validated['mission_title_color'], $converter),
            'mission_description_color_tw' => $this->getTailwindClass($validated['mission_description_color'], $converter),
            'vision_title_color_tw' => $this->getTailwindClass($validated['vision_title_color'], $converter),
            'vision_description_color_tw' => $this->getTailwindClass($validated['vision_description_color'], $converter),

        ]);

        return to_route('aboutpage.show', $about->id);
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
        $mivi = Mivi::findOrFail($id);
        return Inertia::render('Admin/AboutPage/MissionVision/Show', [
            'mivi' => $mivi
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $about   = About::findOrFail($id);
        $mivi = Mivi::where('about_id', $id)->get();
        return Inertia::render('Admin/AboutPage/MissionVision/Edit', [
            'mivi' => $mivi,
            'about' => $about
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'mission_title' => 'nullable|string|max:255',
            'mission_description' => 'nullable|string',
            'mission_title_color' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'mission_description_color' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'vision_title' => 'nullable|string|max:255',
            'vision_description' => 'nullable|string',
            'vision_title_color' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'vision_description_color' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
        ]);

        $converter = new ColorConverter();

        $aboutId = About::findOrFail($id);

        Mivi::where('about_id', $aboutId->id)->update([
            'mission_title' => $validated['mission_title'],
            'mission_description' => $validated['mission_description'],
            'mission_title_color' => $validated['mission_title_color'],
            'mission_description_color' => $validated['mission_description_color'],
            'vision_title' => $validated['vision_title'],
            'vision_description' => $validated['vision_description'],
            'vision_title_color' => $validated['vision_title_color'],
            'vision_description_color' => $validated['vision_description_color'],
            'mission_title_color_tw' => $this->getTailwindClass($validated['mission_title_color'], $converter),
            'mission_description_color_tw' => $this->getTailwindClass($validated['mission_description_color'], $converter),
            'vision_title_color_tw' => $this->getTailwindClass($validated['vision_title_color'], $converter),
            'vision_description_color_tw' => $this->getTailwindClass($validated['vision_description_color'], $converter),
        ]);

        return to_route('aboutpage.show', $aboutId->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mivi = Mivi::findOrFail($id);
        $mivi->delete();

        return to_route('aboutpage.show', $mivi->about_id);
    }
}
