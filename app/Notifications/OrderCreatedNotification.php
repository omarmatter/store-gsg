<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Nexmo\Laravel\Facade\Nexmo;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\AndroidConfig;
use NotificationChannels\Fcm\Resources\AndroidFcmOptions;
use NotificationChannels\Fcm\Resources\AndroidNotification;
use NotificationChannels\Fcm\Resources\ApnsConfig;
use NotificationChannels\Fcm\Resources\ApnsFcmOptions;

class OrderCreatedNotification extends Notification
{
    use Queueable;

     protected $order;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $ordar)
    {
        $this->ordar=$ordar;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
            //'mail',
        FcmChannel::class,
        'database',

       // 'broadcast','nexmo'
    ];
    }
    public function toFcm(){
        return FcmMessage::create()
        // ->setData(['data1' => 'value', 'data2' => 'value2']) // لإرسال داتا ثابتة مع الاشعار
        ->setNotification(\NotificationChannels\Fcm\Resources\Notification::create()
            ->setTitle('New Order ')
            ->setBody('new order number' .$this->ordar->number)
            ->setImage('http://example.com/url-to-image-here.png'));

            //    لعمل شكل الإشعار على تطبيق
        // ->setAndroid(
        //     AndroidConfig::create()
        //         ->setFcmOptions(AndroidFcmOptions::create()->setAnalyticsLabel('analytics'))
        //         ->setNotification(AndroidNotification::create()->setColor('#0A0A0A'))
        // )->setApns(
            // ApnsConfig::create()
            //     ->setFcmOptions(ApnsFcmOptions::create()->setAnalyticsLabel('analytics_ios'))
            // );
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
                    ->subject('new Order')
                    ->from('biling@g','omar matter')
                    ->greeting('Hello : ' ,$notifiable->name)
                    ->line('A new order has been created (order #:)' .$this->ordar->number)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for shopping ')
                    ->view('Mails.invoice',[
                        'order'=>$this->ordar
                    ]);

    }
    public function toNexmo($notifiable){
        $message= new NexmoMessage();
        $message->content('new Order'.$this->ordar->number);
        return $message;

    }

    public function toDatabase($notifiable){
       return [
           'title'=>'New order ',
           'body'=> 'A new order has been created (order #:)' .$this->ordar->number ,
           'icon'=>'',
           'url'=>url('/')
       ];

    }
    public function toBroadcast($notifiable){
    return [
        'title'=>'New order ',
        'body'=> 'A new order has been created (order #:)' .$this->ordar->number ,
        'icon'=>'',
        'url'=>url('/'),
        'time' => Carbon::now()->diffForHumans(),

    ];
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
