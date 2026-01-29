@extends('layouts.app')

@section('content')
<section class="py-24 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4">

        {{-- Header --}}
        <header class="mb-16 text-center">
            <h1 class="text-5xl font-bold text-gray-900 mb-6 leading-tight">
                The History of Calligraphy
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                A timeless journey through culture, craftsmanship, and the human desire
                to give beauty to written language.
            </p>
        </header>

        {{-- Article --}}
        <article class="prose prose-lg max-w-none prose-gray">

            {{-- Introduction --}}
            <p>
                Calligraphy is more than decorative writing. It is a visual language shaped by
                culture, tools, materials, and philosophy. Across civilizations, people have
                transformed simple marks into expressions of identity, belief, and artistry.
            </p>

            <p>
                From ancient stone inscriptions to flowing brush strokes and illuminated manuscripts,
                calligraphy reflects how societies viewed knowledge, spirituality, and aesthetics.
            </p>

            {{-- Image placeholder --}}
            <div class="my-12">
                <div class="w-full h-80 bg-gray-200 rounded-2xl flex items-center justify-center text-gray-500">
                    <img src="{{ asset('images/logo.png') }}" alt="Scratchy Nib Logo" class="h-80 w-auto object-contain">
                </div>
                <p class="text-sm text-gray-500 text-center mt-2">
                    Early calligraphic forms across civilizations
                </p>
            </div>

            {{-- Eastern --}}
            <h2><b>Eastern Calligraphy</b></h2>

            <p>
                Eastern calligraphy, particularly in China, Japan, and Korea, is deeply connected
                to philosophy and spirituality. Writing is seen as a reflection of the writer’s
                inner state rather than mere legibility.
            </p>

            <p>
                Chinese calligraphy dates back over 3,000 years and uses brush, ink, paper, and inkstone
                — known as the “Four Treasures of the Study.” Each stroke carries rhythm, balance,
                and controlled energy.
            </p>

            <blockquote>
                In East Asia, calligraphy is not just written — it is performed.
            </blockquote>

            {{-- Image placeholder --}}
            <div class="my-12">
                <div class="w-full h-80 bg-gray-200 rounded-2xl flex items-center justify-center text-gray-500">
                    <img src="{{ asset('images/logo.png') }}" alt="Scratchy Nib Logo" class="h-80 w-auto object-contain">
                </div>
            </div>

            {{-- Western --}}
            <h2><b>Western Calligraphy</b></h2>

            <p>
                Western calligraphy evolved from Roman capitals carved in stone to handwritten
                manuscripts produced by medieval monks. These scripts laid the foundation
                for modern alphabets and typography.
            </p>

            <p>
                During the Middle Ages, illuminated manuscripts combined calligraphy,
@endsection