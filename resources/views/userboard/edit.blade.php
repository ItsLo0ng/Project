@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10">

    <h1 class="text-2xl font-bold mb-6">Edit Font</h1>

    <form method="POST"
          action="{{ route('userboard.update', $font) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-medium">Font Name</label>
            <input type="text"
                   name="name"
                   value="{{ old('name', $font->name) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block font-medium">Replace Font File</label>
            <input type="file" name="font_file">
        </div>

        <div class="mb-4">
            <label class="block font-medium">Add Images</label>
            <input type="file" name="images[]" multiple>
        </div>

        <button class="bg-indigo-600 text-white px-4 py-2 rounded">
            Update Font
        </button>
    </form>

</div>
@endsection
