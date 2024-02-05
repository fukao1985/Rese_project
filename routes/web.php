<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ShopController;
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
Route::middleware(['web'])->get('/', function () {
    return view('public_page.shop_list');
})->name('public.shop_list');

// ログインユーザーのトップページ
Route::middleware(['auth:sanctum', 'verified'])->get('/shop/index', function () {
    return view('private_page.shop_list');
})->name('private.shop_list');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



// thanksページの表示
Route::get('/thanks', [RegisteredUserController::class, 'index'])->name('thanks');

// my_pageの表示
Route::get('/my_page', [LoginUserController::class, 'showMyPage'])->name('my_page');

// 店舗詳細ページの表示
Route::get('/detail/{shop_id}', [ShopController::class, 'shopDetail'])->name('shop_detail');
// 店舗情報追加ページ(店舗管理者ページトップ)の表示
Route::get('/shop/management', [ShopController::class, 'shopManagement'])->name('shop_management');
// 店舗情報追加
Route::post('/shop/create', [ShopController::class, 'shopCreate'])->name('shop.create');


// 予約完了画面の表示
Route::get('/done', [ReservationController::class, 'done'])->name('done');