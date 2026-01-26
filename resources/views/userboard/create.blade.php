@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-8">Upload New Font</h1>

        <form method="POST"
              action="{{ route('my-fonts.store') }}"
              enctype="multipart/form-data"
              class="bg-white p-8 rounded-2xl shadow space-y-6">
            @csrf

            <input type="text" name="font_name"
                   placeholder="Font name"
                   class="w-full rounded-xl border-gray-300" required>

            <textarea name="description"
                      placeholder="Description"
                      class="w-full rounded-xl border-gray-300"
                      rows="4"></textarea>

            <!-- Images -->
            <div>
                <label class="block font-semibold mb-2">Preview Images</label>
                <input type="file" name="images[]" multiple
                       class="w-full">
            </div>

            <!-- Font files -->
            <div>
                <label class="block font-semibold mb-2">Font Files</label>
                <input type="file" name="files[]" multiple
                       class="w-full">
            </div>

            <button class="px-6 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700">
                Save Font
            </button>
        </form>
    </div>
</div>
@endsection
