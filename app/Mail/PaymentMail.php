<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Payment Request Assigned to You')
        ->view('email.action')
        ->attach(public_path('/assets/invoices/' . $this->details->invoice) , ['as' => $this->details->invoice])
        ->attach(public_path('/assets/prf/' . $this->details->prf) , ['as' => $this->details->prf]);
    }
}
