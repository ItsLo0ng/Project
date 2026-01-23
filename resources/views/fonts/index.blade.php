@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Font Library</h1>
        <a href="{{ route('fonts.create') }}" class="btn btn-primary mb-3">Share New Font</a>

        @foreach ($fonts as $font)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $font->font_name }} by {{ $font->designer }}</h1>
                    <p class="card-text">{{ $font->description }}</p>
                    <p class="card-text"><small class="text-muted">Category: {{ $font->category->category_name }} | Uploaded by {{ $font->user->username }} on {{ $font->date_added->format('M d, Y') }}</small></p>
                    <a href="{{ route('fonts.show', $font) }}" class="btn btn-info">View Details</a>
                </div>
            </div>
        @endforeach

        {{ $fonts->links() }}
    </div>
@endsection