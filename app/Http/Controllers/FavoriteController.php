<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Favorite;
use App\Models\User;
use App\Models\Shop;


class FavoriteController extends Controller
{
    // お気に入り登録処理・お気に入り登録削除処理
    public function addToFavorites(Request $request) {
        try {
            $userId = auth()->user()->id;
            $shopId = $request->input('shop_id');

            // 既にお気に入り登録がされているかどうかを確認
            $existingFavorite = Favorite::where('user_id', $userId)->where('shop_id', $shopId)->first();

            if ($existingFavorite) {
                // 既にお気に入り登録されていた場合はお気に入りを削除
                $existingFavorite->delete();
                $message = 'お気に入りを解除しました';
                $isFavorite = false;
            } else {
                // お気に入り登録されていなかった場合はお気に入りに登録
                Favorite::create([
                    'user_id' => $userId,
                    'shop_id' => $shopId,
                ]);
                $message = 'お気に入りに登録しました';
                $isFavorite = true;
            }

            // お気に入りの状態を返す
            $userFavorites = Favorite::where('user_id', $userId)->pluck('shop_id')->toArray();
            return response()->json(['message' => $message, 'user_favorites' => $userFavorites], 200);
        } catch (\Exception $e) {
            Log::error('addToFavorites メソッドでエラーが発生しました: ' . $e->getMessage());
            return response()->json(['message' => 'エラーが発生しました'], 500);
        }
    }

    public function getUserFavorites(Request $request){
        $userId = auth()->user()->id;
        $userFavorites = Favorite::where('user_id', $userId)->pluck('shop_id')->toArray();
        return response()->json($userFavorites);
    }
}
