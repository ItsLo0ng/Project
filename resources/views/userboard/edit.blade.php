@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-12">
    <h1 class="text-3xl font-bold mb-8">Edit Font</h1>

    <form method="POST"
          action="{{ route('fonts.update', $font) }}"
          enctype="multipart/form-data"
          class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Font name -->
        <input name="name"
               value="{{ $font->name }}"
               class="w-full p-3 rounded-xl border">

        <!-- Category -->
        <select name="category_id" class="w-full p-3 rounded-xl border">
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}"
                    @selected($font->category_id == $cat->id)>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>

        <!-- Designer -->
        <input name="designer"
               value="{{ $font->designer }}"
               class="w-full p-3 rounded-xl border">

        <!-- Description -->
        <textarea name="description" rows="4"
          class="w-full p-3 rounded-xl border">{{ $font->description }}</textarea>

        <!-- Existing Images -->
        <div>
            <h3 class="font-semibold mb-2">Current Images</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($font->images as $image)
                    <img src="{{ Storage::url($image->image_url) }}"
                         class="rounded-lg shadow object-cover h-32 w-full">
                @endforeach
            </div>
        </div>

        <!-- Upload New Images -->
        <div>
            <label class="font-semibold block mb-1">Add More Images</label>
            <input type="file" name="images[]" multiple>
        </div>

        <!-- Existing Files -->
        <div>
            <h3 class="font-semibold mb-2">Font Files</h3>
            <ul class="list-disc ml-6 text-indigo-600">
                @foreach($font->files as $file)
                    <li>
                        <a href="{{ Storage::url($file->file_url) }}" target="_blank">
                            {{ strtoupper($file->file_format) }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Upload New Files -->
        <div>
            <label class="font-semibold block mb-1">Add Font Files</label>
            <input type="file" name="files[]" multiple>
        </div>

        <!-- Submit -->
        <button class="px-8 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700">
            Save Changes
        </button>
    </form>
</div>
@endsection
