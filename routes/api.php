<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssueController;

/**
 * issues组路由
 */
Route::prefix('issues')->group(function(){
    Route::post('/install', [IssueController::class, 'store'])->name('issues.store');
    Route::get('/list', [IssueController::class,'showList']);
    Route::get('/find/{id}', [IssueController::class,'show']);
});