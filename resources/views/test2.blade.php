@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-12">
        <h1 class="text-4xl font-bold text-center text-indigo-700">
            This is a TEST page
        </h1>
        <p class="text-xl text-center mt-6">
            If you see this text with nice styling → the layout is working!
        </p>
        <p class="text-center mt-4 text-gray-600">
            Current time: {{ now()->format('Y-m-d H:i:s') }}
        </p>
    </div>
@endsection