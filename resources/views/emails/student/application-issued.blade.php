<!DOCTYPE html>
<html>
<head><meta charset="utf-8"></head>
<body style="font-family: monospace; font-size: 14px; line-height: 1.6; color: #000; margin: 0; padding: 20px;">
    <pre style="font-family: monospace; font-size: 14px; line-height: 1.6; margin: 0;">
SWISSCARE | Payment Receipt

--Transaction Information--
Merchant:           Swisscare
Amount:            {{ sprintf('%-8s', number_format((float) $amount, 2)) }}€ EUR
Transaction Date:   {{ $date }}
Tax Exempt:         no
Authorization Code: {{ $authCode }}
Status:             Submitted For Settlement


--Payment Information--
Card Type:          Visa
Credit Card Ends With: {{ $cardLastFour }}


--Customer Information--
Name:               {{ $name }}
Email:              {{ $email }}
Phone:              {{ $phone }}
    </pre>
</body>
</html>
