<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

class SystemManagerController extends Controller
{
    // システム管理者ページ表示
    public function managementTop() {
        $shops = Shop::all();
        return view('system_management', compact('shops'));
    }

    // 店舗代表者にしたいユーザーのアカウントを検索
    public function userSearch(Request $request) {
        $keyword = $request->input('keyword');

        $users = User::where('name', 'like', "%$keyword%")->get();
        dd($users);

        return view('system_management', compact('users'));
    }

    // 店舗代表者を作成
    public function representativeCreate(Request $request) {
        

        $script = "<script>alert('店舗代表者が作成されました');</script>";

        return redirect()->back()->with('script', $script);
    }
}
