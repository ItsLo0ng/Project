@extends('layouts.app')

@section('content')
<section class="py-24 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4">

        {{-- Header --}}
        <header class="mb-16 text-center">
            <h1 class="text-5xl font-bold text-gray-900 mb-6 leading-tight">
                Calligraphy Styles
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                An exploration of the most influential calligraphy styles across cultures,
                tools, and historical periods.
            </p>
        </header>

        {{-- Article --}}
        <article class="prose prose-lg max-w-none prose-gray">

            {{-- Intro --}}
            <p>
                Calligraphy styles are shaped by more than aesthetics. They reflect the writing
                tools available, the materials used, and the cultural values of their time.
                Each style carries a unique rhythm and emotional character.
            </p>

            <p>
                While some scripts emphasize precision and structure, others celebrate freedom,
                motion, and personal expression.
            </p>

            {{-- Western --}}
            <h2>Western Calligraphy Styles</h2>

            <h3>Roman Capitals</h3>
            <p>
                Roman Capitals are the foundation of Western letterforms. Originally carved
                into stone monuments, they emphasize symmetry, proportion, and timeless clarity.
                Many modern typefaces still follow these classical principles.
            </p>

            {{-- Image --}}
            <div class="my-12">
                <div class="w-full h-80 bg-gray-200 rounded-2xl flex items-center justify-center text-gray-500">
                    Image: Roman capital inscriptions
                </div>
            </div>

            <h3>Gothic (Blackletter)</h3>
            <p>
                Gothic calligraphy emerged during the medieval period and is characterized
                by dense, angular strokes and dramatic contrast. Its strong vertical rhythm
                gave manuscripts a solemn and authoritative presence.
            </p>

            <p>
                Though difficult to read for modern audiences, Blackletter remains iconic
                in historical documents and ceremonial design.
            </p>

            {{-- Image --}}
            <div class="my-12">
                <div class="w-full h-80 bg-gray-200 rounded-2xl flex items-center justify-center text-gray-500">
                    Image: Medieval blackletter manuscript
                </div>
            </div>

            <h3>Italic Script</h3>
            <p>
                Developed during the Renaissance, Italic script introduced speed and elegance
                to Western writing. Its slanted forms and flowing strokes made it ideal for
                correspondence and personal writing.
            </p>

            <p>
                Italic remains popular today for both formal documents and artistic lettering.
            </p>

            {{-- Eastern --}}
            <h2>Eastern Calligraphy Styles</h2>

            <h3>Chinese Brush Calligraphy</h3>
            <p>
                Chinese calligraphy is deeply intertwined with philosophy, meditation, and
                personal discipline. Each brushstroke is a balance of pressure, speed,
                and direction, revealing the artist’s inner state.
            </p>

            <blockquote>
                In Chinese calligraphy, writing is a mirror of the soul.
            </blockquote>

            {{-- Image --}}
            <div class="my-12">
                <div class="w-full h-80 bg-gray-200 rounded-2xl flex items-center justify-center text-gray-500">
                    Image: Traditional Chinese brush calligraphy
                </div>
            </div>

            <h3>Japanese Shodō</h3>
            <p>
                Shodō, the Japanese art of calligraphy, values simplicity, balance,
                and expressive movement. Empty space is as meaningful as inked strokes,
                allowing each character to breathe.
            </p>

            <p>
                Shodō is often practiced as a form of mindfulness, where focus and calm
                are essential to the final result.
            </p>

            {{-- Modern --}}
            <h2>Modern Calligraphy</h2>

            <p>
                Modern calligraphy breaks away from strict historical rules, blending
                traditional forms with experimentation. Artists freely vary letter size,
                spacing, and stroke weight.
            </p>

            <p>
                Today, modern calligraphy is widely used in branding, wedding design,
                social media, and digital font creation.
            </p>

            {{-- Image --}}
            <div class="my-12">
                <div class="w-full h-80 bg-gray-200 rounded-2xl flex items-center justify-center text-gray-500">
                    Image: Contemporary modern calligraphy
                </div>
            </div>

            <blockquote>
                “Every calligraphy style is a dialogue between discipline and freedom.”
            </blockquote>

        </article>
    </div>
</section>
@endsection
