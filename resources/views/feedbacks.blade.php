@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900">
                All Feedbacks for {{ $font->name }}
            </h1>
            <p class="mt-4 text-lg text-gray-600">
                See what the community thinks • {{ $feedbacks->total() }} feedback{{ $feedbacks->total() !== 1 ? 's' : '' }}
            </p>
        </div>

        <!-- Feedback List -->
        <div class="space-y-6">
            @forelse ($feedbacks as $feedback)
                <div class="bg-white rounded-xl shadow p-6">
                    <div class="flex items-center justify-between mb-3">
                        <!-- Username + Rating -->
                        <div class="flex items-center gap-3">
                            <span class="font-medium text-gray-800">
                                {{ $feedback->user->name ?? $feedback->user->username ?? 'Anonymous' }}
                            </span>
                            <span class="text-yellow-500 text-xl">
                                {{ str_repeat('★', $feedback->rating) }}
                                {{ str_repeat('☆', 5 - $feedback->rating) }}
                            </span>
                        </div>

                        <!-- Date -->
                        <span class="text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($feedback->feedback_date)->diffForHumans() }}
                        </span>
                    </div>

                    <!-- Comment -->
                    <p class="text-gray-700 leading-relaxed">
                        {{ $feedback->comment }}
                    </p>
                </div>
            @empty
                <p class="text-center text-gray-600 py-12">
                    No feedback yet.
                </p>
            @endforelse
        </div>



        <!-- Back link -->
        <div class="text-center mt-10">
            <a href="{{ route('fonts.show', $font) }}" 
               class="inline-block px-8 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition">
                ← Back to the details page
            </a>
        </div>
    </div>
</div>
@endsection