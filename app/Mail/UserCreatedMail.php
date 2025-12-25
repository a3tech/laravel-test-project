<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;

class UserCreatedMail extends Mailable
{
    public function __construct(public User $user) {}

    public function build()
    {
        return $this->subject('Account Created')
            ->view('emails.user_created');
    }
}