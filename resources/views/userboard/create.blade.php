@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900">Upload Your Font</h1>
            <p class="mt-4 text-lg text-gray-600">
                Share your creation with the community — add images, files, and details
            </p>
        </div>

        <!-- Success / Error Messages -->
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

        <!-- Form Card -->
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
            <div class="px-8 py-10">
                <form method="POST" action="{{ route('fonts.store') }}" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <!-- Font Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Font Name *</label>
                        <input type="text" name="name" id="name" required
                               value="{{ old('name') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                               placeholder="e.g. Elegant Serif 2025">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                        <select name="category_id" id="category_id" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                            <option value="">Select a category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- <!-- Designer -->
                    <div>
                        <label for="designer" class="block text-sm font-medium text-gray-700 mb-2">Designer / Author (optional)</label>
                        <input type="text" name="designer" id="designer" value="{{ old('designer') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                               placeholder="Your name or pseudonym">
                    </div> --}}

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description (optional)</label>
                        <textarea name="description" id="description" rows="5"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                  placeholder="Tell us about your font...">{{ old('description') }}</textarea>
                    </div>

                    {{-- <!-- Date Added -->
                    <div>
                        <label for="date_added" class="block text-sm font-medium text-gray-700 mb-2">Date Added *</label>
                        <input type="date" name="date_added" id="date_added" required
                               value="{{ old('date_added', now()->format('Y-m-d')) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        @error('date_added')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div> --}}

                    <!-- Images -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Images (previews, specimens)</label>
                        <input type="file" name="images[]" multiple accept="image/*"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition">
                        <p class="mt-1 text-sm text-gray-500">JPEG, PNG, GIF, WebP (max 2MB each)</p>
                        @error('images.*')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Files -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Font Files (.ttf, .otf, .woff, .woff2)</label>
                        <input type="file" name="files[]" multiple accept=".ttf,.otf,.woff,.woff2"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition">
                        <p class="mt-1 text-sm text-gray-500">Max 5MB per file</p>
                        @error('files.*')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <div class="pt-6">
                        <button type="submit"
                                class="w-full bg-indigo-600 text-white py-4 rounded-xl font-semibold text-lg hover:bg-indigo-700 transition">
                            Upload Font
                        </button>
                    </div>
                </form>
                <br>
                <center>
                    <a href="{{ route('dashboard') }}"
                    class="text-indigo-600 hover:text-indigo-800 font-medium text-lg">
                        Back to Dashboard→
                    </a>
                </center>
            </div>
        </div>
    </div>
@endsection