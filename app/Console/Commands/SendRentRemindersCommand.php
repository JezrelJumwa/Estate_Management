<?php

namespace App\Console\Commands;

use App\Models\HouseBooking;
use App\Notifications\RentReminderNotification;
use App\Services\SmsService;
use Illuminate\Console\Command;

class SendRentRemindersCommand extends Command
{
    protected $signature = 'rent:send-reminders';

    protected $description = 'Send automated rent reminders to active tenants';

    public function handle(SmsService $smsService): int
    {
        $activeBookings = HouseBooking::query()
            ->with(['user', 'house', 'booking'])
            ->whereHas('booking', function ($query) {
                $query->where('status', 'UNAVAILABLE');
            })
            ->get();

        foreach ($activeBookings as $booking) {
            $booking->user->notify(new RentReminderNotification($booking));

            $smsService->send(
                $booking->user->id_number,
                'Rent reminder: House #' . $booking->house->house_number . ' rent Ksh ' . number_format((float) $booking->house->rent, 2),
                $booking->user
            );
        }

        $this->info('Sent reminders to ' . $activeBookings->count() . ' active bookings.');

        return self::SUCCESS;
    }
}
