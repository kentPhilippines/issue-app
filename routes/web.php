<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


//第一次进入的时候访问的接口
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('home');;
Route::get('/dashboard', function () {
    return view('content.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/recommend', function () {
    return view('content.recommend');
})->middleware(['auth', 'verified'])->name('recommend');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
