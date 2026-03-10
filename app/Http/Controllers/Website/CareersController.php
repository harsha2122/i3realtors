<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CareersController extends Controller
{
    public function index()
    {
        return view('website.careers');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'full_name'        => ['required', 'string', 'max:100'],
            'email'            => ['required', 'email'],
            'phone'            => ['required', 'string', 'max:20'],
            'position'         => ['required', 'string'],
            'experience_years' => ['required', 'integer', 'min:0', 'max:100'],
            'cover_letter'     => ['required', 'string', 'min:10'],
            'resume'           => ['required', 'file', 'mimes:pdf', 'max:5120'],
        ]);

        if ($request->hasFile('resume')) {
            $file = $request->file('resume');
            $filename = $validated['email'] . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = Storage::disk('public')->putFileAs('resumes', $file, $filename);
            $validated['resume'] = $path;
        }

        return back()->with('success', 'Thank you for your application! We will review it shortly.');
    }
}
