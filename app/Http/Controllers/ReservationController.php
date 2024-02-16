<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;

class ReservationController extends Controller
{
    // 予約処理
    public function createReservation(ReservationRequest $request) {
        $userId = auth()->user()->id;
        $reservation = Reservation::create([
            'user_id' => $userId,
            'shop_id' => $request->shop_id,
            'date' => $request->date,
            'time' => $request->time,
            'number' => $request->number,
        ]);

        return view('private_page.done');
    }

    // // 予約完了ページの表示
    // public function done() {
    //     return view('private_page.done');
    // }
}
