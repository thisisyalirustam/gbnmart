<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Return Request</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f2f4f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333;">
    <div style="max-width: 600px; margin: 40px auto; background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
        <div style="padding: 30px;">
            <h2 style="color: #d9534f; font-size: 24px; margin-bottom: 10px;">
                Hello {{ $buyerName }},
            </h2>

            <p style="font-size: 16px; line-height: 1.6; color: #444;">
                We’ve received your <strong>return request</strong> for the order placed on 
                <strong>{{ \Carbon\Carbon::parse($orderDate)->format('d F Y') }}</strong>. We're here to help you with the next steps.
            </p>

            <div style="margin: 25px 0; padding: 15px; background-color: #f9f9f9; border-left: 5px solid #d9534f;">
                <p style="margin: 0; font-size: 16px; color: #333;">
                    <strong>Order Total:</strong> {{ $total }}<br>
                    <strong>Return Requested For:</strong> {{ $buyerName }}, {{ $buyerAddress }}<br>
                    <strong>Contact:</strong> {{ $buyerPhone }} / {{ $buyerEmail }}
                </p>
            </div>

            <p style="font-size: 16px; line-height: 1.6; color: #444;">
                Please ensure the items are unused, in original packaging, and returned within <strong>7 days</strong> of receiving this email. Once we receive the returned items, we’ll initiate your refund or replacement as per your selection.
            </p>

            <a href="" style="display: inline-block; background-color: #d9534f; color: #fff; text-decoration: none; padding: 12px 24px; border-radius: 5px; font-size: 16px; margin-top: 10px;">
                View Return Policy
            </a>

            <p style="margin-top: 30px; font-size: 16px; color: #555;">
                If you have any questions or concerns, feel free to <a href="mailto:{{ settings()->email }}" style="color: #d9534f; text-decoration: none;">contact our support team</a>. We're happy to assist you!
            </p>

            <p style="font-size: 16px; color: #555; margin-top: 30px;">
                Thank you for shopping with us.
            </p>
        </div>

        <div style="text-align: center; background-color: #f0f0f0; padding: 15px; font-size: 14px; color: #888;">
            &copy; 2025 Yaseen Ali. All rights reserved.
        </div>
    </div>
</body>
</html>
