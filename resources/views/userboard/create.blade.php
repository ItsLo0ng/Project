@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-12">
    <h1 class="text-3xl font-bold mb-6">Upload New Font</h1>

    <form method="POST" action="{{ route('fonts.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <input name="font_name" placeholder="Font name" class="w-full p-3 rounded-xl border">

        <select name="category_id" class="w-full p-3 rounded-xl border">
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
            @endforeach
        </select>

        <input name="designer" placeholder="Designer (optional)" class="w-full p-3 rounded-xl border">

        <textarea name="description" rows="4" placeholder="Description"
            class="w-full p-3 rounded-xl border"></textarea>

        <input type="date" name="date_added" class="w-full p-3 rounded-xl border">

        <input type="file" name="images[]" multiple class="w-full">

        <input type="file" name="files[]" multiple class="w-full">

        <button class="px-6 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700">
            Upload Font
        </button>
    </form>
</div>
@endsection
