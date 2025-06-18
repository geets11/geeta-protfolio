<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Form Submission</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #3498db; color: white; padding: 20px; text-align: center; }
        .content { background: #f9f9f9; padding: 20px; }
        .footer { background: #2c3e50; color: white; padding: 15px; text-align: center; }
        .info-box { background: white; padding: 15px; margin: 10px 0; border-left: 4px solid #3498db; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Contact Form Submission</h2>
        </div>
        
        <div class="content">
            <p>You have received a new message through your portfolio contact form.</p>
            
            <div class="info-box">
                <strong>Name:</strong> {{ $contact->name }}
            </div>
            
            <div class="info-box">
                <strong>Email:</strong> {{ $contact->email }}
            </div>
            
            <div class="info-box">
                <strong>Subject:</strong> {{ $contact->subject }}
            </div>
            
            <div class="info-box">
                <strong>Message:</strong><br>
                {!! nl2br(e($contact->message)) !!}
            </div>
            
            <div class="info-box">
                <strong>Received:</strong> {{ $contact->created_at->format('M d, Y H:i A') }}
            </div>
            
            <p>
                <a href="{{ route('admin.contacts.show', $contact) }}" style="background: #3498db; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
                    View in Admin Panel
                </a>
            </p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Geeta Kuikel Neupane Portfolio</p>
        </div>
    </div>
</body>
</html>
