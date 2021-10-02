<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Pharmacy;
use App\Models\User;
use App\Models\visit;
use NotificationChannels\OneSignal\OneSignalChannel;
use NotificationChannels\OneSignal\OneSignalMessage;

class VisitNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $visit;
    private $user;
    private $pharmacy;

    public function __construct(visit $visit, User $user, Pharmacy $pharmacy)
    {

        $this->visit=$visit;
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
        // return ['mail'];
        return [OneSignalChannel::class];
    }

    public function toOneSignal($notifiable)
    {
        $url = route('visit.show', $this->visit->id);

           return OneSignalMessage::create()
            ->setSubject("الزيارة رقم {$this->visit->id} زيارة جديدة.")
            ->setBody("اضغط هنا لمعرفة المزيد .")
            ->setData('الصيدلية ', $this->pharmacy->name)
            ->setData('المندوب الطبي ', $this->user->name)
            ->setUrl($url);
        
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
