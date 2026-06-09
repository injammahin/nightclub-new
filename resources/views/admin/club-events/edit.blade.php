@extends('admin.layouts.app')

@section('title', 'Edit Event')
@section('page_title', 'Edit Event')

@section('content')
    <form method="POST" action="{{ route('admin.events.update', $event) }}" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        @include('admin.club-events._form')
    </form>
@endsection