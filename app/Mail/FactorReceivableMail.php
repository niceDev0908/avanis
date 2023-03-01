<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FactorReceivableMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->data['subject'] , $this->data['body'])
        ->view('admin.emails.factor-receivable-email')
        ->with([
            'receivable_date' => $this->data['message']['receivable_date'],
            'amount' => $this->data['message']['amount'],
        ]);
       
    }
}
