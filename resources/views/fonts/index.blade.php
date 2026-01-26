@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">
        All Fonts
    </h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($fonts as $font)
            <div class="border rounded-xl p-4 hover:shadow transition">
                
                {{-- Font name --}}
                <h2 class="text-lg font-semibold mb-2">
                    {{ $font->name }}
                </h2>

                {{-- Font preview --}}
                <p 
                    class="text-xl mb-4"
                    style="font-family: '{{ $font->name }}';"
                >
                    {{ $font->preview_text ?? 'The quick brown fox' }}
                </p>

                {{-- Optional category --}}
                @if($font->category)
                    <span class="text-sm text-gray-500">
                        {{ $font->category->name }}
                    </span>
                @endif

                {{-- View / Download --}}
                <div class="mt-4">
                    <a href="#"
                       class="text-indigo-600 hover:underline text-sm">
                        View font →
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Pagination (if used) --}}
    <div class="mt-8">
        {{ $fonts->links() }}
    </div>
</div>
@endsection
