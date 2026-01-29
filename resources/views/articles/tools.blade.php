@extends('layouts.app')

@section('content')
<section class="py-24 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 fade-in">

        {{-- Header --}}
        <header class="mb-16 text-center">
            <h1 class="text-5xl font-bold text-gray-900 mb-6 leading-tight">
                Calligraphy Tools & Materials
            </h1>

            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                The essential tools that shape every stroke, texture, and style
                in the art of calligraphy.
            </p>
        </header>

        {{-- Article --}}
        <article class="prose prose-lg max-w-none prose-gray">

            <p>
                Calligraphy is not only defined by skill and practice, but also by the
                tools in the artist’s hands. Each instrument influences line quality,
                rhythm, pressure, and expression.
            </p>

            <p>
                From ancient brushes to modern digital styluses, the evolution of
                calligraphy tools reflects both tradition and innovation.
            </p>

            {{-- Traditional --}}
            <h2>Traditional Calligraphy Tools</h2>

            <h3>Dip Pens & Nibs</h3>
            <p>
                Dip pens with interchangeable metal nibs are fundamental to Western
                calligraphy. They allow dramatic contrast between thick downstrokes
                and delicate hairlines.
            </p>

            <p>
                Different nib shapes create different styles — from sharp pointed
                nibs used in Copperplate to broad-edge nibs used in Gothic scripts.
            </p>

            {{-- Image --}}
            <div class="my-12">
                <div class="w-full h-80 bg-gray-200 rounded-2xl flex items-center justify-center text-gray-500">
                    Image: Dip pens and metal nibs
                </div>
            </div>

            <h3>Brushes</h3>
            <p>
                Brushes are central to East Asian calligraphy. Made from animal hair
                and bamboo handles, they respond fluidly to pressure, speed, and angle.
            </p>

            <p>
                A single brushstroke can vary from bold to delicate, capturing movement
                and emotion in one continuous motion.
            </p>

            {{-- Image --}}
            <div class="my-12">
                <div class="w-full h-80 bg-gray-200 rounded-2xl flex items-center justify-center text-gray-500">
                    Image: Traditional calligraphy brushes
                </div>
            </div>

            <h3>Ink</h3>
            <p>
                Ink consistency affects flow, texture, and color depth.
                Traditional ink sticks are ground with water, allowing artists
                to control density and tone.
            </p>

            <p>
                Modern bottled inks offer convenience, waterproof qualities,
                and a wide range of colors.
            </p>

            <h3>Paper</h3>
            <p>
                Paper plays a critical role in the final appearance of calligraphy.
                Smooth papers prevent ink bleeding, while textured papers add
                organic character.
            </p>

            <p>
                Handmade and rice papers are often favored for expressive or
                traditional works.
            </p>

            {{-- Modern --}}
            <h2>Modern & Contemporary Tools</h2>

            <h3>Brush Pens</h3>
            <p>
                Brush pens combine the flexibility of traditional brushes with
                the convenience of pens. They are popular in modern calligraphy
                and hand lettering.
            </p>

            <p>
                Their accessibility makes them ideal for beginners while still
                offering expressive potential for advanced artists.
            </p>

            {{-- Image --}}
            <div class="my-12">
                <div class="w-full h-80 bg-gray-200 rounded-2xl flex items-center justify-center text-gray-500">
                    Image: Modern brush pens
                </div>
            </div>

            {{-- Digital --}}
            <h2>Digital Calligraphy Tools</h2>

            <h3>Tablets & Stylus</h3>
            <p>
                Digital calligraphy has expanded creative possibilities.
                Tablets and pressure-sensitive styluses allow artists to experiment
                without physical limitations.
            </p>

            <p>
                Digital tools are widely used in font creation, branding,
                and contemporary design workflows.
            </p>

            {{-- Image --}}
            <div class="my-12">
                <div class="w-full h-80 bg-gray-200 rounded-2xl flex items-center justify-center text-gray-500">
                    Image: Digital calligraphy on tablet
                </div>
            </div>

            <blockquote>
                “The right tool does not replace skill — it reveals it.”
            </blockquote>

        </article>
    </div>
</section>
@endsection
