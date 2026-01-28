@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4">

    <h1 class="text-3xl font-bold mb-8">
        Edit Font: {{ $font->name }}
    </h1>

    {{-- Flash message --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- Edit form --}}
    <form method="POST"
          action="{{ route('fonts.update', $font) }}"
          enctype="multipart/form-data"
          class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Font name --}}
        <div>
            <label class="block font-semibold mb-1">Font Name</label>
            <input type="text"
                   name="name"
                   value="{{ old('name', $font->name) }}"
                   class="w-full border rounded-xl p-3">
        </div>

        {{-- Category --}}
        <div>
            <label class="block font-semibold mb-1">Category</label>
            <select name="category_id" class="w-full border rounded-xl p-3">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        @selected($font->category_id == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Description --}}
        <div>
            <label class="block font-semibold mb-1">Description</label>
            <textarea name="description"
                      rows="4"
                      class="w-full border rounded-xl p-3">{{ old('description', $font->description) }}</textarea>
        </div>



        {{-- Upload New Images --}}
        <div>
            <label class="block font-semibold mb-2">Add More Images</label>
            <input type="file"
                   name="images[]"
                   multiple
                   class="block">
        </div>

        {{-- Submit --}}
        <div class="pt-6">
            <button type="submit"
                    class="px-8 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700">
                Save Changes
            </button>
        </div>

    </form>
    <div>
        <h2 class="text-xl font-semibold mb-4">Current Images</h2>

        @if($font->images->count())
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($font->images as $image)
                    <div class="relative border rounded-xl overflow-hidden shadow">

                        <img src="{{ Storage::url($image->image_url) }}"
                                class="w-full h-40 object-cover">

                        {{-- Delete image --}}
                        <form method="POST"
                                action="{{ route('public.fonts.images.destroy', [$font, $image]) }}"
                                class="absolute top-2 right-2">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    onclick="return confirm('Delete this image?')"
                                    class="bg-red-600 text-white text-sm px-3 py-1 rounded-lg hover:bg-red-700">
                                Delete
                            </button>
                        </form>

                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No images uploaded yet.</p>
        @endif
    </div>
</div>
@endsection
