@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">My Fonts</h2>

    <a href="{{ route('fonts.create') }}"
       class="px-5 py-2 bg-indigo-600 text-white rounded-lg">
        Upload Font
    </a>
</div>

@if($fonts->count())
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($fonts as $font)
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-xl font-semibold">{{ $font->name }}</h3>

                {{-- Image slider --}}
                @if($font->images->count())
                    <div class="flex gap-2 mt-3 overflow-x-auto">
                        @foreach($font->images as $img)
                            <img src="{{ asset('storage/'.$img->image_url) }}"
                                 class="h-32 rounded">
                        @endforeach
                    </div>
                @endif

                {{-- Rating --}}
                <p class="mt-3 text-sm text-gray-600">
                    ⭐ {{ number_format($font->feedbacks->avg('rating'), 1) ?? 'No ratings' }}
                </p>

                {{-- Actions --}}
                <div class="flex gap-3 mt-4">
                    <a href="{{ route('fonts.edit', $font) }}"
                       class="text-indigo-600">Edit</a>

                    <form method="POST"
                          action="{{ route('fonts.destroy', $font) }}">
                        @csrf @method('DELETE')
                        <button class="text-red-600">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p class="text-gray-600">You haven’t uploaded any fonts yet.</p>
@endif
@endsection