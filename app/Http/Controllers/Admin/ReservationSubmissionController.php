<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReservationSubmission;
use Illuminate\Http\Request;

class ReservationSubmissionController extends Controller
{
    public function index()
    {
        $reservations = ReservationSubmission::latest()
            ->paginate(15);

        $newCount = ReservationSubmission::where('status', 'new')->count();
        $contactedCount = ReservationSubmission::where('status', 'contacted')->count();
        $confirmedCount = ReservationSubmission::where('status', 'confirmed')->count();

        return view('admin.reservations.index', compact(
            'reservations',
            'newCount',
            'contactedCount',
            'confirmedCount'
        ));
    }

    public function show(ReservationSubmission $reservation)
    {
        if (!$reservation->read_at) {
            $reservation->update([
                'read_at' => now(),
            ]);
        }

        return view('admin.reservations.show', compact('reservation'));
    }

    public function updateStatus(Request $request, ReservationSubmission $reservation)
    {
        $data = $request->validate([
            'status' => ['required', 'in:new,contacted,confirmed,cancelled'],
        ]);

        $reservation->update([
            'status' => $data['status'],
        ]);

        return redirect()
            ->route('admin.reservations.show', $reservation)
            ->with('success', 'Reservation status updated successfully.');
    }

    public function destroy(ReservationSubmission $reservation)
    {
        $reservation->delete();

        return redirect()
            ->route('admin.reservations.index')
            ->with('success', 'Reservation request deleted successfully.');
    }
}