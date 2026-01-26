<?php

namespace App\Http\Controllers;

use App\Models\FontCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function show(FontCategory $category, Request $request): View
    {
        $sort = $request->get('sort', 'name_asc');  // Default sort by name ascending

        $fonts = $category->fonts()
            ->with('user', 'feedbacks')  // Eager load for efficiency
            ->when($request->query('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->when($sort === 'name_asc', function ($query) {
                $query->orderBy('name', 'asc');
            })
            ->when($sort === 'name_desc', function ($query) {
                $query->orderBy('name', 'desc');
            })
            ->paginate(12);  // 12 fonts per page, adjust as needed

        return view('categories', compact('category', 'fonts', 'sort'));
    }
}