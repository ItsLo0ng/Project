@extends('layouts.app')

@section('content')
{{-- <x-app-layout> --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <h1 class="text-3xl font-bold mb-8 text-gray-800">
                My Fonts
            </h1>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if($fonts->isEmpty())
                <p class="text-gray-600">
                    You haven’t uploaded any fonts yet.
                </p>
            @else
                <div class="overflow-x-auto bg-white rounded-xl shadow">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Name</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Created</th>
                                <th class="px-6 py-3 text-right text-sm font-semibold">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            @foreach($fonts as $font)
                                <tr>
                                    <td class="px-6 py-4 font-medium">
                                        {{ $font->name }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $font->created_at->format('d M Y') }}
                                    </td>

                                    <td class="px-6 py-4 text-right space-x-3">
                                        <a href="{{ route('userboard.edit', $font) }}"
                                           class="text-indigo-600 hover:underline">
                                            Edit
                                        </a>

                                        <form method="POST"
                                              action="{{ route('userboard.destroy', $font) }}"
                                              class="inline-block"
                                              onsubmit="return confirm('Delete this font?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600 hover:underline">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
{{-- </x-app-layout> --}}
@endsection