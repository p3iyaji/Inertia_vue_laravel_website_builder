<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\AllServe;
use App\Services\ColorConverter;
use Illuminate\Support\Str;
use Inertia\Inertia;

class AllServController extends Controller
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
        $allServs = AllServe::where('service_id', $id)->get();
        return Inertia::render('Admin/ServicePage/AllServe/Create', ['service' => $service, 'allServs' => $allServs]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
         $validated = $request->validate([
            'allServs.*.allserve_title' => 'nullable|string|max:255',
            'allServs.*.allserve_title_color' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'allServs.*.allserve_description' => 'nullable|string|max:255',
            'allServs.*.allserve_description_color' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'allServs.*.allserve_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
         ]);

         $converter = new ColorConverter();

         $service = Service::findOrFail($id);

         foreach ($validated['allServs'] as $allServ) {
            $uniqueName = time().'-'. Str::random(10) . '.'. $allServ['allserve_image']->getClientOriginalExtension();
            $path = $allServ['allserve_image']->storeAs('service/allserv', $uniqueName, 'public'); 

            $allServ = AllServe::create([
                'allserve_title' => $allServ['allserve_title'],
                'allserve_title_color' => $allServ['allserve_title_color'],
                'allserve_description' => $allServ['allserve_description'],
                'allserve_description_color' => $allServ['allserve_description_color'],
                'allserve_title_color_tw' => $this->getTailwindClass($allServ['allserve_title_color'], $converter),
                'allserve_description_color_tw' => $this->getTailwindClass($allServ['allserve_description_color'], $converter),
                'allserve_image' => $path,
                'service_id' => $service->id,
            ]);
         }

         return to_route('servicepage.show', $service->id)->with('success', 'All Services saved successfully');
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
        $service = Service::findOrFail($id);
        $allServs = AllServe::where('service_id', $id)->get();
        return Inertia::render('Admin/ServicePage/AllServe/Create', [
            'service' => $service,
            'allServs' => $allServs
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $allServ = AllServe::findOrFail($id);
        $service = Service::findOrFail($allServ->service_id);
        return Inertia::render('Admin/ServicePage/AllServe/Edit', [
            'service' => $service,
            'allServ' => $allServ
        ]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'allServs.*.id' => 'nullable|exists:all_serves,id', // Add validation for ID
            'allServs.*.allserve_title' => 'nullable|string|max:255',
            'allServs.*.allserve_title_color' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'allServs.*.allserve_description' => 'nullable|string',
            'allServs.*.allserve_description_color' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'allServs.*.allserve_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        $converter = new ColorConverter();

        $service = Service::findOrFail($id);

 
        foreach ($validated['allServs'] as $inputData) {
            if (!empty($inputData['id'])) {
                $allServ = AllServe::find($inputData['id']);
                if ($allServ) {
                    $updateData = [
                        'allserve_title' => $inputData['allserve_title'],
                        'allserve_title_color' => $inputData['allserve_title_color'],
                        'allserve_description' => $inputData['allserve_description'],
                        'allserve_description_color' => $inputData['allserve_description_color'],
                        'allserve_title_color_tw' => $this->getTailwindClass($inputData['allserve_title_color'], $converter),
                        'allserve_description_color_tw' => $this->getTailwindClass($inputData['allserve_description_color'], $converter),
             
                    ];

                    if (isset($inputData['allserve_image'])) {
                        if ($allServ->allserve_image) {
                            Storage::disk('public')->delete($allServ->allserve_image);
                        }
                        
                        $uniqueName = time().'-'. Str::random(10) . '.'. $inputData['allserve_image']->getClientOriginalExtension();
                        $path = $inputData['allserve_image']->storeAs('service/allserv', $uniqueName, 'public'); 
                        $updateData['allserve_image'] = $path;  
                        
                    }

                    $allServ->update($updateData);
                }
                
            } else {
                $createData = [
                    'allserve_title' => $inputData['allserve_title'],
                    'allserve_title_color' => $inputData['allserve_title_color'],
                    'allserve_description' => $inputData['allserve_description'],
                    'allserve_description_color' => $inputData['allserve_description_color'],
                    'allserve_title_color_tw' => $this->getTailwindClass($inputData['allserve_title_color'], $converter),
                    'allserve_description_color_tw' => $this->getTailwindClass($inputData['allserve_description_color'], $converter),
                    'service_id' => $service->id,
                ];

                if (isset($inputData['allserve_image'])) {
                    $uniqueName = time().'-'. Str::random(10) . '.'. $inputData['allserve_image']->getClientOriginalExtension();
                    $path = $inputData['allserve_image']->storeAs('service/allserv', $uniqueName, 'public'); 
                    $createData['allserve_image'] = $path;  
                }

                AllServe::create($createData);
            }
            
        }

        return to_route('servicepage.show', $service->id)->with('success', 'All Service updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
