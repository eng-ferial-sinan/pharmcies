<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Subscription;
use NotificationChannels\OneSignal\OneSignalChannel;
use NotificationChannels\OneSignal\OneSignalMessage;

class SubscriptionNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $subscription;

    public function __construct(Subscription $subscription)
    {

        $this->subscription=$subscription;
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
        $url = route('subscription.show', $this->subscription->id);

           return OneSignalMessage::create()
            ->setSubject("الاشتراك  رقم {$this->subscription->id} اشتراك  جديد.")
            ->setBody("اضغط هنا لمعرفة المزيد .")
            ->setUrl($url);
    }
    public function toDatabase($notifiable)
    {
        return [
            'id'=>$this->subscription->id,
            'user'=>$this->subscription->user?$this->subscription->user->name:'',
            'date'=>$this->subscription->created_at,
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
