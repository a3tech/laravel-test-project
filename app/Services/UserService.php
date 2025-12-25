<?php

namespace App\Services;

use App\Mail\AdminNewUserMail;
use App\Mail\UserCreatedMail;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserService
{
    public function __construct(
        private UserRepository $userRepository
    ) {}

    public function create(array $data): User
    {
        return DB::transaction(function () use ($data) {

            $data['password'] = bcrypt($data['password']);
            $data['role'] = $data['role'] ?? 'user';

            $user = $this->userRepository->create($data);

            Mail::to($user->email)->send(new UserCreatedMail($user));
            Mail::to(config('mail.admin_email'))->send(
                new AdminNewUserMail($user)
            );

            return $user;
        });
    }
}
