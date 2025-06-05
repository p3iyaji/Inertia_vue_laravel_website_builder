<?php

namespace App\Http\Controllers\Admin;

use App\Models\Welcome;
use App\Services\ColorConverter;
use App\Models\WelcomeServe;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WelcomeServeController extends Controller
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
        $welcome = Welcome::findOrFail($id);
        $services = WelcomeServe::where('welcome_id', $id)->latest()->take(3)->get();
        return Inertia::render('Admin/WelcomePage/Services3/Create', [
            'welcome' => $welcome,
            'services' => $services
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {

        $validated = $request->validate([
            'services.*.sectn_3_title' => 'required|string|max:255',
            'services.*.sectn_3_description' => 'required|string',
            'services.*.sectn_3_title_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'services.*.sectn_3ghover_title_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'services.*.sectn_3darkghover_title_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'services.*.sectn_3_bg_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'services.*.sectn_3_dark_bg_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'services.*.sectn_3_description_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'services.*.sectn_3ghover_description_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'services.*.sectn_3dark_description_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'services.*.sectn_3darkhover_description_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
        ]);

        $converter = new ColorConverter();

        foreach ($validated['services'] as $service) {

            $service['welcome_id'] = $id;

            $service['sectn_3_title'] = $service['sectn_3_title'];
            $service['sectn_3_description'] = $service['sectn_3_description'];

            $service['sectn_3_title_color'] = $service['sectn_3_title_color'];
            $service['sectn_3ghover_title_color'] = $service['sectn_3ghover_title_color'];
            $service['sectn_3darkghover_title_color'] = $service['sectn_3darkghover_title_color'];
            $service['sectn_3_bg_color'] = $service['sectn_3_bg_color'];
            $service['sectn_3_dark_bg_color'] = $service['sectn_3_dark_bg_color'];
            $service['sectn_3_description_color'] = $service['sectn_3_description_color'];
            $service['sectn_3ghover_description_color'] = $service['sectn_3ghover_description_color'];
            $service['sectn_3dark_description_color'] = $service['sectn_3dark_description_color'];
            $service['sectn_3darkhover_description_color'] = $service['sectn_3darkhover_description_color'];

            $service['sectn_3_title_color_tw'] = $this->getTailwindClass($service['sectn_3_title_color'], $converter);
            $service['sectn_3ghover_title_color_tw'] = $this->getTailwindClass($service['sectn_3ghover_title_color'], $converter);
            $service['sectn_3darkghover_title_color_tw'] = $this->getTailwindClass($service['sectn_3darkghover_title_color'], $converter);
            $service['sectn_3_bg_color_tw'] = $this->getTailwindClass($service['sectn_3_bg_color'], $converter);
            $service['sectn_3_dark_bg_color_tw'] = $this->getTailwindClass($service['sectn_3_dark_bg_color'], $converter);
            $service['sectn_3_description_color_tw'] = $this->getTailwindClass($service['sectn_3_description_color'], $converter);
            $service['sectn_3ghover_description_color_tw'] = $this->getTailwindClass($service['sectn_3ghover_description_color'], $converter);
            $service['sectn_3dark_description_color_tw'] = $this->getTailwindClass($service['sectn_3dark_description_color'], $converter);
            $service['sectn_3darkhover_description_color_tw'] = $this->getTailwindClass($service['sectn_3darkhover_description_color'], $converter);

           
            WelcomeServe::create($service);

        }

        return to_route('welcomepage.show', $id)->with('success', 'Service added successfully');

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
