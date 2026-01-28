@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900">Edit Font: {{ $font->name }}</h1>
            <p class="mt-4 text-lg text-gray-600">Update details, add new images/files, or delete existing ones</p>
        </div>

        <!-- Messages -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-8">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-8">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('fonts.update', $font) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Font Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Font Name *</label>
                <input name="name" value="{{ old('name', $font->name) }}" required
                    class="w-full p-3 rounded-xl border focus:ring-2 focus:ring-indigo-500">
                @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                <select name="category_id" required class="w-full p-3 rounded-xl border focus:ring-2 focus:ring-indigo-500">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $font->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- <!-- Designer -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Designer (optional)</label>
                <input name="designer" value="{{ old('designer', $font->designer) }}"
                    class="w-full p-3 rounded-xl border focus:ring-2 focus:ring-indigo-500">
            </div> --}}

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description (optional)</label>
                <textarea name="description" rows="5"
                        class="w-full p-3 rounded-xl border focus:ring-2 focus:ring-indigo-500">{{ old('description', $font->description) }}</textarea>
            </div>

            <!-- Existing Images -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Current Images</label>
                @if($font->images->isNotEmpty())
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                        @foreach($font->images as $image)
                            <div class="relative group">
                                <img src="{{ Storage::url($image->image_url) }}" 
                                    class="rounded-lg shadow object-contain h-32 w-full bg-gray-100"
                                    alt="Font image">
                                <button type="button" onclick="deleteImage({{ $font->id }}, {{ $image->id }})"
                                        class="absolute top-2 right-2 bg-red-600 text-white px-2 py-1 rounded-full text-xs opacity-0 group-hover:opacity-100 transition">
                                    Delete
                                </button>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">No images uploaded yet</p>
                @endif
            </div>

            <!-- Upload New Images -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Add More Images</label>
                <input type="file" name="images[]" multiple accept="image/*"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition">
                @error('images.*') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Existing Files (similar to images) -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Current Files</label>
                @if($font->files->isNotEmpty())
                    <ul class="list-disc ml-6 text-indigo-600 space-y-2">
                        @foreach($font->files as $file)
                            <li class="flex items-center justify-between">
                                <a href="{{ Storage::url($file->file_url) }}" target="_blank" class="hover:underline">
                                    {{ strtoupper($file->file_format) }} File
                                </a>
                                <button type="button" onclick="deleteFile({{ $font->id }}, {{ $file->id }})"
                                        class="text-red-600 hover:text-red-800 text-sm">
                                    Delete
                                </button>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">No files uploaded yet</p>
                @endif
            </div>

            <!-- Upload New Files -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Add More Font Files</label>
                <input type="file" name="files[]" multiple accept=".ttf,.otf,.woff,.woff2"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition">
                @error('files.*') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Submit -->
            <div class="pt-6">
                <button type="submit"
                        class="w-full bg-indigo-600 text-white py-4 rounded-xl font-semibold text-lg hover:bg-indigo-700 transition">
                    Save Changes
                </button>
            </div>
            <div class="pt-6">
                <button type="submit"
                        class="w-full bg-indigo-600 text-white py-4 rounded-xl font-semibold text-lg hover:bg-indigo-700 transition">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
@endsection

<script>
function deleteImage(fontId, imageId) {
    if (!confirm('Delete this image? This cannot be undone.')) return;

    const url = `/fonts/${fontId}/images/${imageId}`;

    fetch(url, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
        },
    })
    .then(response => {
        if (response.ok) {
            alert('Image deleted successfully!');
            location.reload(); // refresh to update UI
        } else {
            response.text().then(text => {
                alert('Failed to delete image: ' + (text || response.statusText));
            });
        }
    })
    .catch(error => {
        console.error('Fetch error:', error);
        alert('Error deleting image: ' + error.message);
    });
}

function deleteFile(fontId, fileId) {
    if (!confirm('Delete this file? This cannot be undone.')) return;

    const url = `/fonts/${fontId}/files/${fileId}`;

    fetch(url, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
        },
    })
    .then(response => {
        if (response.ok) {
            alert('File deleted successfully!');
            location.reload();
        } else {
            response.text().then(text => {
                alert('Failed to delete file: ' + (text || response.statusText));
            });
        }
    })
    .catch(error => {
        console.error('Fetch error:', error);
        alert('Error deleting file: ' + error.message);
    });
}
</script>