<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

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
        return ['mail','database','broadcast'];
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
        'url'=>url('/')

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
