<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Welcome;
use App\Models\WelcomeOurServe;
use Inertia\Inertia;
use App\Services\ColorConverter;

class WelcomeOurServeController extends Controller
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
        $oservices = WelcomeOurServe::where('welcome_id', $id)->latest()->take(4)->get();
        return Inertia::render('Admin/WelcomePage/OurServices/Create', [
            'welcome' => $welcome,
            'oservices' => $oservices
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'oservices.*.sectn_oserv_title' => 'required|string|max:255',
            'oservices.*.sectn_oserv_description' => 'required|string',
         
            
            'oservices.*.sectn_oservh_bg_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'oservices.*.sectn_oservhd_bg_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'oservices.*.sectn_oserv_title_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'oservices.*.sectn_oservdark_title_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'oservices.*.sectn_oservhover_title_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'oservices.*.sectn_oservdarkhover_title_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'oservices.*.sectn_oserv_description_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'oservices.*.sectn_oservh_description_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'oservices.*.sectn_oservd_description_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'oservices.*.sectn_oservdh_description_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
          
        ]);

        $converter = new ColorConverter();

        foreach ($validated['oservices'] as $oservice) {

            $oservice['welcome_id'] = $id;

            $oservice['sectn_oserv_title'] = $oservice['sectn_oserv_title'];
            $oservice['sectn_oserv_description'] = $oservice['sectn_oserv_description'];
            $oservice['sectn_oserv_title_color'] = $oservice['sectn_oserv_title_color'];
            $oservice['sectn_oservh_bg_color'] = $oservice['sectn_oservh_bg_color'];
            $oservice['sectn_oservhd_bg_color'] = $oservice['sectn_oservhd_bg_color'];
            $oservice['sectn_oserv_title_color'] = $oservice['sectn_oserv_title_color'];
            $oservice['sectn_oservdark_title_color'] = $oservice['sectn_oservdark_title_color'];
            $oservice['sectn_oservhover_title_color'] = $oservice['sectn_oservhover_title_color'];
            $oservice['sectn_oservdarkhover_title_color'] = $oservice['sectn_oservdarkhover_title_color'];
            $oservice['sectn_oserv_description_color'] = $oservice['sectn_oserv_description_color'];
            $oservice['sectn_oservh_description_color'] = $oservice['sectn_oservh_description_color'];
            $oservice['sectn_oservd_description_color'] = $oservice['sectn_oservd_description_color'];
            $oservice['sectn_oservdh_description_color'] = $oservice['sectn_oservdh_description_color'];

           


            $oservice['sectn_oserv_title_color_tw'] = $this->getTailwindClass($oservice['sectn_oserv_title_color'], $converter);

            $oservice['sectn_oservh_bg_color_tw'] = $this->getTailwindClass($oservice['sectn_oservh_bg_color'], $converter);
            $oservice['sectn_oservhd_bg_color_tw'] = $this->getTailwindClass($oservice['sectn_oservhd_bg_color'], $converter);
            $oservice['sectn_oserv_title_color_tw'] = $this->getTailwindClass($oservice['sectn_oserv_title_color'], $converter);
            $oservice['sectn_oservdark_title_color_tw'] = $this->getTailwindClass($oservice['sectn_oservdark_title_color'], $converter);
            $oservice['sectn_oservhover_title_color_tw'] = $this->getTailwindClass($oservice['sectn_oservhover_title_color'], $converter);
            $oservice['sectn_oservdarkhover_title_color_tw'] = $this->getTailwindClass($oservice['sectn_oservdarkhover_title_color'], $converter);
            $oservice['sectn_oserv_description_color_tw'] = $this->getTailwindClass($oservice['sectn_oserv_description_color'], $converter);
            $oservice['sectn_oservh_description_color_tw'] = $this->getTailwindClass($oservice['sectn_oservh_description_color'], $converter);
            $oservice['sectn_oservd_description_color_tw'] = $this->getTailwindClass($oservice['sectn_oservd_description_color'], $converter);
            $oservice['sectn_oservdh_description_color_tw'] = $this->getTailwindClass($oservice['sectn_oservdh_description_color'], $converter);
            WelcomeOurServe::create($oservice);
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
