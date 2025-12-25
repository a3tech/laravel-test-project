<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(
        private UserService $userService,
        private UserRepository $userRepository
    ) {}

    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->create(
            $request->validated()
        );

        return response()->json([
            'id'         => $user->id,
            'email'      => $user->email,
            'name'       => $user->name,
            'created_at' => $user->created_at,
        ], 201);
    }

    public function index(Request $request)
    {
        $users = $this->userRepository->getActiveUsers(
            $request->only(['search', 'sortBy'])
        );

        return response()->json([
            'page' => $users->currentPage(),
            'users' => UserResource::collection($users)
        ]);
    }
}
