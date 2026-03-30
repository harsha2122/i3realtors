<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FundRaisingLogo;
use Illuminate\Http\Request;

class FundRaisingLogoController extends Controller
{
    public function index()
    {
        $logos = FundRaisingLogo::orderBy('id')->paginate(40);
        return view('admin.fund-raising-logos.index', compact('logos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'logos'   => 'required|array|min:1',
            'logos.*' => 'image|max:2048',
        ]);

        foreach ($request->file('logos') as $file) {
            FundRaisingLogo::create([
                'logo'      => $file->store('fund-raising-logos', 'public'),
                'is_active' => true,
            ]);
        }

        return back()->with('success', count($request->file('logos')) . ' logo(s) uploaded successfully.');
    }

    public function edit(FundRaisingLogo $fundRaisingLogo)
    {
        return view('admin.fund-raising-logos.edit', compact('fundRaisingLogo'));
    }

    public function update(Request $request, FundRaisingLogo $fundRaisingLogo)
    {
        $request->validate(['logo' => 'required|image|max:2048']);

        $fundRaisingLogo->update([
            'logo' => $request->file('logo')->store('fund-raising-logos', 'public'),
        ]);

        return redirect()->route('admin.fund-raising-logos.index')->with('success', 'Logo updated.');
    }

    public function destroy(FundRaisingLogo $fundRaisingLogo)
    {
        $fundRaisingLogo->delete();
        return back()->with('success', 'Logo deleted.');
    }
}
