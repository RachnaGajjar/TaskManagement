<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EditEmployeeMail extends Mailable
{
    use Queueable, SerializesModels;
    public $EditEmployee;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($EditEmployee)
    {
        //
        $this->EditEmployee = $EditEmployee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.employee_edited');
    }
}
