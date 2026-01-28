@extends('layouts.app')

@section('content')
<section class="py-16 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Font Header -->
        <div class="mb-10 fade-in">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">
                {{ $font->name }}
            </h1>

            <div class="flex items-center gap-4 text-gray-600">
                <span>Category: {{ $font->category->name }}</span>
                <span>Designer: {{ $font->designer ?? 'Unknown' }}</span>
                <span>
                    Rating: {{ number_format($averageRating ?? 0, 1) }}/5⭐
                </span>
            </div>
        </div>

        <!-- Image Gallery -->
        <!-- Image Slider -->
        <!-- Images -->
        <div 
            x-data="{
                images: @js($font->images->pluck('image_url')),
                active: 0
            }"
            class="relative mb-14 fade-in"
        >

            <!-- Image Display -->
            <div class="relative h-[420px] bg-gray-200 rounded-2xl overflow-hidden shadow-lg">
                <template x-for="(image, index) in images" :key="index">
                    <img
                        x-show="active === index"
                        x-transition.opacity.duration.500ms
                        :src="'{{ Storage::url('') }}' + image"
                        alt="{{ $font->font_name }}"
                        class="absolute inset-0 w-full h-full object-cover"
                    >
                </template>

                <!-- Empty State -->
                <div 
                    x-show="images.length === 0"
                    class="flex items-center justify-center h-full text-gray-500 text-xl"
                >
                    No preview images available
                </div>

                <!-- Prev Button -->
                <button
                    @click="active = (active - 1 + images.length) % images.length"
                    x-show="images.length > 1"
                    class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 p-3 rounded-full shadow transition"
                >
                    ‹
                </button>

                <!-- Next Button -->
                <button
                    @click="active = (active + 1) % images.length"
                    x-show="images.length > 1"
                    class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 p-3 rounded-full shadow transition"
                >
                    ›
                </button>
            </div>

            <!-- Dots -->
            <div 
                x-show="images.length > 1"
                class="flex justify-center gap-2 mt-4"
            >
                <template x-for="(image, index) in images" :key="index">
                    <button
                        @click="active = index"
                        class="w-3 h-3 rounded-full transition"
                        :class="active === index ? 'bg-indigo-600' : 'bg-gray-300'"
                    ></button>
                </template>
            </div>

        </div>


        <!-- Description + Download -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 mb-16">

            <!-- Description -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow p-8">
                <h2 class="text-2xl font-semibold mb-4">
                    Description
                </h2>
                <p class="text-gray-700 leading-relaxed">
                    {{ $font->description }}
                </p>
            </div>

            <!-- Download Card -->
            <div class="bg-white rounded-2xl shadow p-8 flex flex-col justify-between">
                <div>
                    <h3 class="text-xl font-semibold mb-4">
                        Download
                    </h3>

                    @foreach ($font->files as $file)
                        <a
                            href="{{ Storage::url($file->file_url) }}"
                            download
                            class="block mb-3 bg-indigo-600 text-white text-center py-3 rounded-lg hover:bg-indigo-700 transition"
                        >
                            Download {{ strtoupper($file->file_format) }}
                        </a>
                    @endforeach
                </div>

                <p class="text-sm text-gray-500 mt-4">
                    For personal & educational use
                </p>
            </div>
        </div>

        <!-- Feedback Section -->
        <div class="bg-white rounded-2xl shadow p-10">
            <h2 class="text-2xl font-semibold mb-6">
                Rate and give us your feedback!
            </h2>

            <!-- Existing Feedback -->
            <div class="space-y-6 mb-10">
                @forelse ($font->feedbacks as $feedback)
                    <div class="border-b pb-4">
                        <div class="flex justify-between mb-1">
                            <span class="font-medium">
                                {{ $feedback->user->username }}
                            </span>
                            <span>
                                ⭐ {{ $feedback->rating }}/5
                            </span>
                        </div>
                        <p class="text-gray-600">
                            {{ $feedback->comment }}
                        </p>
                    </div>
                @empty
                    <p class="text-gray-500">
                        No feedback yet. Be the first!
                    </p>
                @endforelse
            </div>

            <!-- Feedback Form -->
            @auth
                <form method="POST" action="{{ route('fonts.feedback', $font) }}">
                    @csrf

                    <label class="block mb-2 font-medium">
                        Rating
                    </label>
                    <select
                        name="rating"
                        class="w-full mb-4 p-3 border rounded-lg"
                        required
                    >
                        @for ($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}">{{ $i }} ⭐</option>
                        @endfor
                    </select>

                    <label class="block mb-2 font-medium">
                        Comment
                    </label>
                    <textarea
                        name="comment"
                        rows="4"
                        class="w-full p-3 border rounded-lg mb-4"
                        placeholder="Share your thoughts..."
                    ></textarea>

                    <button
                        class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition"
                    >
                        Submit Feedback
                    </button>
                </form>
            @else
                <p class="text-gray-600">
                    You have to
                    <a href="{{ route('login') }}" class="text-indigo-600 underline">
                        Log in
                    </a>
                    to leave feedback.
                </p>
            @endauth
        </div>

    </div>
</section>
@endsection
