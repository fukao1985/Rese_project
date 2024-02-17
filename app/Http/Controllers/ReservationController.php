<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;

class ReservationController extends Controller
{
    // 予約処理
    public function createReservation(ReservationRequest $request) {
        if (session()->has('reservation_submitted')) {
            return redirect()->back()->with('error', '予約はすでに送信されています');
        }

        $userId = auth()->user()->id;
        $reservation = Reservation::create([
            'user_id' => $userId,
            'shop_id' => $request->shop_id,
            'date' => $request->date,
            'time' => $request->time,
            'number' => $request->number,
        ]);

        session()->put('reservation_submitted', true);

        return view('private_page.done');
    }

    // 予約削除処理
    public function deleteReservation($id) {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->back()->with('success', '予約を削除しました');
    }

    // // 予約完了ページの表示
    // public function done() {
    //     return view('private_page.done');
    // }
}
