<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Forecast;

class ForecastMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $forecast;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Forecast $forecast)
    {
        $this->forecast = $forecast;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Vėjo prognozės pranešimas')->markdown('mail.forecast');

        /*return $this->from('mail@example.com', 'Mailtrap')
            ->subject('Mailtrap Confirmation')
            ->markdown('mails.exmpl')
            ->with([
                'name' => 'New Mailtrap User',
                'link' => 'https://mailtrap.io/inboxes'
            ]);*/
    }
}