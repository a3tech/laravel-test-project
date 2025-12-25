<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New User Registered</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
    <h2>New User Registration</h2>

    <p>
        A new user has just registered in the system.
    </p>

    <ul>
        <li><strong>Name:</strong> {{ $user->name }}</li>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>Role:</strong> {{ $user->role }}</li>
        <li><strong>Registered At:</strong> {{ $user->created_at }}</li>
    </ul>

    <p>
        Please review the account if necessary.
    </p>
</body>
</html>