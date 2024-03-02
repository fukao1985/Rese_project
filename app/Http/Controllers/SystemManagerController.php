<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RepresentativeRequest;
use App\Models\Shop;
use App\Models\User;
use App\Models\Representative;

class SystemManagerController extends Controller
{
    // システム管理者ページ表示
    public function managementTop() {
        $users = User::all();
        $shops = Shop::all();

        return view('system_management', compact('users', 'shops'));
    }

    // // 店舗代表者にしたいユーザーのアカウントを検索
    // public function userSearch(Request $request) {
    //     $keyword = $request->input('keyword');

    //     $users = User::where('name', 'like', "%$keyword%")->get();
    //     dd($users);

    //     return view('system_management', compact('users'));
    // }

    // 店舗代表者を作成
    public function representativeCreate(RepresentativeRequest $request) {
        $userId = $request->user_id;
        $userDate = User::FindOrFail($userId);
        $shopId = $request->shop_id;
        $role = $request->role;

        // usersテーブルのroleを更新
        $userDate->update([
            'role' => $role,
        ]);

        // representativesテーブルに店舗代表者を作成
        $representative = Representative::create([
            'user_id' => $userId,
            'shop_id' => $shopId,
        ]);

        $script = "<script>alert('店舗代表者が作成されました');</script>";

        return redirect()->back()->with('script', $script);
    }
}
