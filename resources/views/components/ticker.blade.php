<div class="fixed bottom-0 left-0 w-full bg-indigo-600 text-white text-center py-2 overflow-hidden">
    <div class="animate-marquee whitespace-nowrap">
        <span x-data x-init="$nextTick(() => $el.textContent = new Date().toLocaleString('en-US', { timeZone: 'Asia/Hanoi' }) + ' - Location: Hanoi, Hanoi, VN')">Loading date, time, and location...</span>
    </div>
</div>