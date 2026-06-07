<?php

namespace App\Mail;

use App\Models\InsuranceApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationIssuedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $application;

    public function __construct(InsuranceApplication $application)
    {
        $this->application = $application;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Insurance Policy ' . $this->application->policy_number . ' Has Been Issued',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.student.application-issued',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
