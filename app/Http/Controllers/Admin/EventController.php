<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::ordered()->paginate(20);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);
        $validated['slug'] = $this->uniqueSlug($request->input('title'));
        $validated['images'] = $this->handleImages($request, []);

        Event::create($validated);
        return redirect()->route('admin.events.index')->with('success', 'Event created.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $this->validateRequest($request, $event);
        $validated['images'] = $this->handleImages($request, $event->images ?? []);

        // Delete removed images
        $keep = $request->input('keep_images', []);
        foreach (($event->images ?? []) as $img) {
            if (!in_array($img, $keep) && Storage::disk('public')->exists($img)) {
                Storage::disk('public')->delete($img);
            }
        }

        $event->update($validated);
        return redirect()->route('admin.events.index')->with('success', 'Event updated.');
    }

    public function destroy(Event $event)
    {
        foreach ($event->images ?? [] as $img) {
            if (Storage::disk('public')->exists($img)) Storage::disk('public')->delete($img);
        }
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted.');
    }

    private function validateRequest(Request $request, ?Event $event = null): array
    {
        return $request->validate([
            'title'           => ['required', 'string', 'max:255'],
            'description'     => ['nullable', 'string'],
            'location'        => ['nullable', 'string', 'max:255'],
            'event_date'      => ['nullable', 'date'],
            'event_time'      => ['nullable', 'string', 'max:50'],
            'total_capacity'  => ['nullable', 'integer', 'min:0'],
            'available_seats' => ['nullable', 'integer', 'min:0'],
            'status'          => ['required', 'in:active,inactive'],
            'sort_order'      => ['nullable', 'integer', 'min:0'],
        ]);
    }

    private function handleImages(Request $request, array $existing): array
    {
        $keep = $request->input('keep_images', $existing);
        $images = is_array($keep) ? array_values($keep) : [];

        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $file) {
                $path = $file->store('events', 'public');
                $images[] = $path;
            }
        }
        return $images;
    }

    private function uniqueSlug(string $title): string
    {
        $slug = Str::slug($title);
        $count = Event::where('slug', 'like', $slug . '%')->count();
        return $count ? $slug . '-' . ($count + 1) : $slug;
    }
}
