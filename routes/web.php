<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\LoginUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// ゲストユーザーのトップページ
Route::get('/', function () {
    return view('public_page.shoplist');
})->name('public.shoplist');

// ログインユーザーのトップページ
Route::middleware(['auth:sanctum', 'verified'])->get('/shop/index', function () {
    return view('private_page.shoplist');
})->name('private.shoplist');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



// thanksページの表示
Route::get('/thanks', [RegisteredUserController::class, 'index'])->name('thanks');

// mypageの表示
Route::get('/mypage', [LoginUserController::class, 'showMypage'])->name('mypage');
