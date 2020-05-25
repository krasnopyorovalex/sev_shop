<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class ConsultationSent
 * @package App\Mail
 */
class ConsultationSent extends Mailable
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
     * @return ConsultationSent
     */
    public function build(): ConsultationSent
    {
        return $this->subject('Форма: консультация')
            ->view('emails.consultation', [
                'data' => $this->data
            ]);
    }
}
