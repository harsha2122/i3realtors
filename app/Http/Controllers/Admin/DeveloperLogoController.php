<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeveloperLogo;
use Illuminate\Http\Request;

class DeveloperLogoController extends Controller
{
    public function index()
    {
        $logos = DeveloperLogo::orderBy('order')->paginate(20);
        return view('admin.developer-logos.index', compact('logos'));
    }

    public function create()
    {
        return view('admin.developer-logos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'logo'      => 'required|image|max:2048',
            'link'      => 'nullable|url',
            'order'     => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['logo']      = $request->file('logo')->store('developer-logos', 'public');
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['order']     = $request->input('order', 0);

        DeveloperLogo::create($validated);
        return redirect()->route('admin.developer-logos.index')->with('success', 'Developer logo added.');
    }

    public function edit(DeveloperLogo $developerLogo)
    {
        return view('admin.developer-logos.edit', compact('developerLogo'));
    }

    public function update(Request $request, DeveloperLogo $developerLogo)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'logo'      => 'nullable|image|max:2048',
            'link'      => 'nullable|url',
            'order'     => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('developer-logos', 'public');
        } else {
            unset($validated['logo']);
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['order']     = $request->input('order', 0);

        $developerLogo->update($validated);
        return redirect()->route('admin.developer-logos.index')->with('success', 'Developer logo updated.');
    }

    public function destroy(DeveloperLogo $developerLogo)
    {
        $developerLogo->delete();
        return redirect()->back()->with('success', 'Developer logo deleted.');
    }
}
