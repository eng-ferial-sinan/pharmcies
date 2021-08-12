<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\order;
use App\Models\Pharmacy;
use App\Models\User;
class OrderNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $order;
    private $user;
    private $pharmacy;

    public function __construct(order $order , User $user ,Pharmacy $pharmacy)
    {

        $this->order=$order;    
        $this->user=$user;    
        $this->pharmacy=$pharmacy;    
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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('طلب جديد ')
                    ->line('  رقم الطلبية: '.$this->order->id)
                    ->line('الصيدلية  : '.$this->pharmacy->name)
                    ->line('الزبون : '.$this->user->name)
                    ->line('المبلغ : '.$this->order->total_pice)
                    ->action('تفاصيل اكثر ', url('order/'.$this->order['id']))
                    ->line('                       ')
                    ->line('شكرا لاستخدامك تطبيقانا!');
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
