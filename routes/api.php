<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/authors/{id}',[AuthorController::class,'show']);
Route::get('/authors',[AuthorController::class, 'index']);
Route::put('/authors/update/{id}',[AuthorController::class, 'update']);
Route::post('/authors-store',[AuthorController::class,'store']);

Route::get('/genres/{id}',[GenreController::class,'show']);
Route::get('/genres',[GenreController::class,'index']);
Route::put('/genres/update/{id}',[GenreController::class, 'update']);
Route::post('/genres-store',[GenreController::class,'store']);

Route::get('/books/{id}',[BookController::class,'show']);
Route::get('/books',[BookController::class,'index']);
Route::put('/books/update/{id}',[BookController::class, 'update']);
Route::post('/books-store',[BookController::class,'store']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
