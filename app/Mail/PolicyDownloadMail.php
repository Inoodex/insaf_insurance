<?php

namespace App\Mail;

use App\Models\InsuranceApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class PolicyDownloadMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $policyNumber;
    public $startDate;
    public $endDate;
    public $currency;
    public $amount;
    public $signedUrl;

    public function __construct(InsuranceApplication $application)
    {
        $application->loadMissing('student');

        $this->name = $application->student->full_name;
        $this->policyNumber = $application->policy_number;
        $this->startDate = $application->start_date->format('d M Y');
        $this->endDate = $application->end_date->format('d M Y');
        $this->currency = $application->currency;
        $this->amount = $application->premium_amount;
        $this->signedUrl = URL::temporarySignedRoute(
            'download-policy',
            now()->addDays(7),
            ['application' => $application->id]
        );
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Insurance Policy Document - ' . $this->policyNumber,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.student.policy-download',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
