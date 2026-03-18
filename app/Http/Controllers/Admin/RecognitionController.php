<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recognition;
use Illuminate\Http\Request;

class RecognitionController extends Controller
{
    public function index()
    {
        $recognitions = Recognition::orderBy('order')->paginate(20);
        return view('admin.recognitions.index', compact('recognitions'));
    }

    public function create()
    {
        return view('admin.recognitions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'logo'      => 'required|image|max:2048',
            'order'     => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['logo']      = $request->file('logo')->store('recognitions', 'public');
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['order']     = $request->input('order', 0);

        Recognition::create($validated);
        return redirect()->route('admin.recognitions.index')->with('success', 'Recognition added.');
    }

    public function edit(Recognition $recognition)
    {
        return view('admin.recognitions.edit', compact('recognition'));
    }

    public function update(Request $request, Recognition $recognition)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'logo'      => 'nullable|image|max:2048',
            'order'     => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('recognitions', 'public');
        } else {
            unset($validated['logo']);
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['order']     = $request->input('order', 0);

        $recognition->update($validated);
        return redirect()->route('admin.recognitions.index')->with('success', 'Recognition updated.');
    }

    public function destroy(Recognition $recognition)
    {
        $recognition->delete();
        return redirect()->back()->with('success', 'Recognition deleted.');
    }
}
