@extends('admin.layouts.app')

@section('title', 'Create Event')
@section('page_title', 'Create Event')

@section('content')
    <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data" class="space-y-8">
        @csrf

        @include('admin.club-events._form')
    </form>
@endsection