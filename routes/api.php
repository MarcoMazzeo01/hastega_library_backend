<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\LibraryController;
use App\Http\Controllers\Api\UserController;
use App\Models\Book;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('books', BookController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('library', LibraryController::class);


Route::delete('/library/{userId}/{bookId}', [LibraryController::class, 'removeFromLibrary']);
//Route::post('/library/{userId}/{bookId}/restore', [LibraryController::class, 'restoreToLibrary']);