<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Models\User;

class ReviewController extends Controller
{
    // 利用店のレビューを作成
    public function createReview(ReviewRequest $request) {
        $userId = auth()->user()->id;
        $shopId = $request->input('shop_id');

        $review = Review::create([
            'user_id' => $userId,
            'shop_id' => $shopId,
            'user_name' => $request->user_name,
            'ranting' => $request->ranting,
            'comment' =>$request->comment,
        ]);
        $script = "<script>alert('レビューを作成しました');</script>";

        return redirect()->back()->with('script', $script);
    }
}
