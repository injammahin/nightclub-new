<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClubEvent;
use App\Models\HomepageSetting;
use App\Models\ReservationSubmission;

class DashboardController extends Controller
{
    public function index()
    {
        $home = HomepageSetting::current();

        $reservationStats = [
            'total' => ReservationSubmission::count(),
            'new' => ReservationSubmission::where('status', 'new')->count(),
            'contacted' => ReservationSubmission::where('status', 'contacted')->count(),
            'confirmed' => ReservationSubmission::where('status', 'confirmed')->count(),
            'cancelled' => ReservationSubmission::where('status', 'cancelled')->count(),
        ];

        $eventStats = [
            'total' => ClubEvent::count(),
            'active' => ClubEvent::where('is_active', true)->count(),
            'paused' => ClubEvent::where('is_active', false)->count(),
        ];

        $recentReservations = ReservationSubmission::latest()
            ->take(6)
            ->get();

        $recentEvents = ClubEvent::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'home',
            'reservationStats',
            'eventStats',
            'recentReservations',
            'recentEvents'
        ));
    }
}