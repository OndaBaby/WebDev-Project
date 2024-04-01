<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use App\Models\Order;

class SendOrderStatus extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

     public $order;
     public $shippingFee;
     public $totalOrder;

     public function __construct($order, $shippingFee, $totalOrder)
     {
         $this->order = $order;
         $this->shippingFee = $shippingFee;
         $this->totalOrder = $totalOrder;
     }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('electrokits@larashop.test', 'Adrian Philip Onda'),
            subject: 'Send Order Status',
        );
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     $total = $this->order->map(function ($product) {
    //         return $product->qty * $product->cost;
    //     });

    //     return new Content(
    //         view: 'email.order_status',
    //         with: [
    //             'order' => $this->order,
    //             'orderTotal' => $total->sum(),
    //         ]
    //     );
    // }

    public function content(): Content
    {
        $total = $this->order->map(function ($product) {
            return $product->qty * $product->cost;
        });

        return new Content(
            view: 'email.order_status',
            with: [
                'order' => $this->order,
                'orderTotal' => $total->sum(),
            ]
        );
    }


    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [Attachment::fromPath(public_path('storage/pdf/test.pdf')) ];
    }
}
