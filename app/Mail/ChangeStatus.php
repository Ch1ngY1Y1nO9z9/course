<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChangeStatus extends Mailable
{
    use Queueable, SerializesModels;

    protected $class;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->class->name_cn.'課程備取轉正通知')->markdown('emails.signup.changeStatus')->with('class',$this->class);
    }
}
