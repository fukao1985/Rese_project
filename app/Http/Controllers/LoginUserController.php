<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginUserController extends Controller
{
    public function showMypage() {
        return view('private_page.mypage');
    }
}
