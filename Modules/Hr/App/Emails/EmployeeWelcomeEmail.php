<?php

namespace Modules\Hr\App\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;

class EmployeeWelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function content(): Content
    {
        return new Content(
            view: 'hr::emails.employee_welcome_email',
        );
    }

    public function build()
    {
        return $this->subject('Welcome to the Team!')
                ->view('hr::emails.employee_welcome_email');
    }
}