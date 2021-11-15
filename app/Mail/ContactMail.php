<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $request;
    public $users;

    /** Create a new message instance. ...*/
    public function __construct($request, $users)
    {
        $this->request = $request;
        $this->users = $users;
    }

    /** Build the message. ...*/
    public function build()
    {
        return $this->from('info@thevinylshop.com', 'The Vinyl Shop - Info')
            ->cc('info@thevinylshop.com', 'The Vinyl Shop - Info')
            ->subject('The Vinyl Shop - Contact Form')
            ->markdown('email.contact');
    }
}
