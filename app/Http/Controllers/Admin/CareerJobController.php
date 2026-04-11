<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CareerJob;
use Illuminate\Http\Request;

class CareerJobController extends Controller
{
    public function index()
    {
        $jobs = CareerJob::ordered()->paginate(20);
        return view('admin.career-jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('admin.career-jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'           => ['required', 'string', 'max:255'],
            'category'        => ['required', 'string', 'max:100'],
            'employment_type' => ['required', 'string', 'max:100'],
            'location'        => ['required', 'string', 'max:100'],
            'experience'      => ['nullable', 'string', 'max:100'],
            'description'     => ['nullable', 'string'],
            'responsibilities'=> ['nullable', 'string'],
            'requirements'    => ['nullable', 'string'],
            'status'          => ['required', 'in:active,inactive'],
            'sort_order'      => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['responsibilities'] = $this->parseLines($request->input('responsibilities'));
        $validated['requirements']     = $this->parseLines($request->input('requirements'));

        CareerJob::create($validated);

        return redirect()->route('admin.career-jobs.index')->with('success', 'Job created successfully.');
    }

    public function edit(CareerJob $careerJob)
    {
        return view('admin.career-jobs.edit', compact('careerJob'));
    }

    public function update(Request $request, CareerJob $careerJob)
    {
        $validated = $request->validate([
            'title'           => ['required', 'string', 'max:255'],
            'category'        => ['required', 'string', 'max:100'],
            'employment_type' => ['required', 'string', 'max:100'],
            'location'        => ['required', 'string', 'max:100'],
            'experience'      => ['nullable', 'string', 'max:100'],
            'description'     => ['nullable', 'string'],
            'responsibilities'=> ['nullable', 'string'],
            'requirements'    => ['nullable', 'string'],
            'status'          => ['required', 'in:active,inactive'],
            'sort_order'      => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['responsibilities'] = $this->parseLines($request->input('responsibilities'));
        $validated['requirements']     = $this->parseLines($request->input('requirements'));

        $careerJob->update($validated);

        return redirect()->route('admin.career-jobs.index')->with('success', 'Job updated successfully.');
    }

    public function destroy(CareerJob $careerJob)
    {
        $careerJob->delete();
        return redirect()->route('admin.career-jobs.index')->with('success', 'Job deleted.');
    }

    /** Convert newline-separated text into a JSON array */
    private function parseLines(?string $text): array
    {
        if (!$text) return [];
        return array_values(array_filter(array_map('trim', explode("\n", $text))));
    }
}
