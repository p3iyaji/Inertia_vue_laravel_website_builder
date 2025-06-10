<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\SomeServ;
use App\Services\ColorConverter;
use Inertia\Inertia;

class SomeServController extends Controller
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
        $service = Service::findOrFail($id);
        $someServs = SomeServ::where('service_id', $id)->get();
        return Inertia::render('Admin/ServicePage/SomeServ/Create', [
            'service' => $service,
            'someServs' => $someServs
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'someServs.*.sectn_someserv_title' => 'nullable|string|max:255',
            'someServs.*.sectn_someserv_title_color' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'someServs.*.sectn_someserv_description' => 'nullable|string|max:255',
            'someServs.*.sectn_someserv_des_color' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'someServs.*.sectn_someserv_bg_color' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'someServs.*.sectn_someserv_dark_bg_color' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'someServs.*.someservimage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        $converter = new ColorConverter();

        $service = Service::findOrFail($request->service_id);

        foreach ($validated['someServs'] as $someServ) {
            $uniqueName = time().'-'. Str::random(10) . '.'. $someServ['someservimage']->getClientOriginalExtension();
            $path = $someServ['someservimage']->storeAs('service/someserv', $uniqueName, 'public'); 



            SomeServ::create([
                'sectn_someserv_title' => $someServ['sectn_someserv_title'],
                'sectn_someserv_title_color' => $someServ['sectn_someserv_title_color'],
                'sectn_someserv_description' => $someServ['sectn_someserv_description'],
                'sectn_someserv_des_color' => $someServ['sectn_someserv_des_color'],
                'sectn_someserv_bg_color' => $someServ['sectn_someserv_bg_color'],
                'sectn_someserv_dark_bg_color' => $someServ['sectn_someserv_dark_bg_color'],
                'someservimage' => $path,
                'sectn_someserv_title_color_tw' => $this->getTailwindClass($someServ['sectn_someserv_title_color'], $converter),
                'sectn_someserv_des_color_tw' => $this->getTailwindClass($someServ['sectn_someserv_des_color'], $converter),
                'sectn_someserv_bg_color_tw' => $this->getTailwindClass($someServ['sectn_someserv_bg_color'], $converter),
                'sectn_someserv_dark_bg_color_tw' => $this->getTailwindClass($someServ['sectn_someserv_dark_bg_color'], $converter),
                'service_id' => $service->id,
            ]);
        }

        return to_route('servicepage.show', $service->id)->with('success', 'SomeServs created successfully');
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
