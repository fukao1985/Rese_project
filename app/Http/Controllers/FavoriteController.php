<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Favorite;
use App\Models\User;
use App\Models\Shop;
use App\Http\Requests\AddFavoriteRequest;

class FavoriteController extends Controller
{
    // お気に入り登録
    public function addToFavorites(AddFavoriteRequest $request) {
        // dd('Reached addToFavorites method');
        try {
            Log::info('addToFavorites メソッドが呼ばれました');
            $userId = auth()->user()->id;
            $shopId = $request->input('shop_id');

        // 既にお気に入り登録がされているかどうかを確認
        $existingFavorite = Favorite::where('user_id', $userId)->where('shop_id', $shopId)->first();

        // dd($existingFavorite); // 既存のお気に入りを確認

        if ($existingFavorite) {
            // 既にお気に入り登録されていた場合はお気に入りを削除
            $existingFavorite->delete();
            return response()->json(['message' => 'お気に入りを解除しました'], 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            // お気に入り登録されていなかった場合はお気に入りに登録
            Favorite::create([
                'user_id' => $userId,
                'shop_id' => $shopId,
            ]);
            return response()->json(['message' => 'お気に入りに登録しました'], 200, [], JSON_UNESCAPED_UNICODE);
        }
            Log::info('お気に入り登録処理が完了しました');
            } catch (\Exception $e) {
            Log::error('addToFavorites メソッドでエラーが発生しました: ' . $e->getMessage());
            return response()->json(['message' => 'エラーが発生しました'], 500);
        }
    }
}
