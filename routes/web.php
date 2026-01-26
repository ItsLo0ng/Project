<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FontController; 
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('welcome');
})->name('welcome');

Route::get('/about', function () {
    return view('about');
})->name('about');





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';




Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [FontController::class, 'dashboard'])->name('dashboard');
    Route::get('/fonts', [FontController::class, 'index'])->name('fonts.index');
    Route::get('/fonts/{font}', [FontController::class, 'show'])->name('fonts.show');
    Route::get('/fonts/create', [FontController::class, 'create'])->name('fonts.create');
    Route::post('/fonts', [FontController::class, 'store'])->name('fonts.store');
    Route::post('/fonts/{font}/feedback', [FontController::class, 'storeFeedback'])->name('fonts.feedback');
});

// use App\Http\Controllers\HomeController;

// Route::get('/', [HomeController::class, 'index'])->name('home');




Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');





Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');