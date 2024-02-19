<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FavoriteController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user/favorites', [FavoriteController::class, 'getUserFavorites']);

// // お気に入り登録
// Route::middleware(['auth'])->post('shop/favorite/add', [FavoriteController::class, 'addToFavorites'])->name('favorite.add');
