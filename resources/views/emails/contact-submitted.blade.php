<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Thank you for contacting me!</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #27ae60; color: white; padding: 20px; text-align: center; }
        .content { background: #f9f9f9; padding: 20px; }
        .footer { background: #2c3e50; color: white; padding: 15px; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Thank You for Your Message!</h2>
        </div>
        
        <div class="content">
            <p>Dear {{ $contact->name }},</p>
            
            <p>Thank you for reaching out to me through my portfolio website. I have received your message and will get back to you as soon as possible.</p>
            
            <p><strong>Your message details:</strong></p>
            <ul>
                <li><strong>Subject:</strong> {{ $contact->subject }}</li>
                <li><strong>Sent:</strong> {{ $contact->created_at->format('M d, Y H:i A') }}</li>
            </ul>
            
            <p>I typically respond to messages within 24-48 hours. If your inquiry is urgent, please feel free to call me directly at +977 9752275229.</p>
            
            <p>Best regards,<br>
            <strong>Geeta Kuikel Neupane</strong><br>
            Faculty at Merryland College<br>
            kuikelgeeta6@gmail.com</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Geeta Kuikel Neupane Portfolio</p>
        </div>
    </div>
</body>
</html>
