<nav class="bg-white shadow-lg" x-data="{ activeItem: '' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <img class="h-8 w-auto" src="{{ asset('images/logo.png') }}" alt="Font Share Logo">
                </div>
                <!-- Menu items -->
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="/" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-indigo-700 hover:border-indigo-300 focus:outline-none focus:text-indigo-700 focus:border-indigo-300 transition duration-150 ease-in-out fade-in" 
                       :class="{ 'text-indigo-700 border-indigo-500': activeItem === 'home' }" 
                       @click="activeItem = 'home'">Home</a>

                    <!-- Dropdown for categories -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-indigo-700 hover:border-indigo-300 focus:outline-none focus:text-indigo-700 focus:border-indigo-300 transition duration-150 ease-in-out fade-in">
                            Categories
                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg fade-in">
                            <div class="py-1 rounded-md bg-white shadow-xs">
                                <a href="/fonts?category=roman" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-100">Roman</a>
                                <a href="/fonts?category=chinese" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-100">Chinese</a>
                                <!-- Add more categories -->
                                <a href="/fonts?category=sans-serif" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-100">Sans Serif</a>
                                <a href="/fonts?category=serif" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-100">Serif</a>
                            </div>
                        </div>
                    </div>
                    
                    <a href="/dashboard" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-indigo-700 hover:border-indigo-300 focus:outline-none focus:text-indigo-700 focus:border-indigo-300 transition duration-150 ease-in-out fade-in" 
                       :class="{ 'text-indigo-700 border-indigo-500': activeItem === 'dashboard' }" 
                       @click="activeItem = 'dashboard'">Dashboard</a>

                </div>
            </div>
            <!-- Visitor count -->
            <div class="flex items-center">
                <span class="text-sm text-gray-500">Visitors: {{ Cache::get('visitor_count', 0) }}</span>
            </div>
        </div>
    </div>
</nav>