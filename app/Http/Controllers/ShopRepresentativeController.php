<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ShopCreateRequest;
use App\Http\Requests\ShopUpdateRequest;
use App\Models\User;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Shop;
use App\Models\Reservation;
use App\Models\Representative;
use App\Models\Favorite;

class ShopRepresentativeController extends Controller
{
    // 店舗情報編集ページ表示
    public function shopManagement() {

        $areas = Area::all();
        $genres = Genre::all();

        return view('representative.shop_management', compact('areas', 'genres'));
    }

    // 店舗情報作成
    public function shopCreate(ShopCreateRequest $request) {
        $shop = Shop::create([
            'name' => $request->name,
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'comment' => $request->comment,
            'url' => $request->url,
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file')->store('images', 'local');
        }

        $script = "<script>alert('店舗情報が作成されました');</script>";

        return redirect()->back()->with('script', $script);
    }

    // 店舗情報更新ページ表示
    public function shopInformation() {
        // ★下記は店舗認証を作成後に店舗情報のみを取得に変更する
        $userId = auth()->user()->id;
        $representative = Representative::where('user_id', $userId)->first();
        $shopId = $representative->shop_id;
        $shopInfo = Shop::where('id', $shopId)->first();
        $areas = Area::all();
        $genres = Genre::all();

        return view('representative.shop_update',compact('shopInfo', 'areas', 'genres'));
    }

    // 店舗情報更新処理(認証作成後使用)
    public function shopUpdate(ShopUpdateRequest $request) {
        $userId = auth()->user()->id;
        $representative = Representative::where('user_id', $userId)->first();
        $shopId = $representative->shop_id;
        $shopInfo = Shop::where('id', $shopId)->first();

        $updateData = [];

        if ($request->filled('name')) {
            $updateData['name'] = $request->name;
        }

        if ($request->filled('area_id')) {
            $updateData['area_id'] = $request->area_id;
        }

        if ($request->filled('genre_id')) {
            $updateData['genre_id'] = $request->genre_id;
        }

        if ($request->filled('comment')) {
            $updateData['comment'] = $request->comment;
        }

        if ($request->filled('url')) {
            $updateData['url'] = $request->url;
        }

        $shopInfo->update($updateData);

        if ($request->hasFile('file')) {
            $file = $request->file('file')->store('images', 'local');
        }

        $script = "<script>alert('店舗情報が更新されました');</script>";

        return redirect()->back()->with('script', $script);
    }

    // 店舗予約一覧ページを表示
    public function shopReservationIndex() {
        $userId = auth()->user()->id;
        $representative = Representative::where('user_id', $userId)->first();
        $shopId = $representative->shop_id;
        $reservations = Reservation::where('id', $shopId)->get();

        return view('representative.shop_reservation', compact('reservations'));
    }

    // 予約個別ページ表示
    public function individualReservation($reservation_id) {
        $reservation = Reservation::where('id',  $reservation_id)->first();

        return view('representative.individual_reservation', compact('reservation'));
    }
}
