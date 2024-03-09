<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\SendReservationReminders;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // 予約当日の朝に予約情報のリマインダーを送る
        $schedule->command('send:reservation-reminders')->dailyAt('09:00');
        // $schedule->call(function () {
        //     $controller = new App\Http\Controllers\ReservationRemindersController();
        //     $controller->sendReservationReminders();
        // })->dailyAt('09:00');
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        $this->load(__DIR__.'/../Http/Controllers');
        // $this->load(app_path('Http/Controllers'));

        // $this->commands([
        //     SendReservationReminders::class,
        // ]);
        require base_path('routes/console.php');
    }
}
