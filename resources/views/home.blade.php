@extends('layouts.app')

@section('content')
    <x-navbar />

    <x-banner />

    <div class="container mx-auto py-8">
        <h2 class="text-2xl font-bold mb-4">Featured Fonts</h2>
        <!-- Add font list here (from controller) -->
        {{-- @foreach ($fonts as $font)
            <div class="card mb-4 fade-in">
                <h3>{{ $font->font_name }}</h3>
                <p>{{ $font->description }}</p>
                <!-- ... more font details -->
            </div>
        @endforeach --}}
    </div>

    <x-ticker />

    <x-footer />
@endsection