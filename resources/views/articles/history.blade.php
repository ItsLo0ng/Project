@extends('layouts.app')

@section('content')
<section class="py-24 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 fade-in">
        <h1 class="text-5xl font-bold text-gray-800 mb-6">
            History of Calligraphy
        </h1>

        <p class="text-xl text-gray-600 mb-10">
            A journey through time, culture, and the art of beautiful writing.
        </p>

        <article class="prose prose-lg max-w-none">
            <p>
                Calligraphy originated as a practical form of writing, but over time it evolved
                into a respected art form. Ancient Chinese calligraphy dates back over 3,000 years,
                while Roman inscriptions shaped Western letterforms.
            </p>

            <h2>Eastern Calligraphy</h2>
            <p>
                In China and Japan, calligraphy emphasizes brush movement, ink flow,
                and the spiritual connection between the artist and the stroke.
            </p>

            <h2>Western Calligraphy</h2>
            <p>
                Western calligraphy evolved through Roman capitals, medieval manuscripts,
                and Renaissance scripts, influencing modern typography.
            </p>

            <blockquote>
                “Calligraphy is the most intimate, personal, spontaneous form of expression.”
            </blockquote>
        </article>
    </div>
</section>
@endsection
