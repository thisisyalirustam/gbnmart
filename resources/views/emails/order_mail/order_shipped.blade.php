<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Shipped</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f2f4f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333;">
    <div style="max-width: 600px; margin: 40px auto; background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
        <div style="padding: 30px;">
            <h2 style="color: #2E8B57; font-size: 24px; margin-bottom: 10px;">
                Dear {{ $buyerName }},
            </h2>

            <p style="font-size: 16px; line-height: 1.6; color: #444;">
                Great news! Your order has been <strong>shipped</strong> and is on its way to you. 🎉
            </p>

            <div style="margin: 25px 0; padding: 15px; background-color: #f9f9f9; border-left: 5px solid #4CAF50;">
                <p style="margin: 0; font-size: 16px; color: #333;">
                    <strong>Estimated Delivery:</strong> {{ \Carbon\Carbon::parse($orderDate)->addDays(3)->format('d F Y') }}<br>
                    <strong>Total Amount:</strong> {{ $total }}<br>
                    <strong>Shipping To:</strong> {{ $buyerName }}, {{ $buyerAddress }}<br>
                    <strong>Contact:</strong> {{ $buyerPhone }} / {{ $buyerEmail }}
                </p>
            </div>

            <a href="{{ route(name: 'homepage') }}" style="display: inline-block; background-color: #4CAF50; color: #fff; text-decoration: none; padding: 12px 24px; border-radius: 5px; font-size: 16px; margin-top: 10px;">
                Track Your Order
            </a>

            <p style="margin-top: 30px; font-size: 16px; color: #555;">
                If you have any questions, feel free to <a href="{{ settings()->email }}" style="color: #4CAF50; text-decoration: none;">contact our support team</a>. We’re always here to help!
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
