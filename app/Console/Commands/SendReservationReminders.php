<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ReservationRemindersController;


class SendReservationReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:send-reservation-reminders';
    protected $signature = 'send:reservation-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description';
    protected $description = 'Send reservation reminders';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $controller = new ReservationRemindersController();
        $controller->sendReservationReminders();
    }
    
}
