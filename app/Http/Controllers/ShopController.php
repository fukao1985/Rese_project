<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Shop;
use App\Models\User;
use App\Models\Favorite;
use App\Models\Review;
use App\Models\Reservation;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ShopController extends Controller
{
    // ログインユーザートップ(店舗一覧ページ)の表示
    public function userTop(Request $request)
    {
        $areas = Area::all();
        $genres = Genre::all();
        $shops = Shop::all();
        $userFavorites = auth()->user()->favorites()->pluck('shop_id')->toArray();
        $shopId = $request->input('shop_id');
        $favorites = Favorite::where('user_id', auth()->id())
            ->whereIn('shop_id', $shops->pluck('id'))
            ->get()
            ->keyBy('shop_id');

        $isFavorite = [];
        foreach ($shops as $shop) {
            $isFavorite[$shop->id] = $favorites->has($shop->id) ? $favorites[$shop->id]->id : null;
        }

        return view('private_page.shop_list', compact('areas', 'genres', 'shops', 'isFavorite'));
    }

    // 店舗表示順セレクト処理
    public function displayOrder(Request $request) {
        $areas = Area::all();
        $genres = Genre::all();
        $shops = Shop::withCount('reviews')->get();
        $userFavorites = auth()->user()->favorites()->pluck('shop_id')->toArray();
        $shopId = $request->input('shop_id');
        $favorites = Favorite::where('user_id', auth()->id())
            ->whereIn('shop_id', $shops->pluck('id'))
            ->get()
            ->keyBy('shop_id');

        $isFavorite = [];
        foreach ($shops as $shop) {
            $isFavorite[$shop->id] = $favorites->has($shop->id) ? $favorites[$shop->id]->id : null;
        }

        $order = $request->input('order', 'default');

        // レビューが有る店と無い店をそれぞれ取得
        $shopsWithReviews = Shop::has('reviews')->get();
        $shopsWithoutReviews = Shop::doesntHave('reviews')->get();

        switch ($order) {
            case 'random':
                $shops = $shops->shuffle();
                break;
            case 'high_rating':
                $shopsWithReviews = $shopsWithReviews->sortByDesc(function ($shop) {
                    return $shop->reviews->avg('ranting');
                });
                $shops = $shopsWithReviews->merge($shopsWithoutReviews);
                break;
            case 'low_rating':
                $shopsWithReviews = $shopsWithReviews->sortBy(function ($shop) {
                    return $shop->reviews->avg('ranting');
                });
                $shops = $shopsWithReviews->merge($shopsWithoutReviews);
                break;
            default:
        }

        return view('private_page.shop_list', compact('areas', 'genres', 'shops', 'isFavorite'));
    }

    // ログインユーザー検索処理
    public function getShopList(Request $request) {
        $areas = Area::all();
        $genres = Genre::all();
        $userFavorites = auth()->user()->favorites()->pluck('shop_id')->toArray();

        $query = Shop::query();

        if ($request->filled('area_id')) {
            $query->where('area_id', $request->input('area_id'));
        }
        if ($request->filled('genre_id')) {
            $query->where('genre_id', $request->input('genre_id'));
        }
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        $shops = $query->get();

        // $shops = Shop::all();
        // $shopId = $request->input('shop_id');
        $favorites = Favorite::where('user_id', auth()->id())
            ->whereIn('shop_id', $shops->pluck('id'))
            ->get()
            ->keyBy('shop_id');

        $isFavorite = [];
        foreach ($shops as $shop) {
            $isFavorite[$shop->id] = $favorites->has($shop->id) ? $favorites[$shop->id]->id : null;
        }

        return view('private_page.shop_list', compact('areas', 'genres', 'shops', 'isFavorite'));
    }

    // ログインユーザー用店舗詳細ページの表示
    public function shopDetail($shop_id) {
        $selectShop = Shop::findOrFail($shop_id);

        // selectShopに対するレビューがあればレビューを取得(5件ごとのページネーション)
        $reviews = $selectShop->reviews()->paginate(5);

        // レビュー入力フォーム表示判定(ログインユーザーがselectShopを利用したかどうかを確認)
        $userId = auth()->user()->id;
        $hasReservation = Reservation::where('shop_id', $shop_id)
        ->where('user_id', $userId)
        ->whereDate('date', '<', now())
        ->exists();

        return view('private_page.shop_detail', compact('selectShop', 'reviews', 'hasReservation'));
    }

    // ゲストユーザートップ(店舗一覧ページ)の表示
    public function guestTop(Request $request) {
        $areas = Area::all();
        $genres = Genre::all();
        $shops = Shop::all();

        return view('public_page.shop_list', compact('areas', 'genres', 'shops'));
    }

    // ゲストユーザー検索処理
    public function guestShopList(Request $request) {
        $areas = Area::all();
        $genres = Genre::all();
        $query = Shop::query();

        if ($request->filled('area_id')) {
            $query->where('area_id', $request->input('area_id'));
        }
        if ($request->filled('genre_id')) {
            $query->where('genre_id', $request->input('genre_id'));
        }
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        $shops = $query->get();

        return view('public_page.shop_list', compact('areas', 'genres', 'shops'));
    }

    // ゲストユーザー用店舗詳細ページの表示
    public function guestShopDetail($shop_id) {
        $selectShop = Shop::where('id', $shop_id)->first();

        return view('public_page.shop_detail', compact('selectShop'));
    }
}
