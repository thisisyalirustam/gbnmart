<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Request Received</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f2f4f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333;">
    <div style="max-width: 600px; margin: 40px auto; background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
        <div style="padding: 30px;">
            <h2 style="color: #d9534f; font-size: 24px; margin-bottom: 10px;">
                New Return Request Received
            </h2>

            <p style="font-size: 16px; line-height: 1.6; color: #444;">
                A customer has submitted a return request. Below are the details:
            </p>

            <div style="margin: 20px 0; padding: 15px; background-color: #f9f9f9; border-left: 5px solid #d9534f;">
                <p style="margin: 0; font-size: 16px; color: #333;">
                    <strong>Customer Name:</strong> {{ $buyerName }}<br>
                    <strong>Email:</strong> {{ $buyerEmail }}<br>
                    <strong>Phone:</strong> {{ $buyerPhone }}<br>
                    <strong>Address:</strong> {{ $buyerAddress }}<br>
                    <strong>Order Date:</strong> {{ \Carbon\Carbon::parse($orderDate)->format('d F Y') }}<br>
                    <strong>Total Amount:</strong> {{ $total }}
                </p>
            </div>

            <p style="font-size: 16px; color: #444;">
                Please log in to the admin panel to review and process the return request.
            </p>

            <a href="{{ route('order.all') }}" style="display: inline-block; background-color: #d9534f; color: #fff; text-decoration: none; padding: 12px 24px; border-radius: 5px; font-size: 16px;">
                View Return Requests
            </a>

            <p style="margin-top: 30px; font-size: 16px; color: #555;">
                This is an automated message from your store.
            </p>
        </div>

        <div style="text-align: center; background-color: #f0f0f0; padding: 15px; font-size: 14px; color: #888;">
            &copy; 2025 Yaseen Ali. All rights reserved.
        </div>
    </div>
</body>
</html>
