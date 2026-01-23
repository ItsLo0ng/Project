@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Share New Font</h1>
        <form method="POST" action="{{ route('fonts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="font_name">Font Name</label>
                <input type="text" id="font_name" name="font_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select id="category_id" name="category_id" class="form-control" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="designer">Designer</label>
                <input type="text" id="designer" name="designer" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="date_added">Date Added</label>
                <input type="date" id="date_added" name="date_added" class="form-control" required value="{{ now()->format('Y-m-d') }}">
            </div>
            <div class="form-group">
                <label for="images">Images (previews, specimens)</label>
                <input type="file" id="images" name="images[]" multiple class="form-control-file">
            </div>
            <div class="form-group">
                <label for="files">Font Files (ttf, otf, woff, etc.)</label>
                <input type="file" id="files" name="files[]" multiple class="form-control-file">
            </div>
            <button type="submit" class="btn btn-primary">Share Font</button>
        </form>
    </div>
@endsection