<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Api\CommentApi;
use App\Http\Controllers\Api\TagsApi;
use App\Http\Controllers\Api\IssueApi;
use App\Http\Controllers\IssuesInvitesController;


/**
 * issues组路由
 */
Route::prefix('issues')->group(function(){
    Route::put('/install', [TagsController::class, 'store']);
    Route::get('/list', [TagsController::class,'showList']);
    Route::get('/find/{id}', [TagsController::class,'show']);
});


Route::prefix('tags')->group(function(){
    Route::put('/install', [IssueController::class, 'store']);
    Route::get('/list', [IssueController::class,'showList']);
    Route::get('/find/{id}', [IssueController::class,'show']);
});

Route::prefix('comments')->group(function(){
    Route::put('/install', [CommentApi::class, 'store']);
    Route::get('/list', [CommentApi::class,'showList']);
    Route::get('/find/{id}', [CommentApi::class,'show']);
});

Route::prefix('issues')->group(function(){
    Route::put('/install', [IssueController::class, 'store']);
    Route::get('/list', [IssueController::class,'showList']);
    Route::get('/find/{id}', [IssueController::class,'show']);
});