<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\TeamMember;
use Inertia\Inertia;
use App\Services\ColorConverter;
use Illuminate\Support\Str;

class TeamMemberController extends Controller
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
        $about = About::findOrFail($id);
        $teamMembers = TeamMember::where('about_id', $id)->get();
        return Inertia::render('Admin/AboutPage/TeamMembers/Create', [
            'about' => $about,
            'teamMembers' => $teamMembers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
       
        $validated = $request->validate([
            'teamMembers.*.team_mem_name' => 'nullable|string|max:255',
            'teamMembers.*.team_mem_position' => 'nullable|string|max:255',
            'teamMembers.*.team_mem_description' => 'nullable|string|max:255',
            'teamMembers.*.team_mem_name_color' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'teamMembers.*.team_mem_position_color' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'teamMembers.*.team_mem_description_color' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'teamMembers.*.team_mem_bg_color' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'teamMembers.*.team_mem_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2053',
        ]);

        $converter = new ColorConverter();

        $about = About::findOrFail($id);

        foreach ($validated['teamMembers'] as $teamMember) {

            $uniqueName = time().'-'. Str::random(10) . '.'. $teamMember['team_mem_image']->getClientOriginalExtension();
            $path = $teamMember['team_mem_image']->storeAs('team_members', $uniqueName, 'public'); 

            TeamMember::create([
                'about_id' => $about->id,
                'team_mem_name' => $teamMember['team_mem_name'] ?? null,  
                'team_mem_image' => $path ?? null,
                'team_mem_position' => $teamMember['team_mem_position'] ?? null,
                'team_mem_description' => $teamMember['team_mem_description'] ?? null,
                'team_mem_name_color' => $teamMember['team_mem_name_color'] ?? null,
                'team_mem_position_color' => $teamMember['team_mem_position_color'] ?? null,
                'team_mem_description_color' => $teamMember['team_mem_description_color'] ?? null,
                'team_mem_bg_color' => $teamMember['team_mem_bg_color'] ?? null,
                'team_mem_name_color_tw' => $this->getTailwindClass($teamMember['team_mem_name_color'], $converter),
                'team_mem_position_color_tw' => $this->getTailwindClass($teamMember['team_mem_position_color'], $converter),
                'team_mem_description_color_tw' => $this->getTailwindClass($teamMember['team_mem_description_color'], $converter),
                'team_mem_bg_color_tw' => $this->getTailwindClass($teamMember['team_mem_bg_color'], $converter),
            ]);
        }

        return to_route('aboutpage.show', $id);
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
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'teamMembers.*.id' => 'nullable|integer|exists:team_members,id',
            'teamMembers.*.team_mem_name' => 'nullable|string|max:255',
            'teamMembers.*.team_mem_position' => 'nullable|string|max:255',
            'teamMembers.*.team_mem_description' => 'nullable|string|max:255',
            'teamMembers.*.team_mem_name_color' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if (!empty($value) && !preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'teamMembers.*.team_mem_position_color' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if (!empty($value) && !preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'teamMembers.*.team_mem_description_color' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if (!empty($value) && !preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'teamMembers.*.team_mem_bg_color' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if (!empty($value) && !preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'teamMembers.*.team_mem_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2053',
        ]);
    
        $about = About::findOrFail($id);
        $converter = new ColorConverter();
    
        foreach ($validated['teamMembers'] as $teamMemberData) {
            if (isset($teamMemberData['id'])) {
                // Update existing team member
                $teamMember = TeamMember::find($teamMemberData['id']);
                
                if ($teamMember) {
                    $updateData = [
                        'team_mem_name' => $teamMemberData['team_mem_name'] ?? null,
                        'team_mem_position' => $teamMemberData['team_mem_position'] ?? null,
                        'team_mem_description' => $teamMemberData['team_mem_description'] ?? null,
                        'team_mem_name_color' => $teamMemberData['team_mem_name_color'] ?? null,
                        'team_mem_position_color' => $teamMemberData['team_mem_position_color'] ?? null,
                        'team_mem_description_color' => $teamMemberData['team_mem_description_color'] ?? null,
                        'team_mem_bg_color' => $teamMemberData['team_mem_bg_color'] ?? null,
                        'team_mem_name_color_tw' => $this->getTailwindClass($teamMemberData['team_mem_name_color'] ?? null, $converter),
                        'team_mem_position_color_tw' => $this->getTailwindClass($teamMemberData['team_mem_position_color'] ?? null, $converter),
                        'team_mem_description_color_tw' => $this->getTailwindClass($teamMemberData['team_mem_description_color'] ?? null, $converter),
                        'team_mem_bg_color_tw' => $this->getTailwindClass($teamMemberData['team_mem_bg_color'] ?? null, $converter),
                    ];
    
                    // Handle image update if provided
                    if (isset($teamMemberData['team_mem_image'])) {
                        // Delete old image if exists
                        if ($teamMember->team_mem_image) {
                            Storage::disk('public')->delete($teamMember->team_mem_image);
                        }
                        
                        $uniqueName = time().'-'. Str::random(10) . '.'. $teamMemberData['team_mem_image']->getClientOriginalExtension();
                        $path = $teamMemberData['team_mem_image']->storeAs('team_members', $uniqueName, 'public');
                        $updateData['team_mem_image'] = $path;
                    }
    
                    $teamMember->update($updateData);
                }
            } else {
                // Create new team member
                $createData = [
                    'about_id' => $about->id,
                    'team_mem_name' => $teamMemberData['team_mem_name'] ?? null,
                    'team_mem_position' => $teamMemberData['team_mem_position'] ?? null,
                    'team_mem_description' => $teamMemberData['team_mem_description'] ?? null,
                    'team_mem_name_color' => $teamMemberData['team_mem_name_color'] ?? null,
                    'team_mem_position_color' => $teamMemberData['team_mem_position_color'] ?? null,
                    'team_mem_description_color' => $teamMemberData['team_mem_description_color'] ?? null,
                    'team_mem_bg_color' => $teamMemberData['team_mem_bg_color'] ?? null,
                    'team_mem_name_color_tw' => $this->getTailwindClass($teamMemberData['team_mem_name_color'] ?? null, $converter),
                    'team_mem_position_color_tw' => $this->getTailwindClass($teamMemberData['team_mem_position_color'] ?? null, $converter),
                    'team_mem_description_color_tw' => $this->getTailwindClass($teamMemberData['team_mem_description_color'] ?? null, $converter),
                    'team_mem_bg_color_tw' => $this->getTailwindClass($teamMemberData['team_mem_bg_color'] ?? null, $converter),
                ];
    
                if (isset($teamMemberData['team_mem_image'])) {
                    $uniqueName = time().'-'. Str::random(10) . '.'. $teamMemberData['team_mem_image']->getClientOriginalExtension();
                    $path = $teamMemberData['team_mem_image']->storeAs('team_members', $uniqueName, 'public');
                    $createData['team_mem_image'] = $path;
                }
    
                TeamMember::create($createData);
            }
        }
    
        return redirect()->route('aboutpage.show', $id)->with('success', 'Team members updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teamMember = TeamMember::findOrFail($id);
    
        // Delete associated image
        if ($teamMember->team_mem_image) {
            Storage::disk('public')->delete($teamMember->team_mem_image);
        }
        
        $teamMember->delete();
        
        return back()->with('success', 'Team member deleted successfully');
    }
}
