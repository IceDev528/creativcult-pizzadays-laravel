<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Messages\SlackMessage;
class ResetPassword extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $token;
    public function __construct($token) {
     $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {   
        // slack
         return $notifiable->prefers_sms ? ['nexmo','mail'] : ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('password/reset/'.$this->token);
        return (new MailMessage)
                     ->greeting('Hello! '.$notifiable->first_name .' '.$notifiable->last_name)
                    ->line('You are receiving this email because we received a password reset request for your account.')
                    ->action('Reset Password', route('password.reset', $this->token))
                    ->line('If you did not request a password reset, no further action is required.');
    }

    public function toNexmo($notifiable){
            $url = url('password/reset/'.$this->token);
            return (new NexmoMessage)
                ->content('You are receiving this email because we received a password reset request for your account. You can reset your password on this link: '.route('password.reset', $this->token));
    }
    public function toSlack($notifiable)
    {
        return (new SlackMessage)
                ->from('Send to Slack')
                ->image('http://www.sibehet.com/wp-content/uploads/2017/02/Panine-te-mbushura-me-lakra.-Receta-gatimi.1.jpg')
                ->content('test slak message rest api by pizza days');
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
