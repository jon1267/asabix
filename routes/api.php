<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiPostController;
use App\Http\Controllers\Api\ApiTagController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('posts', ApiPostController::class)->except(['update']);
Route::apiResource('tags', ApiTagController::class)->except(['update']);

Route::post('/posts/{id}', [ApiPostController::class, 'update'])->name('posts.update');
Route::post('/tags/{id}', [ApiTagController::class, 'update'])->name('tags.update');

Route::post('/tags-translations', [ApiTagController::class, 'storeTagTranslations']);
Route::post('/tags-translations/{id}', [ApiTagController::class, 'updateTagTranslations']);
Route::delete('/tags-translations/{id}', [ApiTagController::class, 'deleteTagTranslations']);