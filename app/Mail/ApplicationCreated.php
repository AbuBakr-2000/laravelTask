<?php

namespace App\Mail;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationCreated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;


    public Application $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

//    public function build()
//    {
//        $mail = $this
//            ->from($this->application->user->name,$this->application->user->name)
//            ->subject('New Application Created')
//            ->view('emails.app-created');
//
//        if (!is_null($this->application->file_url))
//        {
//            $mail->attachFromStorageDisk('public', $this->application->file_url);
//        }
//
//        return $mail;
//    }

    public function envelope()
    {
        return new Envelope(
            from: new Address($this->application->user->email, $this->application->user->name),
            replyTo: [
                new Address('email@company.com', 'Manager'),
            ],
            subject: 'New Application Created',
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.app-created',
            with: [
                'Subject' => $this->application->subject,
            ],
        );
    }

    public function attachments()
    {
        return[
           Attachment::fromStorageDisk('public', $this->application->file_url),
        ];
    }
}
