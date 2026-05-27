<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::active()->ordered()->get();
        return view('website.events.index', compact('events'));
    }

    public function show(Event $event)
    {
        abort_if($event->status !== 'active', 404);
        return view('website.events.show', compact('event'));
    }
}
