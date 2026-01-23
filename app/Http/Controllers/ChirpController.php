<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Font;

class ChirpController extends Controller
{

    public function index()
    {
        // $fonts = Font::with('category', 'user', 'images', 'files', 'feedbacks')
        //             ->latest()
        //             ->paginate(10);
        // return view('welcome', compact('fonts')); // or 'home'
        return view('home');
    }
}
