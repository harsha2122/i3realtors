<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CareerApplication;
use Illuminate\Support\Facades\Storage;

class CareerApplicationController extends Controller
{
    public function index()
    {
        $applications = CareerApplication::with('job')->latest()->paginate(20);
        return view('admin.career-applications.index', compact('applications'));
    }

    public function show(CareerApplication $careerApplication)
    {
        if (!$careerApplication->is_read) {
            $careerApplication->update(['is_read' => true]);
        }
        return view('admin.career-applications.show', compact('careerApplication'));
    }

    public function destroy(CareerApplication $careerApplication)
    {
        if ($careerApplication->resume_path && Storage::disk('public')->exists($careerApplication->resume_path)) {
            Storage::disk('public')->delete($careerApplication->resume_path);
        }
        $careerApplication->delete();
        return redirect()->route('admin.career-applications.index')->with('success', 'Application deleted.');
    }
}
