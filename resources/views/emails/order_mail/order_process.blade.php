<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order in Process</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f2f4f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333;">
    <div style="max-width: 600px; margin: 40px auto; background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
        <div style="padding: 30px;">
            <h2 style="color: #2E8B57; font-size: 24px; margin-bottom: 10px;">
                Dear {{ $buyer_name }},
            </h2>

            <p style="font-size: 16px; line-height: 1.6; color: #444;">
                Your order is currently <strong>being processed</strong>. Thank you for shopping with us! We're preparing your items and will update you once they are on the way.
            </p>

            <div style="margin: 25px 0; padding: 15px; background-color: #f9f9f9; border-left: 5px solid #4CAF50;">
                <p style="margin: 0; font-size: 16px; color: #333;">
                    <strong>Estimated Delivery:</strong> {{ \Carbon\Carbon::parse($order_date)->format('d F Y') }}<br>
                    <strong>Total Amount:</strong> {{ $total }}
                </p>
            </div>

            <a href="{{ route('homepage') }}" style="display: inline-block; background-color: #4CAF50; color: #fff; text-decoration: none; padding: 12px 24px; border-radius: 5px; font-size: 16px; margin-top: 10px;">
                Continue Shopping
            </a>

            <p style="margin-top: 30px; font-size: 16px; color: #555;">
                If you have any questions, feel free to <a href="mailto:support@example.com" style="color: #4CAF50; text-decoration: none;">contact our support team</a>. We’re always here to help!
            </p>

            <p style="font-size: 16px; color: #555; margin-top: 30px;">
                Thank you for your trust and support.
            </p>
        </div>

        <div style="text-align: center; background-color: #f0f0f0; padding: 15px; font-size: 14px; color: #888;">
            &copy; 2025 Yaseen Ali. All rights reserved.
        </div>
    </div>
</body>
</html>
