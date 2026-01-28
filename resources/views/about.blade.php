@extends('layouts.app')

@section('content')
    <!-- Hero Header -->
    <section class="relative bg-gradient-to-r from-indigo-600 to-blue-500 text-white py-32 text-center overflow-hidden fade-in">
        <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_50%_50%,rgba(255,255,255,0.3)_0%,transparent_80%)]"></div>
        <div class="relative z-10 max-w-5xl mx-auto px-4">
            <h1 class="text-5xl md:text-6xl font-extrabold mb-6 tracking-tight drop-shadow-md">
                About Font Share
            </h1>
            <p class="text-xl md:text-2xl max-w-3xl mx-auto mb-8">
                A community-driven platform for designers and creators to share, discover, and collaborate on custom fonts.
            </p>
            <a href="{{ route('fonts.search') }}" class="inline-block bg-white text-indigo-600 px-8 py-4 rounded-full font-semibold hover:bg-indigo-50 hover:shadow-lg transform hover:-translate-y-1 transition duration-300">
                Explore Fonts //currently wrong route
            </a>
            
        </div>
    </section>

    <!-- Mission Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 fade-in">
            <h2 class="text-4xl font-bold text-center mb-12 text-gray-800">
                Our Mission
            </h2>
            <div class="grid md:grid-cols-2 gap-12">
                <div class="p-8 bg-gray-50 rounded-xl shadow hover:shadow-xl transition duration-300">
                    <h3 class="text-2xl font-semibold mb-4 text-indigo-600">Empower Creators</h3>
                    <p class="text-gray-600">
                        We provide a free space for font designers to upload their work, get feedback from peers, and reach a global audience. Whether you're a hobbyist or professional, Font Share helps you share your passion.
                    </p>
                </div>
                <div class="p-8 bg-gray-50 rounded-xl shadow hover:shadow-xl transition duration-300">
                    <h3 class="text-2xl font-semibold mb-4 text-indigo-600">Foster Community</h3>
                    <p class="text-gray-600">
                        Users can rate, comment, and discuss fonts, creating a vibrant community. Our platform connects designers from all backgrounds to collaborate and inspire each other.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section (placeholders) -->
    <section class="py-20 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 fade-in">
            <h2 class="text-4xl font-bold text-center mb-12 text-gray-800">
                Meet the Team
            </h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Team member card -->
                <div class="bg-white rounded-xl shadow hover:shadow-xl transition duration-300 text-center p-6">
                    <img src="{{ asset('images/team-placeholder-1.jpg') }}" alt="Team Member 1" class="h-32 w-32 mx-auto rounded-full mb-4">
                    <h3 class="text-xl font-semibold mb-2 text-gray-800">John Doe</h3>
                    <p class="text-indigo-600 mb-4">Founder & Designer</p>
                    <p class="text-gray-600 text-sm">
                        Passionate about typography and community building.
                    </p>
                </div>

                <!-- Repeat for 3 more members -->
                <div class="bg-white rounded-xl shadow hover:shadow-xl transition duration-300 text-center p-6">
                    <img src="{{ asset('images/team-placeholder-2.jpg') }}" alt="Team Member 2" class="h-32 w-32 mx-auto rounded-full mb-4">
                    <h3 class="text-xl font-semibold mb-2 text-gray-800">Jane Smith</h3>
                    <p class="text-indigo-600 mb-4">Lead Developer</p>
                    <p class="text-gray-600 text-sm">
                        Building scalable platforms for creators.
                    </p>
                </div>

                <!-- Add 2 more similar cards -->
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 bg-indigo-600 text-white text-center fade-in">
        <div class="max-w-5xl mx-auto px-4">
            <h2 class="text-4xl font-bold mb-6">Join the Font Share Community</h2>
            <p class="text-xl mb-8">
                Sign up today to start sharing your fonts and connecting with designers.
            </p>
            <a href="{{ route('register') }}" class="inline-block bg-white text-indigo-600 px-8 py-4 rounded-full font-semibold hover:bg-indigo-50 transition duration-300">
                Get Started
            </a>
        </div>
    </section>
@endsection