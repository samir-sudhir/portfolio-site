<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
</head>
<body style="font-family: Arial, sans-serif;">
    <h2>New Contact Form Submission</h2>
    <p><strong>First Name:</strong> {{ $contact->first_name }}</p>
    <p><strong>Last Name:</strong> {{ $contact->last_name }}</p>
    <p><strong>Email:</strong> {{ $contact->email }}</p>
    <p><strong>Phone Number:</strong> {{ $contact->phone_number }}</p>
    <p><strong>Company:</strong> {{ $contact->company ?? 'N/A' }}</p>
    <p><strong>Country:</strong> {{ $contact->country }}</p>
    <p><strong>Message:</strong></p>
    <blockquote style="background-color: #f9f9f9; padding: 10px; border-left: 5px solid #ccc;">
        {{ $contact->message }}
    </blockquote>
    <p>Thank you!</p>
</body>
</html>
