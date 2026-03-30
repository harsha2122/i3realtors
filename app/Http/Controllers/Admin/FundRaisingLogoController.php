<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FundRaisingLogo;
use Illuminate\Http\Request;

class FundRaisingLogoController extends Controller
{
    public function index()
    {
        $logos = FundRaisingLogo::orderBy('sort_order')->orderBy('id')->paginate(20);
        return view('admin.fund-raising-logos.index', compact('logos'));
    }

    public function create()
    {
        return view('admin.fund-raising-logos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'logo'       => 'required|image|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active'  => 'nullable|boolean',
        ]);

        $validated['logo']       = $request->file('logo')->store('fund-raising-logos', 'public');
        $validated['is_active']  = $request->boolean('is_active', true);
        $validated['sort_order'] = $request->input('sort_order', 0);

        FundRaisingLogo::create($validated);
        return redirect()->route('admin.fund-raising-logos.index')->with('success', 'Logo added.');
    }

    public function edit(FundRaisingLogo $fundRaisingLogo)
    {
        return view('admin.fund-raising-logos.edit', compact('fundRaisingLogo'));
    }

    public function update(Request $request, FundRaisingLogo $fundRaisingLogo)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'logo'       => 'nullable|image|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active'  => 'nullable|boolean',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('fund-raising-logos', 'public');
        } else {
            unset($validated['logo']);
        }

        $validated['is_active']  = $request->boolean('is_active');
        $validated['sort_order'] = $request->input('sort_order', 0);

        $fundRaisingLogo->update($validated);
        return redirect()->route('admin.fund-raising-logos.index')->with('success', 'Logo updated.');
    }

    public function destroy(FundRaisingLogo $fundRaisingLogo)
    {
        $fundRaisingLogo->delete();
        return redirect()->back()->with('success', 'Logo deleted.');
    }
}
