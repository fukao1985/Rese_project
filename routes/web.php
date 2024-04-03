<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ShopRepresentativeController;
use App\Http\Controllers\SystemManagerController;
use App\Http\Controllers\QRcodeController;
use App\Http\Controllers\ReservationRemindersController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\CsvController;
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

require __DIR__.'/auth.php';

// ログインユーザーが'/'にアクセスした場合
Route::middleware(['auth:sanctum', 'verified'])->get('/', function() {
    return redirect()->route('user.top');
});

// ログインユーザー
Route::middleware(['auth:sanctum', 'verified'])->get('/shop/index', function () {
    return view('private_page.shop_list');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/user/{page}', function ($page) {
        return view('user.'.$page);
    })->where('page', '.*')->name('user.*');
});

// ログインユーザーのルート
Route::middleware(['auth'])->group(function () {
    // thanksページの表示
    Route::get('/thanks', [RegisteredUserController::class, 'index'])->name('thanks');

    // 店舗一覧ページ(ログインユーザートップページ)表示
    Route::get('/shop/index', [ShopController::class, 'userTop'])->name('user.top');
    // 店舗検索処理(ログインユーザートップページ)
    Route::post('/shop/index', [ShopController::class, 'getShopList'])->name('get.shop_list');
    // 店舗表示順セレクト処理
    Route::post('display/order', [ShopController::class, 'displayOrder'])->name('display.order');
    // 店舗詳細ページの表示(ログインユーザー用)
    Route::get('/detail/{shop_id}', [ShopController::class, 'shopDetail'])->name('shop.detail');

    // my_pageの表示
    Route::get('/my_page', [LoginUserController::class, 'showMyPage'])->name('my_page');

    // shop_listでのお気に入り登録/削除
    Route::post('shop/favorite/add', [FavoriteController::class, 'addToFavorites'])->name('favorite.add');
    // マイページでのお気に入り削除
    Route::delete('/favorite/remove/{favorite_id}', [FavoriteController::class, 'removeFromFavorites'])->name('favorite.remove');

    // 予約処理
    Route::post('/reservation/create', [ReservationController::class, 'createReservation'])->name('reservation.create');
    // 予約完了ページの表示
    Route::get('/done', [ReservationController::class, 'done'])->name('done');
    // 予約削除処理
    Route::delete('reservation/delete/{reservation_id}', [ReservationController::class, 'deleteReservation'])->name('reservation.delete');
    // 予約変更処理
    Route::put('/reservation/update/{reservation_id}', [ReservationController::class, 'updateReservation'])->name('reservation.update');

    // 利用店のレビュー作成
    Route::post('/review/create', [ReviewController::class, 'createReview'])->name('review.create');

    // Stripe決済
    Route::post('/charge', [StripeController::class, 'charge'])->name('stripe.charge');
});

// 店舗代表者のルート
Route::middleware(['auth', 'representative'])->group(function () {
    // 店舗情報追加ページ(店舗管理者ページトップ)の表示
    Route::get('/shop/management', [ShopRepresentativeController::class, 'shopManagement'])->name('shop_management');
    // 店舗情報追加
    Route::post('/shop/create', [ShopRepresentativeController::class, 'shopCreate'])->name('shop.create');
    // 店舗情報更新ページ表示
    Route::get('/shop/information', [ShopRepresentativeController::class, 'shopInformation'])->name('shop.info');
    // 店舗情報更新処理(認証作成後使用)
    Route::put('/shop/update', [ShopRepresentativeController::class, 'shopUpdate'])->name('shop.update');
    // 店舗予約一覧ページを表示
    Route::get('/shop/reservation', [ShopRepresentativeController::class, 'shopReservationIndex'])->name('reservation.index');
    // 予約個別ページ表示
    Route::get('/individual/reservation/{reservation_id}', [ShopRepresentativeController::class, 'individualReservation'])->name('individual.reservation');
});

// システム管理者のルート
Route::middleware(['auth', 'system_manager'])->group(function () {
    // システム管理者ページ表示
    Route::get('/management', [SystemManagerController::class, 'managementTop'])->name('management.top');
    // 店舗代表者を作成
    Route::post('/representative/create', [SystemManagerController::class, 'representativeCreate'])->name('representative.create');
    // お知らせメール送信フォームページ表示
    Route::get('/send/form', [SystemManagerController::class, 'sendForm'])->name('send.form');
    // システム管理者からのお知らせメール送信
    Route::post('/send/system_notification', [SystemManagerController::class, 'sendSystemNotification'])->name('send.notification');
    // 店舗情報作成(CSVファイルアップロード)ページ表示
    Route::get('/csv', [CsvController::class, 'csvFile'])->name('csv.file');
    // 店舗情報作成(CSVファイルアップロード)
    Route::post('/csv/upload', [CsvController::class, 'csvUpload'])->name('csv.upload');
});

// QRコードを生成してviewに渡す
Route::get('/qr_code/{reservation_id}', [QRCodeController::class, 'generateQRcode'])->name('qr_code.generate');

//ゲストユーザー
Route::middleware(['web'])->get('/',function () {
    if (Auth::check()) {
        return redirect()->route('user.top');
    } else {
        return redirect()->route('guest.top');
    }
});

// 店舗一覧ページ(ゲストユーザートップページ)表示
Route::get('/', [ShopController::class, 'guestTop'])->name('guest.top');
// 店舗検索処理(ゲストユーザートップページ)
Route::post('/', [ShopController::class, 'guestShopList'])->name('guest.shop_list');
// 店舗詳細ページの表示(ゲストユーザー用)
Route::get('/guest/detail/{shop_id}', [ShopController::class, 'guestShopDetail'])->name('guest.detail');
