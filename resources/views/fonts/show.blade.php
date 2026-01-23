@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $font->font_name }}</h1>
        <p>Designer: {{ $font->designer }}</p>
        <p>Category: {{ $font->category->category_name }}</p>
        <p>Date Added: {{ $font->date_added->format('M d, Y') }}</p>
        <p>{{ $font->description }}</p>
        <p>Average Rating: {{ number_format($averageRating, 1) }}/5</p>

        <h3>Images</h3>
        @foreach ($font->images as $image)
            <img src="{{ Storage::url($image->image_url) }}" alt="Preview" class="img-fluid mb-2" style="max-width: 300px;">
        @endforeach

        <h3>Download Files</h3
        @foreach ($font->files as $file)
            <a href="{{ Storage::url($file->file_url) }}" class="btn btn-download mb-2">{{ $file->file_format }} File</a>
        @endforeach

        <h3>Feedback</h3>
        @foreach ($font->feedbacks as $feedback)
            <div class="card mb-2">
                <div class="card-body">
                    <p>Rating: {{ $feedback->rating }}/5</p>
                    <p>{{ $feedback->comment }}</p>
                    <p><small>By {{ $feedback->user->username }} on {{ $feedback->feedback_date->format('M d, Y') }}</small></p>
                </div>
            </div>
        @endforeach

        <h4>Give Feedback</h4>
        <form method="POST" action="{{ route('fonts.feedback', $font) }}">
            @csrf
            <div class="form-group">
                <label for="rating">Rating (1-5)</label>
                <select id="rating" name="rating" class="form-control" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea id="comment" name="comment" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection