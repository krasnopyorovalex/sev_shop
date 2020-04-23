<?php

namespace App\Mail;

use Domain\Catalog\Requests\CheckoutCartRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class CheckoutCartSent
 * @package App\Mail
 */
class CheckoutCartSent extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    /**
     * OrderServiceSent constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return CheckoutCartSent
     */
    public function build(): CheckoutCartSent
    {
        return $this->from('bani.crimea@yandex.ru')
            ->subject('Форма: Оформление заказа')
            ->view('emails.checkout_cart', [
                'data' => $this->data
            ]);
    }
}
