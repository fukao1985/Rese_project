<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RepresentativeRequest;
use App\Http\Requests\SendNotificationFormRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\SystemNotificationMail;
use App\Models\Shop;
use App\Models\User;
use App\Models\Representative;
use App\Models\SystemNotification;
use App\Models\SystemManager;
use Carbon\Carbon;

class SystemManagerController extends Controller
{
    // システム管理者ページ表示
    public function managementTop() {
        $users = User::all();
        $shops = Shop::all();

        return view('system_manager.system_management', compact('users', 'shops'));
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

    // システム管理者からのお知らせメール送信ページ表示
    public function sendForm() {
        return view('system_manager.send_notification');
    }

    // システム管理者から全ユーザーへのお知らせメール送信
    public function sendSystemNotification(SendNotificationFormRequest $request) {
        \Log::info('Title: ' . $request->title);
        \Log::info('Message: ' . $request->body);

        $userEmails = User::pluck('email');
        $userId = auth()->user()->id;
        $systemManager = SystemManager::where('user_id', $userId)->first();

        foreach($userEmails as $userEmail) {
            // ユーザーにメールを送信
            try {
                Mail::to($userEmail)->send(new SystemNotificationMail($request->title, $request->body));
                \Log::info('Sent email to ' . $userEmail . ' successfully');
            } catch (\Exception $e) {
                \Log::error('Failed to send email to ' . $userEmail . ': ' . $e->getMessage());
            }

            // メールの内容をデータベースに保存
            try {
                SystemNotification::create([
                    'system_manager_id' => $systemManager->id,
                    'date' => Carbon::now(),
                    'title' => $request->title,
                    'message' => $request->body,
                    'recipient_email' => $userEmail,
                ]);
                \Log::info('Saved notification to database for ' . $userEmail . ' successfully');
            } catch (\Exception $e) {
                \Log::error('Failed to save notification to database for ' . $userEmail . ': ' . $e->getMessage());
            }
        }

        $script = "<script>alert('お知らせメールを送信しました');</script>";

        return redirect()->back()->with('script', $script);
    }
}
