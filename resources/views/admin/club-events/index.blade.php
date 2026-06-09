@extends('admin.layouts.app')

@php
    use App\Models\ClubEvent;
@endphp

@section('title', 'Manage Events')
@section('page_title', 'Manage Events')

@section('content')
    <div class="space-y-6">
        <div class="rounded-3xl bg-white p-5 sm:p-7 shadow-sm border border-slate-200">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="text-xl font-black text-slate-950">Events</h3>
                    <p class="text-sm text-slate-500 mt-1">Create, edit, pause, publish or delete event sections.</p>
                </div>

                <a href="{{ route('admin.events.create') }}"
                    class="inline-flex justify-center rounded-2xl bg-red-600 px-6 py-3 text-sm font-black uppercase tracking-wider text-white hover:bg-red-700">
                    Add New Event
                </a>
            </div>
        </div>

        <div class="grid gap-5">
            @forelse($events as $event)
                <div class="rounded-3xl bg-white p-5 shadow-sm border border-slate-200">
                    <div class="grid gap-5 lg:grid-cols-[220px_1fr_auto] lg:items-center">
                        <div class="overflow-hidden rounded-2xl bg-slate-100 border border-slate-200">
                            @if($event->image)
                                <img src="{{ ClubEvent::mediaUrl($event->image) }}" alt="{{ $event->title }}"
                                    class="h-40 w-full object-cover">
                            @else
                                <div class="h-40 w-full grid place-items-center text-slate-400 text-sm">
                                    No Image
                                </div>
                            @endif
                        </div>

                        <div>
                            <div class="flex flex-wrap items-center gap-2">
                                <span
                                    class="rounded-full px-3 py-1 text-xs font-black
                                        {{ $event->is_active ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-600' }}">
                                    {{ $event->is_active ? 'Published' : 'Paused' }}
                                </span>

                                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-600">
                                    Sort: {{ $event->sort_order }}
                                </span>
                            </div>

                            <p class="mt-3 text-xs uppercase tracking-widest text-red-600 font-black">
                                {{ $event->eyebrow }}
                            </p>

                            <h3 class="mt-2 text-2xl font-black text-slate-950">
                                {{ $event->title }}
                            </h3>

                            <p class="mt-2 text-sm leading-6 text-slate-500 line-clamp-2">
                                {{ $event->description }}
                            </p>
                        </div>

                        <div class="flex flex-wrap lg:flex-col gap-2">
                            <a href="{{ route('admin.events.edit', $event) }}"
                                class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-bold text-slate-700 hover:bg-slate-50 text-center">
                                Edit
                            </a>

                            <form method="POST" action="{{ route('admin.events.toggle', $event) }}">
                                @csrf
                                <button type="submit"
                                    class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm font-bold text-slate-700 hover:bg-slate-50">
                                    {{ $event->is_active ? 'Pause' : 'Publish' }}
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.events.destroy', $event) }}"
                                onsubmit="return confirm('Are you sure you want to delete this event?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="w-full rounded-xl bg-red-50 px-4 py-2 text-sm font-bold text-red-700 hover:bg-red-100">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="rounded-3xl bg-white p-8 text-center shadow-sm border border-slate-200">
                    <h3 class="text-xl font-black text-slate-950">No events found</h3>
                    <p class="mt-2 text-slate-500">Create your first event section.</p>
                </div>
            @endforelse
        </div>

        <div>
            {{ $events->links() }}
        </div>
    </div>
@endsection