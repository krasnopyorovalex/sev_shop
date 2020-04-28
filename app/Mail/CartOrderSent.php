<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class CartOrderSent
 * @package App\Mail
 */
class CartOrderSent extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    /**
     * CartOrderSent constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return CartOrderSent
     */
    public function build(): CartOrderSent
    {
        return $this->subject('Форма: Оформление заказа на сайте')
            ->view('emails.cart-order', [
                'data' => $this->data
            ]);
    }
}
