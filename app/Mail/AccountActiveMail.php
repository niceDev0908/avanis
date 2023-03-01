<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountActiveMail extends Mailable
{
    use Queueable, SerializesModels;

    public $active_data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($active_data)
    {   
        $this->active_data = $active_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->active_data['subject'] , $this->active_data['body'],$this->active_data['message'])->view('admin.emails.account-activate-email');
    }
}
