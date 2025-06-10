<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Welcome;
use App\Models\CompanyLogo;
use Inertia\Inertia;
use Str;

class WelcomeClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/WelcomePage/Clients/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $welcome = Welcome::findOrFail($id);
        $clients = CompanyLogo::where('welcome_id', $id)->get();
        return Inertia::render('Admin/WelcomePage/Clients/Create', [
            'welcome' => $welcome,
            'clients' => $clients
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'clients.*.name' => 'required|string|max:255',
            'clients.*.logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2053',
        ]);

        foreach ($validated['clients'] as $client) {
            $uniqueName = time().'-'. Str::random(10) . '.'. $client['logo']->getClientOriginalExtension();
            $path = $client['logo']->storeAs('images', $uniqueName, 'public'); 
            CompanyLogo::create([
                'welcome_id' => $id,
                'name' => $client['name'],  
                'logo' => $path,
            ]);
        }

        return to_route('welcomepage.show', $id);
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
