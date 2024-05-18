<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssueController;


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
Route::get('/release', function () {
    return view('content.release');
})->middleware(['auth', 'verified'])->name('release');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';
require __DIR__.'/api.php';
