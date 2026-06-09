@extends('admin.layouts.app')

@section('title', 'Reservation Details')
@section('page_title', 'Reservation Details')

@section('content')
    <div class="grid gap-6 lg:grid-cols-[1fr_360px]">
        <div class="rounded-3xl bg-white p-5 sm:p-7 shadow-sm border border-slate-200">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <p class="text-xs uppercase tracking-widest text-red-600 font-black">
                        {{ $reservation->request_type }}
                    </p>

                    <h3 class="mt-2 text-3xl font-black text-slate-950">
                        {{ $reservation->name }}
                    </h3>

                    <p class="mt-2 text-slate-500">
                        Submitted {{ $reservation->created_at->format('M d, Y h:i A') }}
                    </p>
                </div>

                <span class="inline-flex rounded-full px-3 py-1 text-xs font-black
                    @if($reservation->status === 'new') bg-red-100 text-red-700
                    @elseif($reservation->status === 'contacted') bg-yellow-100 text-yellow-700
                    @elseif($reservation->status === 'confirmed') bg-green-100 text-green-700
                    @else bg-slate-100 text-slate-600
                    @endif">
                    {{ ucfirst($reservation->status) }}
                </span>
            </div>

            <div class="mt-8 grid gap-5 md:grid-cols-2">
                <div class="rounded-2xl bg-slate-50 p-5 border border-slate-200">
                    <p class="text-xs uppercase tracking-widest text-slate-400 font-black">Email</p>
                    <p class="mt-2 font-bold text-slate-900">{{ $reservation->email }}</p>
                </div>

                <div class="rounded-2xl bg-slate-50 p-5 border border-slate-200">
                    <p class="text-xs uppercase tracking-widest text-slate-400 font-black">Phone</p>
                    <p class="mt-2 font-bold text-slate-900">{{ $reservation->phone }}</p>
                </div>

                <div class="rounded-2xl bg-slate-50 p-5 border border-slate-200">
                    <p class="text-xs uppercase tracking-widest text-slate-400 font-black">Event Date</p>
                    <p class="mt-2 font-bold text-slate-900">
                        {{ optional($reservation->event_date)->format('M d, Y') }}
                    </p>
                </div>

                <div class="rounded-2xl bg-slate-50 p-5 border border-slate-200">
                    <p class="text-xs uppercase tracking-widest text-slate-400 font-black">Guests</p>
                    <p class="mt-2 font-bold text-slate-900">{{ $reservation->guests }}</p>
                </div>

                <div class="rounded-2xl bg-slate-50 p-5 border border-slate-200 md:col-span-2">
                    <p class="text-xs uppercase tracking-widest text-slate-400 font-black">Selected Package</p>
                    <p class="mt-2 font-bold text-slate-900">{{ $reservation->selected_package }}</p>
                </div>

                <div class="rounded-2xl bg-slate-50 p-5 border border-slate-200 md:col-span-2">
                    <p class="text-xs uppercase tracking-widest text-slate-400 font-black">Message</p>
                    <p class="mt-3 text-slate-700 leading-7 whitespace-pre-line">
                        {{ $reservation->message ?: 'No message provided.' }}
                    </p>
                </div>
            </div>
        </div>

        <aside class="space-y-6">
            <div class="rounded-3xl bg-white p-5 shadow-sm border border-slate-200">
                <h3 class="text-xl font-black text-slate-950">Update Status</h3>

                <form method="POST" action="{{ route('admin.reservations.status', $reservation) }}" class="mt-5 space-y-4">
                    @csrf

                    <select name="status" class="admin-input">
                        <option value="new" {{ $reservation->status === 'new' ? 'selected' : '' }}>New</option>
                        <option value="contacted" {{ $reservation->status === 'contacted' ? 'selected' : '' }}>Contacted
                        </option>
                        <option value="confirmed" {{ $reservation->status === 'confirmed' ? 'selected' : '' }}>Confirmed
                        </option>
                        <option value="cancelled" {{ $reservation->status === 'cancelled' ? 'selected' : '' }}>Cancelled
                        </option>
                    </select>

                    <button type="submit"
                        class="w-full rounded-2xl bg-red-600 px-5 py-3 text-sm font-black uppercase tracking-wider text-white hover:bg-red-700">
                        Save Status
                    </button>
                </form>
            </div>

            <div class="rounded-3xl bg-white p-5 shadow-sm border border-slate-200">
                <h3 class="text-xl font-black text-slate-950">Quick Contact</h3>

                <div class="mt-5 grid gap-3">
                    <a href="tel:{{ $reservation->phone }}"
                        class="rounded-2xl border border-slate-200 px-5 py-3 text-center text-sm font-bold text-slate-700 hover:bg-slate-50">
                        Call Guest
                    </a>

                    <a href="mailto:{{ $reservation->email }}"
                        class="rounded-2xl border border-slate-200 px-5 py-3 text-center text-sm font-bold text-slate-700 hover:bg-slate-50">
                        Email Guest
                    </a>
                </div>
            </div>

            <div class="rounded-3xl bg-white p-5 shadow-sm border border-slate-200">
                <h3 class="text-xl font-black text-red-700">Delete Request</h3>

                <form method="POST" action="{{ route('admin.reservations.destroy', $reservation) }}" class="mt-5"
                    onsubmit="return confirm('Are you sure you want to delete this reservation request?')">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="w-full rounded-2xl bg-red-50 px-5 py-3 text-sm font-black uppercase tracking-wider text-red-700 hover:bg-red-100">
                        Delete
                    </button>
                </form>
            </div>
        </aside>
    </div>
@endsection