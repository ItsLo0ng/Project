<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Scratchy Nib') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 min-h-screen flex flex-col">

    <!-- Navbar -->
    <header class="bg-white shadow-sm sticky top-0 z-50 fade-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Left: Logo + Username -->
                <div class="flex items-center space-x-4">
                    <a href="/" class="flex items-center space-x-2">
                        <img src="{{ asset('images/logo.png') }}" alt="Scratchy Nib Logo" class="h-12 w-auto object-contain">
                        <span class="text-xl font-bold text-indigo-700 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 bg-clip-text text-transparent tracking-wide">
                            Scratchy Nib

                        </span>
                    </a>
                </div>

                <!-- Right: Navigation + Auth Links -->
                <div class="flex items-center space-x-8">
                    <!-- Main menu (hidden on mobile) -->
                    <nav class="hidden md:flex space-x-8">
                        <a href="/" class="text-gray-700 hover:text-indigo-600 transition-colors duration-200">Home</a>
                        <a href="/search" class="text-gray-700 hover:text-indigo-600 transition-colors duration-200">Search</a>

                        <!-- Gallery dropdown -->
                        <div class="relative group">
                            <button class="text-gray-700 hover:text-indigo-600 transition-colors duration-200 flex items-center">
                                Gallery
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="absolute left-0 mt-2 w-max bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform scale-95 group-hover:scale-100">
                                <div class="py-1">
                                    <a href="/categories/2" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Traditional Calligraphy</a>
                                    <a href="/categories/3" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Contemporary Calligraphy</a>
                                    <a href="/categories/4" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Hand-lettering Design</a>
                                    <a href="/categories/5" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Modern Calligraphy</a>
                                    <a href="/categories/1" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Test</a>
                                </div>
                            </div>
                        </div>
                    </nav>

                    <!-- Right side: Visitor count + Auth -->
                    <div class="flex items-center space-x-6">

                        @guest
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-indigo-600 transition-colors">Log in</a>
                            <a href="{{ route('register') }}" class="text-sm font-medium text-white bg-indigo-600 px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors">Register</a>
                        @else
                            <a href="{{ route('dashboard') }}" class="text-sm font-medium text-white bg-indigo-600 px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors">Dashboard</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-sm font-medium text-gray-700 hover:text-red-600 transition-colors">Log out</button>
                            </form>
                        @endguest
                    </div>
                    @auth
                    <span class="
                        hidden md:block
                        text-sm
                        font-semibold
                        bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500
                        bg-clip-text text-transparent
                        tracking-wide
                    ">
                        Hi, {{ Auth::user()->name ?? 'User' }}
                    </span>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Main content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer (increased padding to avoid ticker overlap) -->
    <footer class="bg-gray-900 text-white py-12 fade-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; {{ date('Y') }} Scratchy Nib. All rights reserved.</p>
            <div class="mt-4 space-x-6">
                <a href="/about" class="hover:text-indigo-400 transition-colors font-medium">About us</a>
                <a href="/contact" class="hover:text-indigo-400 transition-colors font-medium">Contact us</a>
            </div>
        </div>
    </footer>

    <!-- Scrolling ticker (fixed at bottom) -->
    <div class="fixed bottom-0 left-0 right-0 bg-indigo-600 text-white text-sm py-2 overflow-hidden z-50">
        <div class="animate-marquee whitespace-nowrap">
            <span id="ticker">
                {{ now()->format('l, d F Y H:i:s') }} • Location: Hanoi, Vietnam • 
                Welcome to Scratchy Nib 
            </span>
        </div>
    </div>

    <script>
        // Live time update in ticker
        function updateTicker() {
            const now = new Date().toLocaleString('en-US', {
                timeZone: 'Asia/Ho_Chi_Minh',
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            });
            document.getElementById('ticker').textContent = 
                now + ' • Location: Hanoi, Vietnam • Welcome to Scratchy Nib ';
        }
        setInterval(updateTicker, 1000);
        updateTicker();
    </script>

    <style>
        .fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-marquee {
            animation: marquee 30s linear infinite;
        }
        @keyframes marquee {
            0%   { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }
    </style>

</body>
</html>