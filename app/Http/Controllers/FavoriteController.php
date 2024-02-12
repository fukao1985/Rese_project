<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    // お気に入り登録
    public function addToFavorites(AddFavoriteRequest $request) {
        $userId = auth()->user()->id;
        $shopId = $request->input('shop_id');

        // 既にお気に入り登録がされているかどうかを確認
        $existingFavorite = Favorite::where('user_id', $userId)->where('shop_id', $shopId)->first();

        

    }
}
