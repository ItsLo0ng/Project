@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-12">
        <h1 class="text-4xl font-bold text-center mb-8">Welcome to Font Share</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($featuredFonts as $font)
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-xl font-semibold">{{ $font->font_name }}</h2>
                    <p class="text-gray-600">{{ Str::limit($font->description, 100) }}</p>
                    <a href="{{ route('fonts.show', $font) }}" class="mt-4 inline-block text-indigo-600 hover:underline">
                        View Font →
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection