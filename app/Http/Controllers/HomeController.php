<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // You can pass data to the view here if needed
        $featuredFonts = \App\Models\Font::latest()->take(6)->get();

        return view('home', compact('featuredFonts'));
    }
}