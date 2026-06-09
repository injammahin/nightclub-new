<?php

namespace App\Http\Controllers;

use App\Models\ClubEvent;
use App\Models\EventPageSetting;

class EventPageController extends Controller
{
    public function index()
    {
        $eventPage = EventPageSetting::current();

        $events = ClubEvent::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        return view('pages.events', compact('eventPage', 'events'));
    }
}