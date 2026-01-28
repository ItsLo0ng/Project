<?php

namespace App\Http\Controllers;
use App\Models\Font;
use App\Models\FontImage;
use App\Models\UserFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\FontCategory;
use App\Models\FontFile;

class FontController extends Controller
{
    public function dashboard(Request $request)
    {
        $query = Font::where('user_id', Auth::id())
            ->with('images', 'feedbacks');

        // Search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Sort
        if ($request->sort === 'rating') {
            $query->withAvg('feedbacks', 'rating')
                  ->orderByDesc('feedbacks_avg_rating');
        } else {
            $query->latest();
        }

        $fonts = $query->paginate(10);

        return view('dashboard', compact('fonts'));
    }

    public function index()
    {
        $fonts = Font::with('category', 'user', 'images', 'files', 'feedbacks')
                     ->latest()
                     ->paginate(15); // 15 fonts per page
        return view('fonts.index', compact('fonts'));


    }

    public function show(Font $font)
    {
        $font->load('images', 'files', 'feedbacks.user');
        $averageRating = $font->feedbacks->avg('rating');
        return view('detail', compact('font', 'averageRating'));
        $font->load([
            'images',
            'files',
            'category',
            'feedbacks.user'
        ]);

        $averageRating = $font->feedbacks->avg('rating');

        return view('detail', compact('font', 'averageRating'));
    }

    public function create()
    {
        $categories = FontCategory::orderBy('name')->get();
        return view('fonts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'category_id' => 'required|exists:font_categories,id',
            'designer' => 'nullable|string|max:160',
            'description' => 'nullable|string',
            'date_added' => 'required|date',
            'images.*' => 'image|max:2048', // 2MB per image
            'files.*' => 'file|mimes:ttf,otf,woff,woff2|max:5120', // 5MB per file
        ]);

        $validated['user_id'] = Auth::id();

        $font = Font::create($validated);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('font_images', 'public');
                FontImage::create([
                    'font_id' => $font->id,
                    'image_url' => $path,
                    'image_type' => $image->getMimeType(),
                ]);
            }
        }

        // Handle file uploads
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('font_files', 'public');
                FontFile::create([
                    'font_id' => $font->id,
                    'file_url' => $path,
                    'file_format' => $file->extension(),
                ]);
            }
        }

        return redirect()->route('fonts.show', $font)->with('success', 'Font shared successfully!');
    }

    public function storeFeedback(Request $request, Font $font)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['font_id'] = $font->id;
        $validated['feedback_date'] = now();

        UserFeedback::create($validated);

        return back()->with('success', 'Feedback submitted!');
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        UserFeedback::create([
            'user_id' => Auth::id(),
            'font_id' => $font->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'feedback_date' => now(),
        ]);

        return back()->with('success', 'Thank you for your feedback!');
    }

        public function edit(Font $font)
    {
        abort_if($font->user_id !== Auth::id(), 403);
        $font->load('images', 'files');
        $categories = FontCategory::orderBy('name')->get();
        return view('userboard.edit', compact('font', 'categories'));
    }

    public function update(Request $request, Font $font)
    {
        abort_if($font->user_id !== Auth::id(), 403);

        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'category_id' => 'required|exists:font_categories,id',
            'designer' => 'nullable|string|max:160',
            'description' => 'nullable|string',
            'images.*' => 'image|max:2048',
            'files.*' => 'file|mimes:ttf,otf,woff,woff2|max:5120',
        ]);

        $font->update($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                FontImage::create([
                    'font_id' => $font->id,
                    'image_url' => $image->store('font_images', 'public'),
                ]);
            }
        }

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                FontFile::create([
                    'font_id' => $font->id,
                    'file_url' => $file->store('font_files', 'public'),
                    'file_format' => $file->extension(),
                ]);
            }
        }

        return redirect()->route('dashboard')->with('success', 'Font updated!');
    }
        public function destroy(Font $font)
    {
        abort_if($font->user_id !== Auth::id(), 403);

        foreach ($font->images as $image) {
            Storage::disk('public')->delete($image->image_url);
        }

        foreach ($font->files as $file) {
            Storage::disk('public')->delete($file->file_url);
        }

        $font->delete();

        return back()->with('success', 'Font deleted!');
    }
}