@extends('layouts.app')

@section('content')
    
    <!-- Hero / Banner -->
    <section class="relative bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 text-white py-32 overflow-hidden fade-in">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_70%,rgba(255,255,255,0.2)_0%,transparent_50%)]"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6 animate-pulse-slow">
                Scratchy Nib
            </h1>
            <p class="text-xl md:text-3xl font-light mb-10 max-w-4xl mx-auto">
                Discover, share, and get feedback on beautiful custom calligraphy from creators worldwide
            </p>
        </div>
    </section>

    <!-- Introduction -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14 fade-in">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">
                    The Art of Calligraphy
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Where writing becomes art, and every stroke tells a story
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-gray-700">
                <div class="fade-in">
                    <h3 class="text-2xl font-semibold mb-3 text-indigo-600">
                        <center>
                            A Timeless Craft
                        </center>
                         
                    </h3>
                    <p class="leading-relaxed">
                        Calligraphy is the visual art of writing, practiced for thousands of years across cultures.
                        From ancient manuscripts to modern design, it blends precision, rhythm, and expression.
                    </p>
                </div>

                <div class="fade-in">
                    <h3 class="text-2xl font-semibold mb-3 text-indigo-600">
                        <center>
                            Many Styles, One Soul
                        </center>
                    </h3>
                    <p class="leading-relaxed">
                        Each culture shaped its own calligraphic voice — Roman serif, Gothic blackletter,
                        Chinese brush scripts, Arabic calligraphy, and modern experimental forms.
                    </p>
                </div>

                <div class="fade-in">
                    <h3 class="text-2xl font-semibold mb-3 text-indigo-600">
                        <center>
                            Calligraphy in the Digital Age
                        </center>
                    </h3>
                    <p class="leading-relaxed">
                        Today, calligraphy lives on through digital fonts, branding, tattoos, posters,
                        and creative projects — connecting tradition with modern expression.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured section-->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-16 text-gray-800 fade-in ">
                Articles about Caligraphy
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                <!-- Article Card -->
                <a href="{{ route('articles.history') }}"
                class="group bg-gray-50 rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 fade-in">

                    <div class="h-56 bg-gradient-to-br from-indigo-100 to-purple-200 flex items-center justify-center">
                        <span class="text-indigo-700 text-2xl font-semibold">
                            History
                        </span>
                    </div>

                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2 group-hover:text-indigo-600">
                            History of Calligraphy
                        </h3>
                        <p class="text-gray-600 mb-4">
                            Explore how calligraphy evolved across ancient civilizations and cultures.
                        </p>
                        <span class="text-indigo-600 font-medium">
                            Read article →
                        </span>
                    </div>
                </a>

                <!-- Styles -->
                <a href="{{ route('articles.styles') }}" 
                class="group bg-gray-50 rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 fade-in">
                    <div class="h-56 bg-gradient-to-br from-pink-100 to-red-200 flex items-center justify-center">
                        <span class="text-pink-700 text-2xl font-semibold">
                            Styles
                        </span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2 group-hover:text-indigo-600">
                            Calligraphy Styles
                        </h3>
                        <p class="text-gray-600 mb-4">
                            Discover Roman, Gothic, Brush, Script, and modern calligraphy styles.
                        </p>
                        <span class="text-indigo-600 font-medium">Read article →</span>
                    </div>
                </a>

                <!-- Tools -->
                <a href="{{ route('articles.tools') }}" 
                class="group bg-gray-50 rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 fade-in">
                    <div class="h-56 bg-gradient-to-br from-green-100 to-teal-200 flex items-center justify-center">
                        <span class="text-green-700 text-2xl font-semibold">
                            Tools
                        </span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2 group-hover:text-indigo-600">
                            Tools & Materials
                        </h3>
                        <p class="text-gray-600 mb-4">
                            Learn about traditional pens, nibs, brushes, ink, and digital tools for calligraphers.
                        </p>
                        <span class="text-indigo-600 font-medium">Read article →</span>
                    </div>
                </a>
            </div>

            <div class="text-center mt-12">
                <a href="/search"
                   class="text-indigo-600 hover:text-indigo-800 font-medium text-lg">
                    Search for Calligraphy →
                </a>
                <br>
                <br>
                <a href="{{ route('register') ?? '/register' }}"
                   class="text-indigo-600 hover:text-indigo-800 font-medium text-lg">
                    Want to share your own creations? Join us→
                </a>
            </div>
        </div>
    </section>
@endsection