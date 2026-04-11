<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\CareerApplication;
use App\Models\CareerJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CareersController extends Controller
{
    public function index()
    {
        $jobs = CareerJob::active()->ordered()->get();
        return view('website.careers', compact('jobs'));
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'career_job_id'    => ['nullable', 'integer'],
            'job_title'        => ['required', 'string', 'max:255'],
            'full_name'        => ['required', 'string', 'max:100'],
            'email'            => ['required', 'email'],
            'phone'            => ['required', 'string', 'max:20'],
            'experience_years' => ['required', 'integer', 'min:0', 'max:50'],
            'cover_letter'     => ['nullable', 'string'],
            'resume'           => ['required', 'file', 'mimes:pdf', 'max:5120'],
        ]);

        $resumePath = null;
        if ($request->hasFile('resume')) {
            $file       = $request->file('resume');
            $filename   = time() . '_' . preg_replace('/[^a-z0-9]/i', '_', $validated['email']) . '.' . $file->getClientOriginalExtension();
            $resumePath = Storage::disk('public')->putFileAs('resumes', $file, $filename);
        }

        CareerApplication::create([
            'career_job_id'    => $validated['career_job_id'] ?: null,
            'job_title'        => $validated['job_title'],
            'full_name'        => $validated['full_name'],
            'email'            => $validated['email'],
            'phone'            => $validated['phone'],
            'experience_years' => $validated['experience_years'],
            'cover_letter'     => $validated['cover_letter'] ?? null,
            'resume_path'      => $resumePath,
        ]);

        return back()->with('success', 'Thank you for applying! We will review your application and get in touch.');
    }
}
