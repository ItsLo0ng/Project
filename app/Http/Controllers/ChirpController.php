<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChirpController extends Controller
{

    public function index()
    {
        // dd(config('backpack.ui.view_namespace'));

        return view('welcome');
    }
}
