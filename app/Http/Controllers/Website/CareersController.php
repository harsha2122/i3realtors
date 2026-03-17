<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
            'full_name'          => ['required', 'string', 'max:100'],
            'email'              => ['required', 'email'],
            'phone'              => ['required', 'string', 'max:20'],
            'position'           => ['required', 'string'],
            'experience_years'   => ['required', 'integer', 'min:0', 'max:50'],
            'preferred_location' => ['nullable', 'string', 'max:100'],
            'cover_letter'       => ['required', 'string', 'min:10'],
            'resume'             => ['required', 'file', 'mimes:pdf', 'max:5120'],
        ]);

        $resumePath = null;
        if ($request->hasFile('resume')) {
            $file       = $request->file('resume');
            $filename   = $validated['email'] . '_' . time() . '.' . $file->getClientOriginalExtension();
            $resumePath = Storage::disk('public')->putFileAs('resumes', $file, $filename);
        }

        // Send notification email to admin
        $adminEmail = Setting::get('admin_email', 'admin@i3realtors.com');

        try {
            Mail::send([], [], function ($message) use ($validated, $resumePath, $adminEmail) {
                $message->to($adminEmail)
                    ->subject('New Career Application: ' . $validated['position'] . ' — ' . $validated['full_name'])
                    ->html(
                        '<h2>New Career Application</h2>' .
                        '<table cellpadding="8" style="border-collapse:collapse; font-family:sans-serif; font-size:14px;">' .
                        '<tr><td><strong>Name</strong></td><td>' . e($validated['full_name']) . '</td></tr>' .
                        '<tr><td><strong>Email</strong></td><td><a href="mailto:' . e($validated['email']) . '">' . e($validated['email']) . '</a></td></tr>' .
                        '<tr><td><strong>Phone</strong></td><td>' . e($validated['phone']) . '</td></tr>' .
                        '<tr><td><strong>Department</strong></td><td>' . e($validated['position']) . '</td></tr>' .
                        '<tr><td><strong>Experience</strong></td><td>' . e($validated['experience_years']) . ' year(s)</td></tr>' .
                        '<tr><td><strong>Preferred Location</strong></td><td>' . e($validated['preferred_location'] ?? '—') . '</td></tr>' .
                        '<tr><td><strong>Cover Letter</strong></td><td>' . nl2br(e($validated['cover_letter'])) . '</td></tr>' .
                        ($resumePath ? '<tr><td><strong>Resume</strong></td><td>Stored at: ' . e($resumePath) . '</td></tr>' : '') .
                        '</table>'
                    );

                if ($resumePath && Storage::disk('public')->exists($resumePath)) {
                    $message->attach(Storage::disk('public')->path($resumePath), [
                        'as'   => 'resume_' . $validated['full_name'] . '.pdf',
                        'mime' => 'application/pdf',
                    ]);
                }
            });
        } catch (\Exception $e) {
            // Log silently — do not block applicant submission
            logger()->error('Career application email failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Thank you for your application! We will review it and get in touch if your profile matches our requirements.');
    }
}
