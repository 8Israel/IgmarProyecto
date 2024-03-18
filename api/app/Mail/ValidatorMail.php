<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ValidatorMail extends Mailable
{
    use Queueable, SerializesModels;
    public $signedroute;

    public function __construct($signedroute)
    {
        $this->signedroute=$signedroute;
        $this->subject('Activa tu cuenta');
        
    }
    public function envelope(){
        return new Envelope(
            subject: 'Validator Mail'
        );
    }
    public function content()
    {
        return new Content(
            view: 'mails.validate'
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
