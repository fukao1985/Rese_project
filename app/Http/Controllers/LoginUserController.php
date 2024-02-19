<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Favorite;

class LoginUserController extends Controller
{
    public function showMyPage() {
        $userId = auth()->user()->id;
        $reservations = Reservation::where('user_id', $userId)->get();
        $favorites = Favorite::where('user_id', $userId)->get();
        $userFavorites = auth()->user()->favorites()->pluck('shop_id')->toArray();

        return view('private_page.my_page', compact('reservations', 'favorites', 'userFavorites'));
    }
}
