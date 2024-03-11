<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Favorite;

class LoginUserController extends Controller
{
    // マイページの表示
    public function showMyPage() {
        $userId = auth()->user()->id;
        $reservations = Reservation::where('user_id', $userId)->orderBy('date', 'desc')->get();
        $favorites = Favorite::where('user_id', $userId)->get();
        $userFavorites = auth()->user()->favorites()->pluck('shop_id')->toArray();

        // 予約が存在しない場合はQRコードURLを生成せずnullを代入
        $qrCodeUrl = null;
        if ($reservations->isNotEmpty()) {
            // 最初の予約のreservation_idを取得してQRコードURLを生成
            $firstReservationId = $reservations->first()->id;
            $qrCodeUrl = route('qr_code.generate', ['reservation_id' => $firstReservationId]);
        }

        return view('private_page.my_page', compact('reservations', 'favorites', 'userFavorites', 'qrCodeUrl'));
    }
}

