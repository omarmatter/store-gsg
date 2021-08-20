<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Mail\OrderInvoice;
use App\Models\User;
use App\Notifications\OrderCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendInvoiceListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle( OrderCreated $event)
    {
        $order= $event->order;
    //    Mail::to($order->billing_email)->send(new OrderInvoice($order));

    $user =User::where('type' ,'super-admin')->first();
    $user->notify(new OrderCreatedNotification($order));
    }
}
