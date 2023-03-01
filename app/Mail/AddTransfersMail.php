<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AddTransfersMail extends Mailable
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
        ->view('admin.emails.add-transfer-email')
        ->with([
            'transfer_date' => $this->data['message']['transfer_date'],
            'currency_symbol' => $this->data['currency_symbol'],
            'amount' => $this->data['message']['amount'],
        ]);
       
    }
}
