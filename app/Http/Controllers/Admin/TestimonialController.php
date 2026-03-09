<?php

namespace App\Http\Controllers\Admin;

use App\Domains\Services\Models\Testimonial;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(15);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'author_name' => 'required|string',
            'author_title' => 'nullable|string',
            'company' => 'nullable|string',
            'author_image' => 'nullable|image|max:2048',
            'company_logo' => 'nullable|image|max:2048',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'is_featured' => 'nullable|boolean',
        ]);

        if ($request->hasFile('author_image')) {
            $validated['author_image'] = $request->file('author_image')->store('testimonials', 'public');
        }
        if ($request->hasFile('company_logo')) {
            $validated['company_logo'] = $request->file('company_logo')->store('testimonials', 'public');
        }

        Testimonial::create($validated);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'author_name' => 'required|string',
            'author_title' => 'nullable|string',
            'company' => 'nullable|string',
            'author_image' => 'nullable|image|max:2048',
            'company_logo' => 'nullable|image|max:2048',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'is_featured' => 'nullable|boolean',
        ]);

        if ($request->hasFile('author_image')) {
            $validated['author_image'] = $request->file('author_image')->store('testimonials', 'public');
        }
        if ($request->hasFile('company_logo')) {
            $validated['company_logo'] = $request->file('company_logo')->store('testimonials', 'public');
        }

        $testimonial->update($validated);
        return redirect()->back()->with('success', 'Testimonial updated');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->back()->with('success', 'Testimonial deleted');
    }
}
