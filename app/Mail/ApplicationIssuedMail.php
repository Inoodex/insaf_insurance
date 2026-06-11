<?php

namespace App\Mail;

use App\Models\InsuranceApplication;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
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
        $application = $this->application;
        $application->loadMissing(['student', 'plan', 'benefitCoverages']);

        $pdf = Pdf::loadView('student.policies.pdf', compact('application'));

        return [
            Attachment::fromData(fn () => $pdf->output(), 'Policy-' . $application->policy_number . '.pdf'),
        ];
    }
}
