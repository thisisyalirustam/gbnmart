<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Your Purchase</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; background-color: #f7f7f7; margin: 0; padding: 0;">
    <div style="width: 100%; max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h1 style="color: #4CAF50; font-size: 24px; margin-bottom: 10px;">Thank You for Your Purchase!</h1>
        <p style="font-size: 16px; line-height: 1.6; color: #555;">We hope you're enjoying your new product. Your opinion is important to us, and we'd love to hear your feedback to help us improve our service.</p>
        
        <p style="font-size: 16px; line-height: 1.6; color: #555;">Please take a moment to share your experience by leaving a review:</p>
        
        <a href="{{ $reviewLink }}" style="background-color: #4CAF50; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-size: 16px; text-align: center; display: inline-block; margin-top: 20px;">
            Review Your Order
        </a>

        <p style="font-size: 16px; line-height: 1.6; color: #555;">If the button above doesn't work, you can copy and paste the link below into your browser:</p>
        <p><a href="{{ $reviewLink }}" style="color: #4CAF50; text-decoration: none;">{{ $reviewLink }}</a></p>
        
        <p style="font-size: 16px; line-height: 1.6; color: #555;">Thank you for your time and support!</p>

        <div style="text-align: center; margin-top: 40px; font-size: 14px; color: #999;">
            <p>If you need any assistance, feel free to <a href="mailto:support@example.com" style="color: #4CAF50; text-decoration: none;">contact us</a>.</p>
            <p>&copy; 2025 Your Company Name. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
