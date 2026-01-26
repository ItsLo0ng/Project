<div x-data="{ current: 0 }" class="relative overflow-hidden rounded-xl">
    <div class="flex transition-transform duration-500"
         :style="`transform: translateX(-${current * 100}%)`">

        @foreach ($images as $image)
            <img src="{{ Storage::url($image->image_url) }}"
                 class="w-full flex-shrink-0 object-cover h-56">
        @endforeach
    </div>

    <!-- Controls -->
    <button @click="current = Math.max(current - 1, 0)"
            class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/80 p-2 rounded-full">
        ‹
    </button>

    <button @click="current = Math.min(current + 1, {{ count($images) - 1 }})"
            class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/80 p-2 rounded-full">
        ›
    </button>
</div>
