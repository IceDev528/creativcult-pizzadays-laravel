<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Order;

class OrderConfirmedEmail extends Mailable
{
    use Queueable, SerializesModels;
        protected $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content)
    {
         $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $content=$this->content;
          return $this->markdown('emails.orders.OrderInvoice')
                        ->attach(public_path().'/upload/invoice/'.$content['invoice'].'.pdf', [
                                'mime' => 'application/pdf',
                            ])
                        ->with('content', $content);
    }
}
