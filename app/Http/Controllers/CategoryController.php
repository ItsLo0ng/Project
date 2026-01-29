<?php

namespace App\Http\Controllers;

use App\Models\FontCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function show(FontCategory $category, Request $request): View
    {
        $sort = $request->get('sort', 'name_asc');

        $fonts = $category->fonts()
            ->with('user', 'feedbacks', 'images')  // eager load what you need
            ->when($request->query('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->when($sort === 'name_asc', fn($q) => $q->orderBy('name', 'asc'))
            ->when($sort === 'name_desc', fn($q) => $q->orderBy('name', 'desc'))
            ->when($sort === 'date_asc', fn($q) => $q->orderBy('date_added', 'asc'))
            ->when($sort === 'date_desc', fn($q) => $q->orderBy('date_added', 'desc'))
            ->when($sort === 'rating_desc', fn($q) => $q->withAvg('feedbacks', 'rating')->orderByDesc('feedbacks_avg_rating'))
            ->paginate(12);

        return view('categories', compact('category', 'fonts', 'sort'));
    }
}