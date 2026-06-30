<!DOCTYPE html>
<html>
<head><meta charset="utf-8"></head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 1.6; color: #333; margin: 0; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 30px;">
            <img src="{{ $message->embed(public_path('assets/images/swisscare_logo2.png')) }}" alt="SWISSCARE" style="max-height: 50px;">
        </div>

        <p>Dear, <strong>{{ $name }}</strong></p>

        <p>Your insurance policy has been issued. You can download your policy document below.</p>

        <div style="background: #f5f5f5; padding: 15px; border-radius: 8px; margin: 20px 0;">
            <p style="margin: 0 0 5px 0;"><strong>Policy Number:</strong> {{ $policyNumber }}</p>
            <p style="margin: 0 0 5px 0;"><strong>Coverage Period:</strong> {{ $startDate }} — {{ $endDate }}</p>
            <p style="margin: 0;"><strong>Premium:</strong> {{ $currency }} {{ number_format((float) $amount, 2) }}</p>
        </div>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ $signedUrl }}" style="display: inline-block; padding: 12px 30px; background-color: #4A3B75; color: #fff; text-decoration: none; border-radius: 6px; font-weight: bold;">
                Download Your Document Now
            </a>
        </div>

        <p style="color: #999; font-size: 12px; margin-top: 30px; border-top: 1px solid #eee; padding-top: 15px;">
            <strong>Need help?</strong> If you have any questions about your policy, please contact our support team.
        </p>
    </div>
</body>
</html>
