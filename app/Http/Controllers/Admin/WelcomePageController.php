<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreWelcomepageRequest;
use App\Models\Welcome;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Services\ColorConverter;

class WelcomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/WelcomePage/Index',[
            'welcomes' => Welcome::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/WelcomePage/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, StoreWelcomepageRequest $validated)
    {
        $validatedData = $validated->validated();

        $converter = new ColorConverter();

        if ($request->hasFile('services_image')) {
            $file = $request->file('services_image');
            $path = $file->store('welcomes', 'public');
            $validatedData['services_image'] = $path;

            $welcome = Welcome::create([
                'sectn_wwd' => $validatedData['sectn_wwd'],
                'sectn_wwd_bg_color' => $validatedData['sectn_wwd_bg_color'],
                'sectn_ccn' => $validatedData['sectn_ccn'],
                'sectn_ccn_bg_color' => $validatedData['sectn_ccn_bg_color'],
                'ccn_title' => $validatedData['ccn_title'],
                'ccn_title_color' => $validatedData['ccn_title_color'],
                'ccn_description' => $validatedData['ccn_description'],
                'ccn_description_color' => $validatedData['ccn_description_color'],
                'ccn_btn_title' => $validatedData['ccn_btn_title'],
                'btn_ccn_bg_color' => $validatedData['btn_ccn_bg_color'],
                'btn_ccn_text_color' => $validatedData['btn_ccn_text_color'],
        
                'sectn_3_services',
                // other parts in welcome serve relationship
        
                
                'sectn_oservices',
                'sectn_oserv_bg_color' => $validatedData['sectn_oserv_bg_color'],
                'sectn_oservdark_bg_color' => $validatedData['sectn_oservdark_bg_color'],
                // other parts in our services relationship
               
        
                'sectn_services' => $validatedData['sectn_services'],
                'sectn_serv_title' => $validatedData['sectn_serv_title'],
                'sectn_serv_description' => $validatedData['sectn_serv_description'],
                'sectn_serv_bg_color' => $validatedData['sectn_serv_bg_color'],
                'sectn_serv_title_color' => $validatedData['sectn_serv_title_color'],
                'sectn_serv_description_color' => $validatedData['sectn_serv_description_color'],
        
                'sectn_client_logo' => $validatedData['sectn_client_logo'],
                'sectn_client_title' => $validatedData['sectn_client_title'],
                'sectn_client_text_color' => $validatedData['sectn_client_text_color'],
                'sectn_client_bg_color' => $validatedData['sectn_client_bg_color'],
                'sectn_dclient_text_color' => $validatedData['sectn_dclient_text_color'],
                'sectn_dclient_bg_color' => $validatedData['sectn_dclient_bg_color'],
                
                // Tailwind classes
                'sectn_wwd_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_wwd_bg_color'], $converter),
                'sect_ccn_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_ccn_bg_color'], $converter),
                'ccn_title_color_tw' => $this->getTailwindClass($validatedData['ccn_title_color'], $converter),
                'ccn_description_color_tw' => $this->getTailwindClass($validatedData['ccn_description_color'], $converter),
                'btn_ccn_bg_color_tw' => $this->getTailwindClass($validatedData['btn_ccn_bg_color'], $converter),
                'btn_ccn_text_color_tw' => $this->getTailwindClass($validatedData['btn_ccn_text_color'], $converter),
        
        
        
                'sectn_oserv_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_oserv_bg_color'], $converter),
                'sectn_oservdark_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_oservdark_bg_color'], $converter),
        
                'sectn_serv_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_serv_bg_color'], $converter),
                'sectn_serv_title_color_tw' => $this->getTailwindClass($validatedData['sectn_serv_title_color'], $converter),
                'sectn_serv_description_color_tw' => $this->getTailwindClass($validatedData['sectn_serv_description_color'], $converter),
                'sectn_client_text_color_tw' => $this->getTailwindClass($validatedData['sectn_client_text_color'], $converter),
                'sectn_client_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_client_bg_color'], $converter),
                'sectn_dclient_text_color_tw' => $this->getTailwindClass($validatedData['sectn_dclient_text_color'], $converter),
                'sectn_dclient_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_dclient_bg_color'], $converter),
            ]);
        } else {
            $welcome = Welcome::create([
                'sectn_wwd' => $validatedData['sectn_wwd'],
                'sectn_wwd_bg_color' => $validatedData['sectn_wwd_bg_color'],
                'sectn_ccn' => $validatedData['sectn_ccn'],
                'sectn_ccn_bg_color' => $validatedData['sectn_ccn_bg_color'],
                'ccn_title' => $validatedData['ccn_title'],
                'ccn_title_color' => $validatedData['ccn_title_color'],
                'ccn_description' => $validatedData['ccn_description'],
                'ccn_description_color' => $validatedData['ccn_description_color'],
                'ccn_btn_title' => $validatedData['ccn_btn_title'],
                'btn_ccn_bg_color' => $validatedData['btn_ccn_bg_color'],
                'btn_ccn_text_color' => $validatedData['btn_ccn_text_color'],
        
                'sectn_3_services',
                // other parts in welcome serve relationship
        
                
                'sectn_oservices',
                'sectn_oserv_bg_color' => $validatedData['sectn_oserv_bg_color'],
                'sectn_oservdark_bg_color' => $validatedData['sectn_oservdark_bg_color'],
                // other parts in our services relationship
               
        
                'sectn_services' => $validatedData['sectn_services'],
                'sectn_serv_title' => $validatedData['sectn_serv_title'],
                'sectn_serv_description' => $validatedData['sectn_serv_description'],
                'services_image' => $validatedData['services_image'],
                'sectn_serv_bg_color' => $validatedData['sectn_serv_bg_color'],
                'sectn_serv_title_color' => $validatedData['sectn_serv_title_color'],
                'sectn_serv_description_color' => $validatedData['sectn_serv_description_color'],
        
                'sectn_client_logo' => $validatedData['sectn_client_logo'],
                'sectn_client_title' => $validatedData['sectn_client_title'],
                'sectn_client_text_color' => $validatedData['sectn_client_text_color'],
                'sectn_client_bg_color' => $validatedData['sectn_client_bg_color'],
                'sectn_dclient_text_color' => $validatedData['sectn_dclient_text_color'],
                'sectn_dclient_bg_color' => $validatedData['sectn_dclient_bg_color'],
                
                // Tailwind classes
                'sectn_wwd_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_wwd_bg_color'], $converter),
                'sect_ccn_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_ccn_bg_color'], $converter),
                'ccn_title_color_tw' => $this->getTailwindClass($validatedData['ccn_title_color'], $converter),
                'ccn_description_color_tw' => $this->getTailwindClass($validatedData['ccn_description_color'], $converter),
                'btn_ccn_bg_color_tw' => $this->getTailwindClass($validatedData['btn_ccn_bg_color'], $converter),
                'btn_ccn_text_color_tw' => $this->getTailwindClass($validatedData['btn_ccn_text_color'], $converter),
        
        
        
                'sectn_oserv_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_oserv_bg_color'], $converter),
                'sectn_oservdark_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_oservdark_bg_color'], $converter),
        
                'sectn_serv_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_serv_bg_color'], $converter),
                'sectn_serv_title_color_tw' => $this->getTailwindClass($validatedData['sectn_serv_title_color'], $converter),
                'sectn_serv_description_color_tw' => $this->getTailwindClass($validatedData['sectn_serv_description_color'], $converter),
                'sectn_client_text_color_tw' => $this->getTailwindClass($validatedData['sectn_client_text_color'], $converter),
                'sectn_client_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_client_bg_color'], $converter),
                'sectn_dclient_text_color_tw' => $this->getTailwindClass($validatedData['sectn_dclient_text_color'], $converter),
                'sectn_dclient_bg_color_tw' => $this->getTailwindClass($validatedData['sectn_dclient_bg_color'], $converter),
            ]);

        }

        return to_route('welcomepage');
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
        return Inertia::render('Admin/WelcomePage/Show', [
            'welcome' => Welcome::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return Inertia::render('Admin/WelcomePage/Edit', [
            'welcome' => Welcome::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StoreWelcomepageRequest $validated, string $id)
    {
        $validatedData = $validated->validated();

        $converter = new ColorConverter();

        if ($request->hasFile('services_image')) {
            $file = $request->file('services_image');
            $path = $file->store('welcomes', 'public');
            $validatedData['services_image'] = $path;

            $welcome = Welcome::findorFail($id);
                $welcome->sectn_wwd = $validatedData['sectn_wwd'];
                $welcome->sectn_wwd_bg_color = $validatedData['sectn_wwd_bg_color'];
                $welcome->sectn_ccn = $validatedData['sectn_ccn'];
                $welcome->sectn_ccn_bg_color = $validatedData['sectn_ccn_bg_color'];
                $welcome->ccn_title = $validatedData['ccn_title'];
                $welcome->ccn_title_color = $validatedData['ccn_title_color'];
                $welcome->ccn_description = $validatedData['ccn_description'];
                $welcome->ccn_description_color = $validatedData['ccn_description_color'];
                $welcome->ccn_btn_title = $validatedData['ccn_btn_title'];
                $welcome->btn_ccn_bg_color = $validatedData['btn_ccn_bg_color'];
                $welcome->btn_ccn_text_color = $validatedData['btn_ccn_text_color'];
        
                $welcome->sectn_3_services = $validatedData['sectn_3_services'];
                // other parts in welcome serve relationship
        
                
                $welcome->sectn_oservices = $validatedData['sectn_oservices'];
                $welcome->sectn_oserv_bg_color = $validatedData['sectn_oserv_bg_color'];
                $welcome->sectn_oservdark_bg_color = $validatedData['sectn_oservdark_bg_color'];
                // other parts in our services relationship
               
        
                $welcome->sectn_services = $validatedData['sectn_services'];
                $welcome->sectn_serv_title = $validatedData['sectn_serv_title'];
                $welcome->sectn_serv_description = $validatedData['sectn_serv_description'];
                $welcome->sectn_serv_bg_color = $validatedData['sectn_serv_bg_color'];
                $welcome->sectn_serv_title_color = $validatedData['sectn_serv_title_color'];
                $welcome->sectn_serv_description_color = $validatedData['sectn_serv_description_color'];
        
                $welcome->sectn_client_logo = $validatedData['sectn_client_logo'];
                $welcome->sectn_client_title = $validatedData['sectn_client_title'];
                $welcome->sectn_client_text_color = $validatedData['sectn_client_text_color'];
                $welcome->sectn_client_bg_color = $validatedData['sectn_client_bg_color'];
                $welcome->sectn_dclient_text_color = $validatedData['sectn_dclient_text_color'];
                $welcome->sectn_dclient_bg_color = $validatedData['sectn_dclient_bg_color'];
                
                // Tailwind classes
                $welcome->sectn_wwd_bg_color_tw = $this->getTailwindClass($validatedData['sectn_wwd_bg_color'], $converter);
                $welcome->sect_ccn_bg_color_tw = $this->getTailwindClass($validatedData['sectn_ccn_bg_color'], $converter);
                $welcome->ccn_title_color_tw = $this->getTailwindClass($validatedData['ccn_title_color'], $converter);
                $welcome->ccn_description_color_tw = $this->getTailwindClass($validatedData['ccn_description_color'], $converter);
                $welcome->btn_ccn_bg_color_tw = $this->getTailwindClass($validatedData['btn_ccn_bg_color'], $converter);
                $welcome->btn_ccn_text_color_tw = $this->getTailwindClass($validatedData['btn_ccn_text_color'], $converter);
        
        
        
                $welcome->sectn_oserv_bg_color_tw = $this->getTailwindClass($validatedData['sectn_oserv_bg_color'], $converter);
                $welcome->sectn_oservdark_bg_color_tw = $this->getTailwindClass($validatedData['sectn_oservdark_bg_color'], $converter);
        
                $welcome->sectn_serv_bg_color_tw = $this->getTailwindClass($validatedData['sectn_serv_bg_color'], $converter);
                $welcome->sectn_serv_title_color_tw = $this->getTailwindClass($validatedData['sectn_serv_title_color'], $converter);
                $welcome->sectn_serv_description_color_tw = $this->getTailwindClass($validatedData['sectn_serv_description_color'], $converter);
                $welcome->sectn_client_text_color_tw = $this->getTailwindClass($validatedData['sectn_client_text_color'], $converter);
                $welcome->sectn_client_bg_color_tw = $this->getTailwindClass($validatedData['sectn_client_bg_color'], $converter);
                $welcome->sectn_dclient_text_color_tw = $this->getTailwindClass($validatedData['sectn_dclient_text_color'], $converter);
                $welcome->sectn_dclient_bg_color_tw = $this->getTailwindClass($validatedData['sectn_dclient_bg_color'], $converter);
                $welcome->update();
        } else {
            $welcome = Welcome::findOrFail($id);
            $welcome->sectn_wwd = $validatedData['sectn_wwd'];
            $welcome->sectn_wwd_bg_color = $validatedData['sectn_wwd_bg_color'];
            $welcome->sectn_ccn = $validatedData['sectn_ccn'];
            $welcome->sectn_ccn_bg_color = $validatedData['sectn_ccn_bg_color'];
            $welcome->ccn_title = $validatedData['ccn_title'];
            $welcome->ccn_title_color = $validatedData['ccn_title_color'];
            $welcome->ccn_description = $validatedData['ccn_description'];
            $welcome->ccn_description_color = $validatedData['ccn_description_color'];
            $welcome->ccn_btn_title = $validatedData['ccn_btn_title'];
            $welcome->btn_ccn_bg_color = $validatedData['btn_ccn_bg_color'];
            $welcome->btn_ccn_text_color = $validatedData['btn_ccn_text_color'];
        
            $welcome->sectn_3_services = $validatedData['sectn_3_services'];
                // other parts in welcome serve relationship
        
                
            $welcome->sectn_oservices = $validatedData['sectn_oservices'];
            $welcome->sectn_oserv_bg_color = $validatedData['sectn_oserv_bg_color'];
            $welcome->sectn_oservdark_bg_color = $validatedData['sectn_oservdark_bg_color'];
                // other parts in our services relationship
               
        
            $welcome->sectn_services = $validatedData['sectn_services'];
            $welcome->sectn_serv_title = $validatedData['sectn_serv_title'];
            $welcome->sectn_serv_description = $validatedData['sectn_serv_description'];
            $welcome->services_image = $validatedData['services_image'];
            $welcome->sectn_serv_bg_color = $validatedData['sectn_serv_bg_color'];
            $welcome->sectn_serv_title_color = $validatedData['sectn_serv_title_color'];
            $welcome->sectn_serv_description_color = $validatedData['sectn_serv_description_color'];
        
            $welcome->sectn_client_logo = $validatedData['sectn_client_logo'];
            $welcome->sectn_client_title = $validatedData['sectn_client_title'];
            $welcome->sectn_client_text_color = $validatedData['sectn_client_text_color'];
            $welcome->sectn_client_bg_color = $validatedData['sectn_client_bg_color'];
            $welcome->sectn_dclient_text_color = $validatedData['sectn_dclient_text_color'];
            $welcome->sectn_dclient_bg_color = $validatedData['sectn_dclient_bg_color'];
                
                // Tailwind classes
            $welcome->sectn_wwd_bg_color_tw = $this->getTailwindClass($validatedData['sectn_wwd_bg_color'], $converter);
            $welcome->sect_ccn_bg_color_tw = $this->getTailwindClass($validatedData['sectn_ccn_bg_color'], $converter);
            $welcome->ccn_title_color_tw = $this->getTailwindClass($validatedData['ccn_title_color'], $converter);
            $welcome->ccn_description_color_tw = $this->getTailwindClass($validatedData['ccn_description_color'], $converter);
            $welcome->btn_ccn_bg_color_tw = $this->getTailwindClass($validatedData['btn_ccn_bg_color'], $converter);
            $welcome->btn_ccn_text_color_tw = $this->getTailwindClass($validatedData['btn_ccn_text_color'], $converter);
        
        
        
            $welcome->sectn_oserv_bg_color_tw = $this->getTailwindClass($validatedData['sectn_oserv_bg_color'], $converter);
            $welcome->sectn_oservdark_bg_color_tw = $this->getTailwindClass($validatedData['sectn_oservdark_bg_color'], $converter);
        
            $welcome->sectn_serv_bg_color_tw = $this->getTailwindClass($validatedData['sectn_serv_bg_color'], $converter);
            $welcome->sectn_serv_title_color_tw = $this->getTailwindClass($validatedData['sectn_serv_title_color'], $converter);
            $welcome->sectn_serv_description_color_tw = $this->getTailwindClass($validatedData['sectn_serv_description_color'], $converter);
            $welcome->sectn_client_text_color_tw = $this->getTailwindClass($validatedData['sectn_client_text_color'], $converter);
            $welcome->sectn_client_bg_color_tw = $this->getTailwindClass($validatedData['sectn_client_bg_color'], $converter);
            $welcome->sectn_dclient_text_color_tw = $this->getTailwindClass($validatedData['sectn_dclient_text_color'], $converter);
            $welcome->sectn_dclient_bg_color_tw = $this->getTailwindClass($validatedData['sectn_dclient_bg_color'], $converter);
            $welcome->update();

        }

        return to_route('welcomepage');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
