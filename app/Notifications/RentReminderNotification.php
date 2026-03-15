<?php

namespace App\Notifications;

use App\Models\HouseBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RentReminderNotification extends Notification
{
    use Queueable;

    public function __construct(private readonly HouseBooking $houseBooking)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Rent Reminder')
            ->greeting('Hello ' . $notifiable->full_name . ',')
            ->line('This is your automated reminder for your house booking rent payment.')
            ->line('House Number: ' . $this->houseBooking->house->house_number)
            ->line('Rent Amount: Ksh ' . number_format((float) $this->houseBooking->house->rent, 2))
            ->action('View Booking', route('bookings.show', $this->houseBooking))
            ->line('Thank you for using our Estate Management System.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'house_booking_id' => $this->houseBooking->id,
            'message' => 'Rent reminder sent for house #' . $this->houseBooking->house->house_number,
        ];
    }
}
