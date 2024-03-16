<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Reservation;
use App\Models\Room;

class MiniAdminReservationNotification extends Notification
{
    protected $room;
    protected $reservation;
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Room $room, Reservation $reservation)
    {
        $this->room = $room;
        $this->reservation = $reservation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    { {
            return (new MailMessage)
                ->subject('Room Booking System - Reservation Confirmation')
                ->from('booking@ilab.com', 'iLab Booking System')
                ->line('Hello ' . $notifiable->name . ',')
                ->line(auth()->user()->name . ' has made a reservation for the following room:') // Include the authenticated user's name
                ->line('Room Name: ' . $this->room->name) // Include the room name
                ->line('Reservation Date: ' . $this->reservation->reservationDate)
                ->line('Reservation Time: ' . $this->reservation->reservationTime)
                ->action('View Reservation', url('/Miniadmin/reservations')) // Adjust the URL as needed
                ->line('Thank you for using our reservation system.');
        }
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
    public function toDatabase($notifiable)
    {
        return [
            'message' => 'A new reservation request for ' . $this->room . ' has been submitted.',
            // Add any additional data you want to pass to the notification view
        ];
    }
}