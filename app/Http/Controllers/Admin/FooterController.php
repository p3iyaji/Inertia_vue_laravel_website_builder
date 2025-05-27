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
        $footers = Footer::get();
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
            'bg_color' => 'required|string|size:7|starts_with:#',
            'text_color' => 'required|string|size:7|starts_with:#',
            'dark_bg_color' => 'required|string|size:7|starts_with:#',
            'dark_text_color' => 'required|string|size:7|starts_with:#',
        ]);
    
        $converter = new ColorConverter();

        $footer = Footer::create([
            'company_name' => $validated['company_name'],
            'year' => $validated['year'],
            'bg_color' => $validated['bg_color'],
            'text_color' => $validated['text_color'],
            'dark_bg_color' => $validated['dark_bg_color'],
            'dark_text_color' => $validated['dark_text_color'],
            'bg_color_tw' => $converter->hexToTailwind($validated['bg_color']),
            'text_color_tw' => $converter->hexToTailwind($validated['text_color']),
            'dark_bg_color_tw' => $converter->hexToTailwind($validated['dark_bg_color']),
            'dark_text_color_tw' => $converter->hexToTailwind($validated['dark_text_color']),
        ]);

        return redirect()->route('pagefooter')->with('success', 'Footer created successfully');
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
    public function edit(string $id)
    {
        //
    }

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
