<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Models\User;

class ReviewController extends Controller
{
    // レビュー作成ページ表示
    public function reviewPage() {
        return view('private_page.review_create');
    }

    // 利用店のレビューを作成
    public function createReview(ReviewRequest $request) {
        $userId = auth()->user()->id;
        $shopId = $request->input('shop_id');

        // 画像の有無を確認
        if ($request->hasFile('review_image')) {
            $imageName = time(). '.' .$request->review_image->extension();

            $request->review_image->move(public_path('images'), $imageName);

            // 画像がある場合
            $review = Review::create([
                'user_id' => $userId,
                'shop_id' => $shopId,
                'user_name' => $request->user_name,
                'ranting' => $request->ranting,
                'comment' =>$request->comment,
                'image' => $imageName,
            ]);
        } else {
            // 画像がない場合
            $review = Review::create([
                'user_id' => $userId,
                'shop_id' => $shopId,
                'user_name' => $request->user_name,
                'ranting' => $request->ranting,
                'comment' =>$request->comment,
            ]);
        }

        $script = "<script>alert('レビューを作成しました');</script>";

        return redirect()->back()->with('script', $script);
    }

    // レビュー編集ページ表示
    public function editPage() {
        return view('private_page.review_edit');
    }

    // レビュー更新処理
    public function updateReview(ReviewRequest $request, $id) {
        $review = Review::findOrFail($id);
        $userId = auth()->user()->id;
        // 画像の有無を確認
        if ($request->hasFile('review_image')) {
            $imageName = time(). '.' .$request->review_image->extension();

            $request->review_image->move(public_path('images'), $imageName);

            // 画像がある場合
            $review->update([
                'user_id' => $userId,
                'shop_id' => $request->shop_id,
                'user_name' => $request->user_name,
                'ranting' => $request->ranting,
                'comment' =>$request->comment,
                'image' => $request->imageName,
            ]);
        } else {
            // 画像がない場合
            $review = Review::create([
                'user_id' => $userId,
                'shop_id' => $request->shop_id,
                'user_name' => $request->user_name,
                'ranting' => $request->ranting,
                'comment' =>$request->comment,
            ]);
        }

        $script = "<script>alert('レビューを更新しました');</script>";

        return redirect()->back()->with('script', $script);
    }

    // レビュー削除処理
    public function deleteReview($id) {
        $review = Review::findOrFail($id);
        $review->delete();

        $script = "<script>alert('レビューを削除しました');</script>";

        return redirect()->back()->with('script', $script);
    }
}
