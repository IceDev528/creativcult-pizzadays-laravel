<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use \Carbon\Carbon;
class NewOrderNotifyLocation extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
     protected $order;
    public function __construct($order)
    {
       $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        //: mail , database, broadcast
        return ['database','broadcast'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
    public function toDatabase($notifiable='')
    {
        return [
            'invoice_id' => $this->order->id,
            'total' => $this->order->total,
            'user_id' => $this->order->user_id,
            'cart_id' => $this->order->cart_id,
            'method' => $this->order->method,
            'status' => $this->order->status,
            'date_delivery' => $this->order->date_delivery,
            'created_at' => $this->order->created_at,
            'user' => $this->order->user,
        ];
    }

    public function toBroadcast($notifiable)
    {

        return new BroadcastMessage([
            'invoice_id' => $this->order->id,
            'total' => $this->order->total,
            'user_id' => $this->order->user_id,
            'cart_id' => $this->order->cart_id,
            'method' => $this->order->method,
            'status' => $this->order->status,
            'date_delivery' => Carbon::createFromFormat('Y-m-d H:i',$this->order->date_delivery )->diffForHumans(Carbon::now('Europe/Berlin')),
            'date_refresh' => Carbon::createFromFormat('Y-m-d H:i',$this->order->date_delivery)->format('Y-m-d'),
            'created_at' => $this->order->created_at,
            'user' => $this->order->user,
        ]);
    }
}
