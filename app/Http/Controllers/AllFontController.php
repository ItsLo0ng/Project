<?php

namespace App\Http\Controllers;
use App\Models\Font;
use Illuminate\Http\Request;

class AllFontController extends Controller
{
    public function search(Request $request)
    {
        $query = Font::query()->with(['images', 'feedbacks', 'category']);

        // Search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Sort
        $sort = $request->get('sort', 'name_asc');

        match ($sort) {
            'name_desc' => $query->orderBy('name', 'desc'),
            'date_asc'  => $query->orderBy('created_at', 'asc'),
            'date_desc' => $query->orderBy('created_at', 'desc'),
            default     => $query->orderBy('name', 'asc'),
        };

        $fonts = $query->paginate(12);

        return view('search', compact('fonts', 'sort'));
    }
}
