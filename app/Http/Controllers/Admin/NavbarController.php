<?php

namespace App\Http\Controllers\Admin;

use App\Models\Navbar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Services\ColorConverter;

class NavbarController extends Controller
{
    public function index() 
    {
        $navbars = Navbar::orderBy('created_at', 'desc')->get();
        return Inertia::render('Admin/Settings/PageNavbar', ['navbars' => $navbars]);
    }
    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // max 2MB
            'company_name' => 'required|string|max:255',
            'get_in_touch' => 'required|boolean',
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

        if ($request->hasFile('company_logo')) {
            $file = $request->file('company_logo');
            $path = $file->store('logos', 'public'); // store in /storage/app/public/logos
            $data['company_logo'] = $path;

            $navbar = Navbar::create([
                'company_logo' => $path,
                'company_name' => $validated['company_name'],
                'get_in_touch' => $validated['get_in_touch'],
                'bg_color' => $validated['bg_color'],
                'text_color' => $validated['text_color'],
                'dark_bg_color' => $validated['dark_bg_color'],
                'dark_text_color' => $validated['dark_text_color'],
                'bg_color_tw' => $this->getTailwindClass($validated['bg_color'], $converter),
                'text_color_tw' => $this->getTailwindClass($validated['text_color'], $converter),
                'dark_bg_color_tw' => $this->getTailwindClass($validated['dark_bg_color'], $converter),
                'dark_text_color_tw' => $this->getTailwindClass($validated['dark_text_color'], $converter),
            ]);
        } 

        return to_route('pagenavbar');
    
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

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
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

        if ($request->hasFile('company_logo')) {
            $file = $request->file('company_logo');
            $path = $file->store('logos', 'public'); // store in /storage/app/public/logos
            $data['company_logo'] = $path;

            $navbar = Navbar::find($id);
                $navbar->company_logo = $path;
                $navbar->company_name = $request->company_name;
                $navbar->get_in_touch = $request('get_in_touch');
                $navbar->bg_color = $validated['bg_color'];
                $navbar->text_color = $validated['text_color'];
                $navbar->dark_bg_color = $validated['dark_bg_color'];
                $navbar->dark_text_color = $validated['dark_text_color'];
                $navbar->bg_color_tw = $this->getTailwindClass($validated['bg_color'], $converter);
                $navbar->text_color_tw = $this->getTailwindClass($validated['text_color'], $converter);
                $navbar->dark_bg_color_tw = $this->getTailwindClass($validated['dark_bg_color'], $converter);
                $navbar->dark_text_color_tw = $this->getTailwindClass($validated['dark_text_color'], $converter);
                $navbar->update();
        } else {
            $navbar = Navbar::find($id);
            $navbar->company_name = $request->company_name;
            $navbar->get_in_touch = $request->get_in_touch;
            $navbar->bg_color = $validated['bg_color'];
            $navbar->text_color = $validated['text_color'];
            $navbar->dark_bg_color = $validated['dark_bg_color'];
            $navbar->dark_text_color = $validated['dark_text_color'];
            $navbar->bg_color_tw = $this->getTailwindClass($validated['bg_color'], $converter);
            $navbar->text_color_tw = $this->getTailwindClass($validated['text_color'], $converter);
            $navbar->dark_bg_color_tw = $this->getTailwindClass($validated['dark_bg_color'], $converter);
            $navbar->dark_text_color_tw = $this->getTailwindClass($validated['dark_text_color'], $converter);
            $navbar->update();
        }

        return to_route('pagenavbar');
    
    }

    public function destroy($id)
    {
        $navbar = Navbar::findOrFail($id);
        $navbar->delete();
        return to_route('pagenavbar');
    }
}
