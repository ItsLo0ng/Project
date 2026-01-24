@extends('layouts.app')

@section('content')
    
    <!-- Hero / Banner -->
    <section class="relative bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 text-white py-32 overflow-hidden fade-in">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_70%,rgba(255,255,255,0.2)_0%,transparent_50%)]"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6 animate-pulse-slow">
                Font Share
            </h1>
            <p class="text-xl md:text-3xl font-light mb-10 max-w-4xl mx-auto">
                Discover, share, and get feedback on beautiful custom fonts from creators worldwide
            </p>
            {{-- <div class="flex flex-col sm:flex-row justify-center gap-6">
                <a href="{{ route('fonts.index') ?? '/fonts' }}"
                   class="bg-white text-indigo-700 px-10 py-5 rounded-xl font-bold text-xl shadow-lg hover:bg-indigo-50 hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    Browse Fonts
                </a>
                @auth
                    <a href="{{ route('fonts.create') ?? '/fonts/create' }}"
                       class="bg-transparent border-2 border-white text-white px-10 py-5 rounded-xl font-bold text-xl hover:bg-white hover:text-indigo-700 transform hover:-translate-y-1 transition-all duration-300">
                        Upload Your Font
                    </a>
                @else
                    <a href="{{ route('register') }}"
                       class="bg-transparent border-2 border-white text-white px-10 py-5 rounded-xl font-bold text-xl hover:bg-white hover:text-indigo-700 transform hover:-translate-y-1 transition-all duration-300">
                        Join & Start Sharing
                    </a>
                @endauth
            </div> --}}
        </div>
    </section>

    <!-- Featured section (placeholder - we'll replace with real data later) -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-16 text-gray-800 fade-in">
                Featured & Popular Fonts
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                <!-- Example font card -->
                <div class="bg-gray-50 rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 fade-in">
                    <div class="h-64 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                        <span class="text-gray-500 text-2xl font-medium">Font Preview</span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Elegant Roman Serif</h3>
                        <p class="text-gray-600 mb-4">Perfect for books, magazines, and editorial design</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">By Designer X</span>
                            <span class="text-indigo-600 font-medium">View →</span>
                        </div>
                    </div>
                </div>

                <!-- Repeat 3 more times for demo -->
                <div class="bg-gray-50 rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 fade-in">
                    <div class="h-64 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                        <span class="text-gray-500 text-2xl font-medium">Font Preview</span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Modern Chinese Brush</h3>
                        <p class="text-gray-600 mb-4">Traditional yet contemporary calligraphy style</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">By Artist Y</span>
                            <span class="text-indigo-600 font-medium">View →</span>
                        </div>
                    </div>
                </div>

                <!-- Add 2 more similar cards -->
            </div>

            {{-- <div class="text-center mt-12">
                <a href="{{ route('fonts.index') ?? '/fonts' }}"
                   class="text-indigo-600 hover:text-indigo-800 font-medium text-lg">
                    See All Fonts →
                </a>
            </div> --}}
        </div>
    </section>
@endsection