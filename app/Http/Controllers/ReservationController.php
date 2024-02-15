<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;

class ReservationController extends Controller
{
    public function createReservation(ReservationRequest $request) {
        
    }

    // 予約完了ページの表示
    public function done() {
        return view('private_page.done');
    }
}
