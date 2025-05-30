<?php

namespace App\Http\Controllers\Admin;

use App\Models\Footer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Services\ColorConverter;

class FooterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $footers = Footer::orderBy('created_at', 'desc')->get();
        return Inertia::render('Admin/Settings/PageFooter', [ 'footers' => $footers ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'year' => 'required|integer',
            'bg_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],

            'text_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'dark_bg_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'dark_text_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
        ]);
    
        $converter = new ColorConverter();

        $footer = Footer::create([
            'company_name' => $validated['company_name'],
            'year' => $validated['year'],
            'bg_color' => $validated['bg_color'],
            'text_color' => $validated['text_color'],
            'dark_bg_color' => $validated['dark_bg_color'],
            'dark_text_color' => $validated['dark_text_color'],
            'bg_color_tw' => $this->getTailwindClass($validated['bg_color'], $converter),
            'text_color_tw' => $this->getTailwindClass($validated['text_color'], $converter),
            'dark_bg_color_tw' => $this->getTailwindClass($validated['dark_bg_color'], $converter),
            'dark_text_color_tw' => $this->getTailwindClass($validated['dark_text_color'], $converter),
        ]);
    
        return to_route('pagefooter');
        
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'year' => 'required|integer',
            'bg_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],

            'text_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'dark_bg_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'dark_text_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
        ]);
    
        $converter = new ColorConverter();

        $footer = Footer::findOrFail($id);
      
            $footer->company_name = $validated['company_name'];
            $footer->year = $validated['year'];
            $footer->bg_color = $validated['bg_color'];
            $footer->text_color = $validated['text_color'];
            $footer->dark_bg_color = $validated['dark_bg_color'];
            $footer->dark_text_color = $validated['dark_text_color'];
            $footer->bg_color_tw = $this->getTailwindClass($validated['bg_color'], $converter);
            $footer->text_color_tw = $this->getTailwindClass($validated['text_color'], $converter);
            $footer->dark_bg_color_tw = $this->getTailwindClass($validated['dark_bg_color'], $converter);
            $footer->dark_text_color_tw = $this->getTailwindClass($validated['dark_text_color'], $converter);
            $footer->update();
    
        return to_route('pagefooter');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    
        $footer = Footer::find($id);
        $footer->delete();
        return to_route('pagefooter');
    }
}
