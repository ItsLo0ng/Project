<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FontController; 
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AllFontController;
use App\Http\Controllers\Dashboard\MyFontController;


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
    Route::get('/dashboard', [MyFontController::class, 'index'])
        ->name('dashboard');
    Route::get('/fonts', [MyFontController::class, 'index'])
        ->name('userboard.index');

    Route::get('/fonts/create', [MyFontController::class, 'create'])
        ->name('userboard.create');

    Route::post('/fonts', [MyFontController::class, 'store'])
        ->name('userboard.store');

    Route::get('/fonts/{font}/edit', [MyFontController::class, 'edit'])
        ->name('userboard.edit');

    Route::put('/fonts/{font}', [MyFontController::class, 'update'])
        ->name('userboard.update');

    Route::delete('/fonts/{font}', [MyFontController::class, 'destroy'])
        ->name('userboard.destroy');
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/fonts', [FontController::class, 'index'])->name('fonts.index');
Route::get('/fonts/{font}', [FontController::class, 'show'])->name('fonts.show');

//login only route
//conflict with dashboard 
Route::middleware('auth')->group(function () {
    // Route::get('/fonts/create', [FontController::class, 'create'])->name('fonts.create');
    //Route::post('/fonts', [FontController::class, 'store'])->name('fonts.store');
    Route::post('/fonts/{font}/feedback', [FontController::class, 'storeFeedback'])->name('fonts.feedback');
});





Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');





Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');





Route::get('/search', [AllFontController::class, 'search'])
    ->name('fonts.search');



Route::view('/articles/history', 'articles.history')->name('articles.history');
Route::view('/articles/styles', 'articles.styles')->name('articles.styles');
Route::view('/articles/tools', 'articles.tools')->name('articles.tools');
