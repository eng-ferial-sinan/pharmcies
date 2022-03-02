<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Reservation;
use NotificationChannels\OneSignal\OneSignalChannel;
use NotificationChannels\OneSignal\OneSignalMessage;

class ReservationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $reservation;

    public function __construct(Reservation $reservation)
    {

        $this->reservation=$reservation;
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return ['mail'];
        return ['Database',OneSignalChannel::class];
    }

    public function toOneSignal($notifiable)
    {
        $url = route('reservation.show', $this->reservation->id);

           return OneSignalMessage::create()
            ->setSubject("الطلب رقم {$this->reservation->id} طلب جديد.")
            ->setBody("اضغط هنا لمعرفة المزيد .")
            ->setUrl($url);
    }
    public function toDatabase($notifiable)
    {
        return [
            'id'=>$this->reservation->id,
            'user'=>$this->reservation->user?$this->reservation->user->name:'',
            'date'=>$this->reservation->created_at,
        ];
    }
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        
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
}
