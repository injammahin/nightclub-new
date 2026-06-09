@extends('admin.layouts.app')

@section('title', 'Reservation Requests')
@section('page_title', 'Reservation Requests')

@section('content')
    <div class="space-y-6">
        <div class="grid gap-5 md:grid-cols-3">
            <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
                <p class="text-sm text-slate-500">New Requests</p>
                <h3 class="mt-3 text-3xl font-black text-slate-950">{{ $newCount }}</h3>
            </div>

            <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
                <p class="text-sm text-slate-500">Contacted</p>
                <h3 class="mt-3 text-3xl font-black text-slate-950">{{ $contactedCount }}</h3>
            </div>

            <div class="rounded-3xl bg-gradient-to-br from-[#08030a] to-red-950 p-6 shadow-sm text-white">
                <p class="text-sm text-white/60">Confirmed</p>
                <h3 class="mt-3 text-3xl font-black">{{ $confirmedCount }}</h3>
            </div>
        </div>

        <div class="rounded-3xl bg-white p-5 sm:p-7 shadow-sm border border-slate-200">
            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="text-xl font-black text-slate-950">Submitted Reservation Forms</h3>
                    <p class="text-sm text-slate-500 mt-1">All reservation requests submitted from the website.</p>
                </div>
            </div>

            <div class="mt-6 overflow-x-auto">
                <table class="w-full min-w-[900px] text-left">
                    <thead>
                        <tr class="border-b border-slate-200 text-xs uppercase tracking-widest text-slate-400">
                            <th class="py-4 pr-4">Guest</th>
                            <th class="py-4 pr-4">Request</th>
                            <th class="py-4 pr-4">Date</th>
                            <th class="py-4 pr-4">Guests</th>
                            <th class="py-4 pr-4">Status</th>
                            <th class="py-4 pr-4 text-right">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse ($reservations as $reservation)
                            <tr>
                                <td class="py-4 pr-4">
                                    <div>
                                        <p class="font-black text-slate-950">
                                            {{ $reservation->name }}
                                        </p>
                                        <p class="text-sm text-slate-500">
                                            {{ $reservation->email }}
                                        </p>
                                        <p class="text-sm text-slate-500">
                                            {{ $reservation->phone }}
                                        </p>
                                    </div>
                                </td>

                                <td class="py-4 pr-4">
                                    <p class="font-bold text-slate-800">
                                        {{ $reservation->request_type }}
                                    </p>
                                    <p class="text-sm text-slate-500">
                                        {{ $reservation->selected_package }}
                                    </p>
                                </td>

                                <td class="py-4 pr-4 text-sm text-slate-600">
                                    {{ optional($reservation->event_date)->format('M d, Y') }}
                                </td>

                                <td class="py-4 pr-4 text-sm text-slate-600">
                                    {{ $reservation->guests }}
                                </td>

                                <td class="py-4 pr-4">
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-black
                                            @if($reservation->status === 'new') bg-red-100 text-red-700
                                            @elseif($reservation->status === 'contacted') bg-yellow-100 text-yellow-700
                                            @elseif($reservation->status === 'confirmed') bg-green-100 text-green-700
                                            @else bg-slate-100 text-slate-600
                                            @endif">
                                        {{ ucfirst($reservation->status) }}
                                    </span>
                                </td>

                                <td class="py-4 pr-4 text-right">
                                    <a href="{{ route('admin.reservations.show', $reservation) }}"
                                        class="inline-flex rounded-xl border border-slate-200 px-4 py-2 text-sm font-bold text-slate-700 hover:bg-slate-50">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-10 text-center text-slate-500">
                                    No reservation requests found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $reservations->links() }}
            </div>
        </div>
    </div>
@endsection