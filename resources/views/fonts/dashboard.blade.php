@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>My Dashboard</h1>
        <a href="{{ route('fonts.create') }}" class="btn btn-primary mb-3">Share New Font</a>

        <h2>My Fonts</h2>
        @if ($userFonts->isEmpty())
            <p>You haven't shared any fonts yet.</p>
        @else
            @foreach ($userFonts as $font)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $font->font_name }}</h5>
                        <p class="card-text">{{ $font->description }}</p>
                        <a href="{{ route('fonts.show', $font) }}" class="btn btn-info">View</a>
                    </div>
                </div>
            @endforeach
            {{ $userFonts->links() }}
        @endif
    </div>
@endsection