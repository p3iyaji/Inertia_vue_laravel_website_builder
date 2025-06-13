<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;
use App\Services\ColorConverter;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return Inertia::render('Admin/ServicePage/Index', [
            'services' => $services
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/ServicePage/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, StoreServiceRequest $validated)
    {
        $validatedData = $validated->validated();

        $converter = new ColorConverter();

        if ($request->hasFile('sloganImage')) {
            $file = $request->file('sloganImage');
            $path = $file->store('services', 'public');
            $validatedData['sloganImage'] = $path;

            Service::create([
                'sectn_services' => $validatedData['sectn_services'],
                'sectn_services_title' => $validatedData['sectn_services_title'],
                'sectn_services_title_color' => $validatedData['sectn_services_title_color'],
                'sectn_header_bg_color' => $validatedData['sectn_header_bg_color'],
                'sectn_someserv' => $validatedData['sectn_someserv'],
                'sectn_someserve_bg_color' => $validatedData['sectn_someserve_bg_color'],
                'sectn_someserve_dark_bg_color' => $validatedData['sectn_someserve_dark_bg_color'],
                'sectn_servslogan' => $validatedData['sectn_servslogan'],
                'sloganImage' => $validatedData['sloganImage'],
                'caption_title' => $validatedData['caption_title'],
                'caption_color' => $validatedData['caption_color'],
                'slogan' => $validatedData['slogan'],
                'slogan_color' => $validatedData['slogan_color'],
                'slogan_bg_color' => $validatedData['slogan_bg_color'],
                'sectn_allserve' => $validatedData['sectn_allserve'],
                'allserve_bg_color' => $validatedData['allserve_bg_color'],

                'sectn_services_title_color_tw' => $this->getTailwindClass($validatedData['sectn_services_title_color'], $converter),
                'sectn_header_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_header_bg_color'], $converter),
                'sectn_someserve_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_someserve_bg_color'], $converter),
                'sectn_someserve_dark_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_someserve_dark_bg_color'], $converter),
                'sectn_servslogan_tw' => $this->getTailwindClass($validatedData['sectn_servslogan'], $converter),
                'caption_color_tw' => $this->getTailwindClass($validatedData['caption_color'], $converter),
                'slogan_color_tw' => $this->getTailwindClass($validatedData['slogan_color'], $converter),
                'slogan_bg_color_tw' => $this->getTailwindClass($validatedData['slogan_bg_color'], $converter),
                'sectn_allserve_tw' => $this->getTailwindClass($validatedData['sectn_allserve'], $converter),
                'allserve_bg_color_tw' => $this->getTailwindClass($validatedData['allserve_bg_color'], $converter),
            ]);

        } else {
            Service::create([
                'sectn_services' => $validatedData['sectn_services'],
                'sectn_services_title' => $validatedData['sectn_services_title'],
                'sectn_services_title_color' => $validatedData['sectn_services_title_color'],
                'sectn_header_bg_color' => $validatedData['sectn_header_bg_color'],
                'sectn_someserv' => $validatedData['sectn_someserv'],
                'sectn_someserve_bg_color' => $validatedData['sectn_someserve_bg_color'],
                'sectn_someserve_dark_bg_color' => $validatedData['sectn_someserve_dark_bg_color'],
                'sectn_servslogan' => $validatedData['sectn_servslogan'],
                'caption_title' => $validatedData['caption_title'],
                'caption_color' => $validatedData['caption_color'],
                'slogan' => $validatedData['slogan'],
                'slogan_color' => $validatedData['slogan_color'],
                'slogan_bg_color' => $validatedData['slogan_bg_color'],
                'sectn_allserve' => $validatedData['sectn_allserve'],
                'allserve_bg_color' => $validatedData['allserve_bg_color'],

                'sectn_services_title_color_tw' => $this->getTailwindClass($validatedData['sectn_services_title_color'], $converter),
                'sectn_header_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_header_bg_color'], $converter),
                'sectn_someserve_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_someserve_bg_color'], $converter),
                'sectn_someserve_dark_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_someserve_dark_bg_color'], $converter),
                'sectn_servslogan_tw' => $this->getTailwindClass($validatedData['sectn_servslogan'], $converter),
                'caption_color_tw' => $this->getTailwindClass($validatedData['caption_color'], $converter),
                'slogan_color_tw' => $this->getTailwindClass($validatedData['slogan_color'], $converter),
                'slogan_bg_color_tw' => $this->getTailwindClass($validatedData['slogan_bg_color'], $converter),
                'sectn_allserve_tw' => $this->getTailwindClass($validatedData['sectn_allserve'], $converter),
                'allserve_bg_color_tw' => $this->getTailwindClass($validatedData['allserve_bg_color'], $converter),
            ]);
        }

        return to_route('servicepage');
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
        return Inertia::render('Admin/ServicePage/Show', [
            'service' => $service
        ]);
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
    public function update(Request $request, StoreServiceRequest $validated, string $id)
    {
     
        $validatedData = $validated->validated();
       
        $converter = new ColorConverter();

        if ($request->hasFile('sloganimage')) {
            $file = $request->file('sloganimage');
            $path = $file->store('services', 'public');
            $validatedData['sloganimage'] = $path;

            $service = Service::findOrFail($id);
            $service->update([
                'sectn_services' => $validatedData['sectn_services'],
                'sectn_services_title' => $validatedData['sectn_services_title'],
                'sectn_services_title_color' => $validatedData['sectn_services_title_color'],
                'sectn_header_bg_color' => $validatedData['sectn_header_bg_color'],
                'sectn_someserv' => $validatedData['sectn_someserv'],
                'sectn_someserve_bg_color' => $validatedData['sectn_someserve_bg_color'],
                'sectn_someserve_dark_bg_color' => $validatedData['sectn_someserve_dark_bg_color'],
                'sectn_servslogan' => $validatedData['sectn_servslogan'],
                'sloganimage' => $path,
                'caption_title' => $validatedData['caption_title'],
                'caption_color' => $validatedData['caption_color'],
                'slogan' => $validatedData['slogan'],
                'slogan_color' => $validatedData['slogan_color'],
                'slogan_bg_color' => $validatedData['slogan_bg_color'],
                'sectn_allserve' => $validatedData['sectn_allserve'],
                'allserve_bg_color' => $validatedData['allserve_bg_color'],

                'sectn_services_title_color_tw' => $this->getTailwindClass($validatedData['sectn_services_title_color'], $converter),
                'sectn_header_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_header_bg_color'], $converter),
                'sectn_someserve_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_someserve_bg_color'], $converter),
                'sectn_someserve_dark_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_someserve_dark_bg_color'], $converter),
                'sectn_servslogan_tw' => $this->getTailwindClass($validatedData['sectn_servslogan'], $converter),
                'caption_color_tw' => $this->getTailwindClass($validatedData['caption_color'], $converter),
                'slogan_color_tw' => $this->getTailwindClass($validatedData['slogan_color'], $converter),
                'slogan_bg_color_tw' => $this->getTailwindClass($validatedData['slogan_bg_color'], $converter),
                'sectn_allserve_tw' => $this->getTailwindClass($validatedData['sectn_allserve'], $converter),
                'allserve_bg_color_tw' => $this->getTailwindClass($validatedData['allserve_bg_color'], $converter),
            ]);

        } else {
            $service = Service::findOrFail($id);
            $service->update([
                'sectn_services' => $validatedData['sectn_services'],
                'sectn_services_title' => $validatedData['sectn_services_title'],
                'sectn_services_title_color' => $validatedData['sectn_services_title_color'],
                'sectn_header_bg_color' => $validatedData['sectn_header_bg_color'],
                'sectn_someserv' => $validatedData['sectn_someserv'],
                'sectn_someserve_bg_color' => $validatedData['sectn_someserve_bg_color'],
                'sectn_someserve_dark_bg_color' => $validatedData['sectn_someserve_dark_bg_color'],
                'sectn_servslogan' => $validatedData['sectn_servslogan'],
                'caption_title' => $validatedData['caption_title'],
                'caption_color' => $validatedData['caption_color'],
                'slogan' => $validatedData['slogan'],
                'slogan_color' => $validatedData['slogan_color'],
                'slogan_bg_color' => $validatedData['slogan_bg_color'],
                'sectn_allserve' => $validatedData['sectn_allserve'],
                'allserve_bg_color' => $validatedData['allserve_bg_color'],

                'sectn_services_title_color_tw' => $this->getTailwindClass($validatedData['sectn_services_title_color'], $converter),
                'sectn_header_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_header_bg_color'], $converter),
                'sectn_someserve_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_someserve_bg_color'], $converter),
                'sectn_someserve_dark_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_someserve_dark_bg_color'], $converter),
                'sectn_servslogan_tw' => $this->getTailwindClass($validatedData['sectn_servslogan'], $converter),
                'caption_color_tw' => $this->getTailwindClass($validatedData['caption_color'], $converter),
                'slogan_color_tw' => $this->getTailwindClass($validatedData['slogan_color'], $converter),
                'slogan_bg_color_tw' => $this->getTailwindClass($validatedData['slogan_bg_color'], $converter),
                'sectn_allserve_tw' => $this->getTailwindClass($validatedData['sectn_allserve'], $converter),
                'allserve_bg_color_tw' => $this->getTailwindClass($validatedData['allserve_bg_color'], $converter),
            ]);
        }

        return to_route('servicepage');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
