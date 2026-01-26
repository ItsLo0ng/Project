<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Font;
use App\Models\FontImage;
use App\Models\UserFeedback;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\FontCategory;
use App\Models\FontFile;


class MyFontController extends Controller
{
    public function index(Request $request)
    {
        $fonts = Font::where('user_id', Auth::id())
            ->when($request->search, function ($q) use ($request) {
                $q->where('font_name', 'like', "%{$request->search}%");
            })
            ->orderBy(
                $request->get('sort', 'created_at'),
                $request->get('direction', 'desc')
            )
            ->paginate(10);

        return view('userboard.index', compact('fonts'));
    }

    public function store(Request $request)
    {
        $font = Font::create([
            'user_id' => Auth::id(),
            'font_name' => $request->font_name,
            'description' => $request->description,
            'date_added' => now(),
        ]);

        // Images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('fonts/images', 'public');

                $font->images()->create([
                    'image_url' => $path,
                    'image_type' => 'preview',
                ]);
            }
        }

        // Files
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('fonts/files', 'public');

                $font->files()->create([
                    'file_url' => $path,
                    'file_format' => $file->getClientOriginalExtension(),
                ]);
            }
        }

        return redirect()->route('dashboard')
            ->with('success', 'Font uploaded successfully!');
    }
    public function create()
    {
        return view('userboard.create');
    }
        public function edit(Font $font)
    {
        abort_if($font->user_id !== Auth::id(), 403);
        return view('userboard.edit', compact('font'));
    }

    public function update(Request $request, Font $font)
    {
        abort_if($font->user_id !== Auth::id(), 403);

        $font->update($request->only('name'));

        return redirect()->route('dashboard');
    }

    public function destroy(Font $font)
    {
        abort_if($font->user_id !== Auth::id(), 403);

        $font->delete();

        return back();
    }
}
