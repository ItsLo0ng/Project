@extends('layouts.app')

@section('content')
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12 fade-in">
                <h1 class="text-4xl font-bold text-gray-800 mb-2">
                    All Fonts
                </h1>
                <p class="text-xl text-gray-600">
                    Browse all fonts across all categories
                </p>
            </div>

            <!-- Search and Sort -->
            <form method="GET" class="flex flex-col md:flex-row justify-between mb-8 gap-4">
                <!-- Search Input -->
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Search fonts by name..." 
                       class="w-full md:w-1/2 p-3 rounded-lg border border-gray-300 focus:border-indigo-500 transition">

                <!-- Sort Dropdown -->
                <select name="sort" class="w-full md:w-auto p-3 rounded-lg border border-gray-300 focus:border-indigo-500 transition">
                    <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }}>Sort by Name (A-Z)</option>
                    <option value="name_desc" {{ request('sort') === 'name_desc' ? 'selected' : '' }}>Sort by Name (Z-A)</option>
                    <option value="date_asc" {{ request('sort') === 'date_asc' ? 'selected' : '' }}>Sort by Date (Oldest )</option>
                    <option value="date_desc" {{ request('sort') === 'date_desc' ? 'selected' : '' }}>Sort by Date (Newest)</option>
                    <option value="rating_desc" {{ request('sort') === 'rating_desc' ? 'selected' : '' }}>Sort by Rating</option>
                </select>

                <!-- Optional Submit Button (improves accessibility) -->
                <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition">
                    Apply
                </button>
            </form>
            <!-- Fonts Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($fonts as $font)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 fade-in">
                        <!-- Preview Image (use first image or placeholder) -->
                        <div class="h-48 bg-gray-200 flex items-center justify-center">
                            @if ($font->images->first())
                                <img src="{{ Storage::url($font->images->first()->image_url) }}" alt="{{ $font->font_name }}" class="object-cover w-full h-full">
                            @else
                                <span class="text-gray-500">No Preview</span>
                            @endif
                        </div>
                        <!-- Details -->
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $font->name }}</h3>
                            <span class="text-gray-600 mb-4">
                                Category: {{ $font->category->name ?? 'Uncategorized' }}
                            </span>
                            <p class="text-gray-600 mb-4">{{ Str::limit($font->description, 100) }}</p>
                            <div class="flex justify-between text-sm text-gray-500">
                                <span>Designer: {{ $font->designer ?? 'Unknown' }}</span>
                                <span>Avg Rating: {{ number_format($font->feedbacks->avg('rating'), 1) }}/5</span>
                            </div>
                            <a href="{{ route('fonts.show', $font) }}" class="mt-4 block text-indigo-600 font-medium hover:underline">
                                View Details →
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-600 col-span-full">No fonts found</p>
                @endforelse
            </div>


        </div>
    </div>
@endsection