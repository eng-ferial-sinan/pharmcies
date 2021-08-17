<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\order;
use App\Models\Pharmacy;
use App\Models\User;
use App\Models\status;
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
    private $status;

    public function __construct(order $order, User $user, Pharmacy $pharmacy,status $status)
    {

        $this->order=$order;
        $this->user=$user;
        $this->pharmacy=$pharmacy;
        $this->status=$status;
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
        return ['Database','mail'];
    }
    public function toDatabase($notifiable)
    {
        return [
            'id'=>$this->order->id,
            'pharmacy'=>$this->pharmacy->name,
            'user'=>$this->user->name,
            'driver'=>$this->order->user?$this->order->user->name:'',
            'price'=>$this->order->total_pice,
            'status'=>$this->status->name,
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
