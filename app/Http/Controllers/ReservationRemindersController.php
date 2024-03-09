<?php

namespace App\Http\Controllers;

use App\Mail\ReservationRemindersMail;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class ReservationRemindersController extends Controller
{
    // 予約当日の朝に予約情報のリマインダーを送る
    public function sendReservationReminders() {
        $today = Carbon::today();
        // 予約当日の予約情報を取得
        \Log::info('sendReservationReminders() method is called.');

        $reservations = Reservation::whereDate('date', $today)->get();
        // 予約がない場合は処理をしない
        if ($reservations->isEmpty()) {
            \Log::info('No reservations for today. ');
            return;
        }

        foreach ($reservations as $reservation) {
            try {
                // 当日予約があるユーザーにメールを送信
                $shopName = $reservation->shop->name;
                Mail::to($reservation->user->email)->send(new ReservationRemindersMail($reservation, $today->format('Y-m-d')));
                \Log::info('Sent reminder email to ' . $reservation->user->email . ' successfully');
            } catch (\Exception $e) {
                \Log::error('Failed to send reminder email to ' . $reservation->user->email . ': ' . $e->getMessage());
            }
        }
    }
}
