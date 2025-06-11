<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Str;
use App\Services\ColorConverter;
use Inertia\Inertia;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::all();
        return Inertia::render('Admin/ContactPage/Index', [
            'contacts' => $contacts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/ContactPage/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'src' => 'required|string',
            'main_section' => 'nullable|boolean',
            'office_block_bg_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'office_title' => 'required|string',
            'office_title_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'address' => 'required|string',
            'address_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'email' => 'nullable|string',
            'email_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'phone' => 'nullable|string',
            'phone_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            
        ]);

        $converter = new ColorConverter();

        $contact = new Contact();
        $contact->src = $validated['src'];
        $contact->main_section = $validated['main_section'];
        $contact->office_block_bg_color = $validated['office_block_bg_color'];
        $contact->office_title = $validated['office_title'];
        $contact->office_title_color = $validated['office_title_color'];
        $contact->address = $validated['address'];
        $contact->address_color = $validated['address_color'];
        $contact->email = $validated['email'];
        $contact->email_color = $validated['email_color'];
        $contact->phone = $validated['phone'];
        $contact->phone_color = $validated['phone_color'];
        $contact->office_block_bg_color_tw = $this->getTailwindClass($validated['office_block_bg_color'], $converter);
        $contact->office_title_color_tw = $this->getTailwindClass($validated['office_title_color'], $converter);
        $contact->address_color_tw = $this->getTailwindClass($validated['address_color'], $converter);
        $contact->email_color_tw = $this->getTailwindClass($validated['email_color'], $converter);
        $contact->phone_color_tw = $this->getTailwindClass($validated['phone_color'], $converter);

        $contact->save();

        return to_route('contactpage')->with('success', 'Contact created successfully');
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
        $contact = Contact::findOrFail($id);
        return Inertia::render('Admin/ContactPage/Edit', [
            'contact' => $contact 
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
     
        $validated = $request->validate([
            'src' => 'required|string',
            'main_section' => 'nullable|boolean',
            'office_block_bg_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'office_title' => 'required|string',
            'office_title_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'address' => 'required|string',
            'address_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'email' => 'nullable|string',
            'email_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            'phone' => 'nullable|string',
            'phone_color' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) && 
                    !preg_match('/^[a-z]+-\d{2,3}$/', $value)) {
                    $fail('The '.$attribute.' must be a valid HEX color or Tailwind color class.');
                }
            }],
            
        ]);

        $converter = new ColorConverter();

        $contact = Contact::findOrFail($id);
        $contact->src = $validated['src'];
        $contact->main_section = $validated['main_section'];
        $contact->office_block_bg_color = $validated['office_block_bg_color'];
        $contact->office_title = $validated['office_title'];
        $contact->office_title_color = $validated['office_title_color'];
        $contact->address = $validated['address'];
        $contact->address_color = $validated['address_color'];
        $contact->email = $validated['email'];
        $contact->email_color = $validated['email_color'];
        $contact->phone = $validated['phone'];
        $contact->phone_color = $validated['phone_color'];
        $contact->office_block_bg_color_tw = $this->getTailwindClass($validated['office_block_bg_color'], $converter);
        $contact->office_title_color_tw = $this->getTailwindClass($validated['office_title_color'], $converter);
        $contact->address_color_tw = $this->getTailwindClass($validated['address_color'], $converter);
        $contact->email_color_tw = $this->getTailwindClass($validated['email_color'], $converter);
        $contact->phone_color_tw = $this->getTailwindClass($validated['phone_color'], $converter);

        $contact->update();
        return to_route('contactpage')->with('success', 'Contact updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return to_route('contactpage')->with('success', 'Contact deleted successfully');
    }
}
