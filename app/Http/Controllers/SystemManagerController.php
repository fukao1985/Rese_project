<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RepresentativeRequest;
use App\Http\Requests\SystemNotificationRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\CampaignNotification;
use App\Models\Shop;
use App\Models\User;
use App\Models\Representative;
use App\Models\SystemNotification;
use Carbon\Carbon;

class SystemManagerController extends Controller
{
    // システム管理者ページ表示
    public function managementTop() {
        $users = User::all();
        $shops = Shop::all();

        return view('system_management', compact('users', 'shops'));
    }

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

    // からのお知らせメール送信ページ表示
    public function sendForm() {
        return view('send_campaign');
    }

    // システム管理者から全ユーザーへのお知らせメール送信
    public function sendSystemNotification(SystemNotificationRequest $request) {
        // $userId = auth()->user()->id;
        // $userDate = User::where('user_id', $userId)->get();
        $userEmails = User::pluck('email');
        // $shopId = $representative->shop_id;
        // $favorites = Favorite::where('shop_id', $shopId)->with('user')->get();
        // $favoriteEmails = $favorites->pluck('user.email');

        // foreach($favoriteEmails as $favoriteEmail) {
        //     Mail::to($favoriteEmail)->send(new CampaignNotification());
        // }
        // メールを送信
        foreach($userEmails as $userEmail) {
            Mail::to($userEmail)->send(new SystemNotification());
        }

        // 内容をデータベースに保存
        $systemNotification = SystemNotification::create([
            'date' => Carbon::now();
            'title' => $request->title,
            'message' => $request->message,
            'recipient_email' => $userEmail,
        ]);

        $script = "<script>alert('お知らせメールを送信しました');</script>";

        return redirect()->back()->with('script', $script);
    }
}
