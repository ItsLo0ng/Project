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

    $fonts = Font::with('category', 'user', 'images', 'files', 'feedbacks')
        ->when($request->query('search'), function ($query, $search) {
            $query->where('name', 'like', "%{$search}%");
        })
        ->when($sort === 'name_asc', fn($q) => $q->orderBy('name', 'asc'))
        ->when($sort === 'name_desc', fn($q) => $q->orderBy('name', 'desc'))
        ->when($sort === 'date_asc', fn($q) => $q->orderBy('date_added', 'asc'))
        ->when($sort === 'date_desc', fn($q) => $q->orderBy('date_added', 'desc'))
        ->when($sort === 'rating_desc', fn($q) => $q->withAvg('feedbacks', 'rating')->orderByDesc('feedbacks_avg_rating'))
        ->paginate(12);

        // $fonts = $query->paginate(12);

        return view('search', compact('fonts', 'sort'));
    }
}
