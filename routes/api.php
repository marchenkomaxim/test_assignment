<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [LoginController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [LoginController::class, 'logout']);

Route::post('/register', [RegisterController::class, 'register']);

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'delete']);
    Route::get('/products/{id}/edit', [ProductController::class, 'edit']);
});

Route::get('/comments', [CommentController::class, 'index']);
Route::get('/comments/{id}', [CommentController::class, 'show']);
Route::post('/comments', [CommentController::class, 'store'])->middleware('auth:sanctum');
Route::put('/comments/{id}', [CommentController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/comments/{id}', [CommentController::class, 'delete'])->middleware('auth:sanctum');
Route::get('/comments/{id}/edit', [CommentController::class, 'edit'])->middleware('auth:sanctum');

Route::get('/purchases', [PurchaseController::class, 'index'])->middleware('auth:sanctum');;
Route::get('/purchases/{id}', [PurchaseController::class, 'show'])->middleware('auth:sanctum');;
Route::post('/purchases', [PurchaseController::class, 'store'])->middleware('auth:sanctum');
Route::put('/purchases/{id}', [PurchaseController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/purchases/{id}', [PurchaseController::class, 'delete'])->middleware('auth:sanctum');
Route::get('/purchases/{id}/edit', [PurchaseController::class, 'edit'])->middleware('auth:sanctum');








