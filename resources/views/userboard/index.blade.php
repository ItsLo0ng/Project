@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 fade-in">
            <h1 class="text-3xl font-bold text-gray-900">My Fonts</h1>
            <a href="{{ route('fonts.create') }}"
               class="mt-4 sm:mt-0 px-6 py-3 bg-indigo-600 text-white rounded-xl font-medium hover:bg-indigo-700 transition">
                Upload New Font  
            </a>
        </div>
        <div>
            @if (auth()->user()->role === 'admin')
                <a href="/admin"
                class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700">
                    Go to Admin Panel
                </a>
            @endif
        </div>
        <br>
        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-8">
                {{ session('success') }}
            </div>
        @endif

        @if ($fonts->isEmpty())
            <div class="text-center py-16 bg-white rounded-2xl shadow">
                <p class="text-xl text-gray-600 mb-6">You haven’t uploaded any fonts yet.</p>
                <a href="{{ route('fonts.create') }}" class="inline-block px-8 py-4 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition">
                    Share Your First Font
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($fonts as $font)
                    <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 fade-in">
                        <!-- Preview -->
                        <div class="h-48 bg-gray-100 flex items-center justify-center">
                            @if ($font->images->first())
                                <img src="{{ Storage::url($font->images->first()->image_url) }}"
                                     alt="{{ $font->name }}"
                                     class="max-h-full max-w-full object-contain">
                            @else
                                <span class="text-gray-500 text-lg">No Preview</span>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $font->name }}</h3>
                            <p class="text-sm text-gray-600 mb-4">
                                Category: {{ $font->category->name ?? 'Uncategorized' }} • 
                                {{-- {{ $font->date_added->format('M, d, Y') }} --}}
                            </p>

                            <!-- Rating -->
                            <div class="flex items-center mb-4">
                                <span class="text-yellow-500 text-xl">★</span>
                                <span class="ml-1 text-gray-700 font-medium">
                                    {{ number_format($font->feedbacks->avg('rating') ?? 0, 1) }} / 5
                                </span>
                                <span class="ml-2 text-sm text-gray-500">
                                    ({{ $font->feedbacks->count() }} ratings)
                                </span>
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-4">
                                <a href="{{ route('fonts.edit', $font) }}"
                                   class="text-indigo-600 hover:text-indigo-800 font-medium hover:underline">Edit</a>

                                <form action="{{ route('fonts.destroy', $font) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete this font?')"
                                            class="text-red-600 hover:text-red-800 font-medium hover:underline">Delete</button>
                                </form>
                                <a href="{{ route('fonts.show', $font) }}" class="text-indigo-600 hover:text-indigo-800 font-medium hover:underline">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


        @endif
    </div>
@endsection