<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChirpController;

// Route::get('/', function () {
//     return view('test');
// });

Route::get('/', [ChirpController::class, 'index']);