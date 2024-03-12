<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationRemindersMail;


class SendReservationReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:reservation-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reservation reminders';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // 予約当日の朝に予約情報のリマインダーを送る
        $today = Carbon::today();
        $reservations = Reservation::whereDate('date', $today)->get();

        // 予約がない場合は処理をしない
        if ($reservations->isEmpty()) {
            $this->info('No reservations for today.');
            return;
        }

        foreach ($reservations as $reservation) {
            try {
                // 当日予約があるユーザーにメールを送信
                $shopName = $reservation->shop->name;
                Mail::to($reservation->user->email)->send(new ReservationRemindersMail($reservation, $today->format('Y-m-d'), $shopName));
                $this->info('Sent reminder email to ' . $reservation->user->email . ' successfully');
            } catch (\Exception $e) {
                $this->error('Failed to send reminder email to ' . $reservation->user->email . ': ' . $e->getMessage());
            }
        }
    }
}
