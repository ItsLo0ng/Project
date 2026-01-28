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



//userboard.route
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [FontController::class, 'dashboard'])->name('dashboard');

    Route::get('/fonts/create', [FontController::class, 'create'])->name('fonts.create');
    Route::post('/fonts', [FontController::class, 'store'])->name('fonts.store');

    Route::get('/fonts/{font}/edit', [FontController::class, 'edit'])->name('fonts.edit');
    Route::put('/fonts/{font}', [FontController::class, 'update'])->name('fonts.update');
    Route::delete('/fonts/{font}', [FontController::class, 'destroy'])->name('fonts.destroy');
    Route::post('/fonts/{font}/feedback', [FontController::class, 'storeFeedback'])->name('fonts.feedback');
});







//profile 
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
//font details page 
Route::get('/fonts/{font}', [FontController::class, 'show'])->name('fonts.show');


//contact page
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

//category search page
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

//search page
Route::get('/search', [AllFontController::class, 'search'])
    ->name('fonts.search');

//articles 
Route::view('/articles/history', 'articles.history')->name('articles.history');
Route::view('/articles/styles', 'articles.styles')->name('articles.styles');
Route::view('/articles/tools', 'articles.tools')->name('articles.tools');
