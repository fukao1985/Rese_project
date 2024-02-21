<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Favorite;
use App\Models\User;
use App\Models\Shop;


class FavoriteController extends Controller
{
    // shop_listでのお気に入り登録・削除処理
    public function addToFavorites(Request $request) {
        try {
                $userId = auth()->user()->id;
                $shopId = $request->input('shop_id');

                // すでにお気に入り登録されているかを確認
                $existingFavorite = Favorite::where('user_id', $userId)->where('shop_id', $shopId)->first();

                if ($existingFavorite !==null) {
                    $existingFavorite->delete();
                    $script = "<script>alert('お気に入りを削除しました');</script>";
                } else {
                    $favorite = Favorite::create([
                        'user_id' => $userId,
                        'shop_id' => $shopId,
                    ]);
                    $script = "<script>alert('お気に入りに登録しました');</script>";
                }

            return redirect()->back()->with('script', $script);

        } catch (\Exception $e) {
            $script = "<script>alert('エラーが発生しました');</script>";

            return redirect()->back()->with('script', $script);
        }
    }

    // my_pageでのお気に入り削除
    public function removeFromFavorites($favorite_id) {
        $userFavorite = Favorite::findOrFail($favorite_id);
        $userFavorite->delete();

        $script = "<script>alert('お気に入りを削除しました');</script>";

        return redirect()->back()->with('script', $script);
    }
}
