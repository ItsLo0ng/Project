
@section('content')
<x-app-layout>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-800">My Fonts</h1>

            <a href="{{ route('fonts.create') }}"
               class="px-6 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700">
                Upload New Font
            </a>

        </div>
        <br>
        <div>
            @if (auth()->user()->role === 'admin')
                <a href="/admin"
                class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700">
                    Go to Admin Panel
                </a>
            @endif
        </div>
        @include('userboard.index')
                <br>
                <center>
                <a href="{{ route('dashboard') }}"
                   class="text-indigo-600 hover:text-indigo-800 font-medium text-lg">
                    Back to Dashboard→
                </a>
                </center>
        
    </div>

</div>
@endsection
</x-app-layout>