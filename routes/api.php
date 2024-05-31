<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CommentApi;
use App\Http\Controllers\Api\TagsApi;
use App\Http\Controllers\Api\IssueApi;
use App\Http\Controllers\IssueController;

 
/**
 * tags组路由
 */
Route::prefix('tags')->group(function(){
    Route::put('/install', [TagsApi::class, 'store']);
    Route::get('/list', [TagsApi::class,'showList']);
    Route::get('/find/{id}', [TagsApi::class,'show']);
});
/**
 * comments组路由
 */
Route::prefix('comments')->group(function(){
    Route::put('/install', [CommentApi::class, 'store'])->name('comment.store');;
    Route::get('/list', [CommentApi::class,'showList']);
    Route::get('/find/{id}', [CommentApi::class,'show']);
});
/**
 * issues组路由
 */
Route::prefix('issues')->group(function(){
    Route::put('/install', [IssueApi::class, 'store'])->name('issues.store');
    Route::put('/edit', [IssueApi::class, 'update']);
    Route::get('/list', [IssueApi::class,'showList']);
    Route::get('/find/{id}', [IssueController::class,'show'])->name('issueInfo');
});