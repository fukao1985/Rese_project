<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ShopCreateRequest;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Shop;
use Intervention\Image\Facades\Image;

class ShopController extends Controller
{
    // 店舗詳細ページの表示
    public function shopDetail() {
        return view('private_page.shop_detail');
    }

    // 店舗情報編集ページ表示
    public function shopManagement() {

        $areas = Area::all();
        $genres = Genre::all();

        return view('shop_management', compact('areas', 'genres'));
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
            $image = $request->file('file');
            $imageResized = Image::make($image)->resize(300, 200);
            $imageResizedPath = 'images/resized_' . $image->ntOriginalName();
            $imageResized->save($imageResizedPath);

            $file = Storage::disk('local')->putFile('images', $imageResizedPat);
        }

        return back()->with('message', '店舗情報が作成されました');

    }

}
