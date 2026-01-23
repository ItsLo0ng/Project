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
    public function dashboard()
    {
        $userFonts = Font::where('user_id', Auth::id())->latest()->paginate(10);
        return view('dashboard', compact('userFonts'));
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
        return view('fonts.show', compact('font', 'averageRating'));
    }

    public function create()
    {
        $categories = FontCategory::orderBy('category_name')->get();
        return view('fonts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'font_name' => 'required|string|max:200',
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
    }
}