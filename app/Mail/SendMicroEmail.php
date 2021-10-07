<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMicroEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $mail_content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail_content)
    {

        $this->mail_content = $mail_content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->subject($this->mail_content->title)->markdown('emails.micro.email')->with('mail_content',$this->mail_content);
    }
}
