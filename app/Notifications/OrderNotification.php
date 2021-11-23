<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Order;
use NotificationChannels\OneSignal\OneSignalChannel;
use NotificationChannels\OneSignal\OneSignalMessage;

class OrderNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $order;

    public function __construct(order $order)
    {

        $this->order=$order;
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
        $url = route('order.show', $this->order->id);

           return OneSignalMessage::create()
            ->setSubject("الطلب رقم {$this->order->id} طلب جديد.")
            ->setBody("اضغط هنا لمعرفة المزيد .")
            ->setUrl($url);
    }
    public function toDatabase($notifiable)
    {
        return [
            'id'=>$this->order->id,
            'user'=>$this->order->user?$this->order->user->name:'',
            'date'=>$this->order->created_at,
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
