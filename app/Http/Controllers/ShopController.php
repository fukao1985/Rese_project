<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    // 店舗詳細ページの表示
    public function shopDetail() {
        return view('private_page.shop_detail');
    }
}
