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

        <!-- === MAIN EDIT FORM === -->
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden mb-12">
            <div class="px-8 py-10">
                <form method="POST" action="{{ route('fonts.update', $font) }}" enctype="multipart/form-data" class="space-y-8">
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



                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description (optional)</label>
                        <textarea name="description" rows="5"
                                class="w-full p-3 rounded-xl border focus:ring-2 focus:ring-indigo-500">{{ old('description', $font->description) }}</textarea>
                    </div>

                    <!-- Upload New Images -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Add More Images</label>
                        <input type="file" name="images[]" multiple accept="image/*"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition">
                        @error('images.*') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
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
                                class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white py-4 rounded-xl font-semibold text-lg hover:from-indigo-600 hover:to-purple-700 transition-all duration-300 shadow-md hover:shadow-lg">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- === MANAGE EXISTING SECTION (OUTSIDE FORM) === -->
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
            <div class="px-8 py-10">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Manage Existing Images & Files</h2>

                <!-- Current Images -->
                <div class="mb-10">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Current Images</h3>
                    @if($font->images->isNotEmpty())
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            @foreach($font->images as $image)
                                <div class="relative rounded-lg overflow-hidden shadow-md group ">
                                    <img src="{{ Storage::url($image->image_url) }}" 
                                         class="w-full h-40 object-contain bg-gray-50"
                                         alt="Font image">
                                    <form action="{{ route('public.fonts.images.destroy', ['font' => $font->id, 'image' => $image->id]) }}" method="POST" class="absolute top-2 right-2">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Delete this image? This cannot be undone.')"
                                                class="bg-red-600 text-white px-2 py-1 rounded-full text-xs opacity-0 group-hover:opacity-100 transition">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 italic">No images uploaded yet</p>
                    @endif
                </div>

                <!-- Current Files -->
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Current Files</h3>
                    @if($font->files->isNotEmpty())
                        <ul class="space-y-3">
                            @foreach($font->files as $file)
                                <li class="flex items-center justify-between bg-gray-50 p-4 rounded-lg">
                                    <a href="{{ Storage::url($file->file_url) }}" target="_blank" class="text-indigo-600 hover:underline font-medium">
                                        {{ strtoupper($file->file_format) }} File
                                    </a>
                                    <form action="{{ route('public.fonts.files.destroy', ['font' => $font->id, 'file' => $file->id]) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Delete this file? This cannot be undone.')"
                                                class="text-red-600 hover:text-red-800 font-medium">
                                            Delete
                                        </button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500 italic">No files uploaded yet</p>
                    @endif
                </div>
            </div>
        </div>
        <br>
        <center>
            <a href="{{ route('dashboard') }}"
            class="text-indigo-600 hover:text-indigo-800 font-medium text-lg">
                Save your changes yet? Back to Dashboard→
            </a>
        </center>
    </div>
@endsection