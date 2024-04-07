<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Models\User;
use App\Models\Shop;

class ReviewController extends Controller
{
    // レビュー作成ページ表示
    public function reviewPage($shop_id) {
        $favoriteShops = auth()->user()->favorites()->pluck('shop_id');
        $selectShop = Shop::findOrFail($shop_id);
        $isFavorite = $favoriteShops->contains($selectShop->id);


        return view('private_page.review_create', compact('selectShop', 'isFavorite'));
    }

    // 利用店のレビューを作成
    public function createReview(ReviewRequest $request) {
        $userId = auth()->user()->id;
        $shopId = $request->input('shop_id');
        $imageName = null;

        // 画像の有無を確認して保存
        if ($request->hasFile('review_image')) {
            $imageName = time(). '.' .$request->review_image->extension();
            $request->review_image->storeAs('public', $imageName);
        }

        // 画像のURLを設定
        $imageUrl = $imageName ? 'storage/' . $imageName : null;

        // レビューを作成
        $review = Review::create([
            'user_id' => $userId,
            'shop_id' => $shopId,
            'user_name' => $request->user_name,
            'ranting' => $request->ranting,
            'comment' => $request->comment,
            'image' => $imageName,
        ]);

        $script = "<script>alert('レビューを作成しました');</script>";

        return redirect()->route('shop.detail', $shopId)->with('script', $script);
    }

    // レビュー編集ページ表示
    public function editPage($review_id) {
        $review = Review::where('id', $review_id)->first();
        $selectShopId = $review->shop_id;
        $favoriteShops = auth()->user()->favorites()->pluck('shop_id');
        $isFavorite = $favoriteShops->contains($selectShopId);
        $selectShop = Shop::where('id', $selectShopId)->first();

        return view('private_page.review_edit', compact('review', 'selectShop', 'isFavorite'));
    }

    // レビュー更新処理
    public function updateReview(ReviewRequest $request, $id) {
        $review = Review::findOrFail($id);
        $userId = auth()->user()->id;
        $shopId = $request->shop_id;
        // 画像の有無を確認
        if ($request->hasFile('review_image')) {
            $imageName = time(). '.' .$request->review_image->extension();

            $request->review_image->move(public_path('images'), $imageName);

            // 画像がある場合
            $review->update([
                'user_id' => $userId,
                'shop_id' => $shopId,
                'user_name' => $request->user_name,
                'ranting' => $request->ranting,
                'comment' =>$request->comment,
                'image' => $request->imageName,
            ]);
        } else {
            // 画像がない場合
            $review->update([
                'user_id' => $userId,
                'shop_id' => $shopId,
                'user_name' => $request->user_name,
                'ranting' => $request->ranting,
                'comment' =>$request->comment,
            ]);
        }

        $script = "<script>alert('レビューを更新しました');</script>";

        return redirect()->route('shop.detail', $shopId)->with('script', $script);
    }

    // レビュー削除処理
    public function deleteReview($id) {
        $review = Review::findOrFail($id);
        $review->delete();

        $script = "<script>alert('レビューを削除しました');</script>";

        return redirect()->back()->with('script', $script);
    }
}
