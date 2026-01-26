@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">My Fonts</h1>
        <a href="{{ route('userboard.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded">
            Upload New Font
        </a>
    </div>

    @if($fonts->isEmpty())
        <p class="text-gray-500">You haven’t uploaded any fonts yet.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($fonts as $font)
                <div class="bg-white p-4 rounded shadow">

                    <h2 class="font-semibold text-lg">{{ $font->name }}</h2>

                    <p class="text-sm text-gray-500">
                        Rating: ⭐ {{ number_format($font->rating, 1) ?? 'N/A' }}
                    </p>

                    <div class="flex gap-3 mt-4">
                        <a href="{{ route('userboard.edit', $font) }}"
                           class="text-indigo-600 hover:underline">Edit</a>

                        <form method="POST"
                              action="{{ route('userboard.destroy', $font) }}">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">Delete</button>
                        </form>
                        <a href="{{ route('fonts.show', $font) }}" class="text-indigo-600 hover:underline">
                            View Details
                        </a>
                    </div>

                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
