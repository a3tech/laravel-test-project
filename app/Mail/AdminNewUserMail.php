<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;

class AdminNewUserMail extends Mailable
{
    public function __construct(public User $user) {}

    public function build()
    {
        return $this->subject('New User Registered')
            ->view('emails.admin_new_user');
    }
}