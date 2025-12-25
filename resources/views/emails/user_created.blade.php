<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Account Created</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
    <h2>Hello {{ $user->name }},</h2>

    <p>
        Your account has been successfully created.
    </p>

    <p>
        <strong>Email:</strong> {{ $user->email }}
    </p>

    <p>
        You can now log in and start using our system.
    </p>

    <p>
        Thank you,<br>
        <strong>The Team</strong>
    </p>
</body>
</html>