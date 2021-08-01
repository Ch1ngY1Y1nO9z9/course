<?php

namespace App\Mail;

use App\Courses;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Announce extends Mailable
{
    use Queueable, SerializesModels;

    protected $class_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($class_id)
    {
        $this->class_id = $class_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $class = Courses::find($this->class_id);
        return $this->subject($class->name_cn.'課程公告通知')->markdown('emails.Announce.AnnounceMessage')->with('class',$class);
    }
}
