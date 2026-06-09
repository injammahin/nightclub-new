<?php

namespace App\Http\Controllers;

use App\Models\ReservationSubmission;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        return view('pages.reservations');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'selected_package' => ['nullable', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
            'request_type' => ['required', 'string', 'max:255'],
            'guests' => ['required', 'string', 'max:255'],
            'message' => ['nullable', 'string', 'max:5000'],
        ]);

        ReservationSubmission::create($data);

        return redirect()
            ->route('reservations')
            ->with('reservation_success', 'Thank you. Your reservation request has been submitted. For fastest confirmation, call 1 (786) 564-7828.');
    }
}