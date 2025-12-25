<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\JsonResponse;
use Mockery;
use App\Http\Controllers\UserController;
use App\Http\Requests\StoreUserRequest;
use App\Services\UserService;
use App\Repositories\UserRepository;
use App\Models\User;
use Carbon\Carbon;

class UserControllerTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /** @test */
    public function it_creates_user_and_returns_json_response()
    {
        // Arrange
        $userService = Mockery::mock(UserService::class);
        $userRepository = Mockery::mock(UserRepository::class);

        $controller = new UserController($userService, $userRepository);

        $payload = [
            'email' => 'annas@test.com',
            'name' => 'Annas',
            'password' => 'secret123',
        ];

        $user = new User([
            'id' => 1,
            'email' => 'annas@test.com',
            'name' => 'Annas',
            'created_at' => Carbon::now(),
        ]);

        // Mock StoreUserRequest
        $request = Mockery::mock(StoreUserRequest::class);
        $request->shouldReceive('validated')
            ->once()
            ->andReturn($payload);

        $userService
            ->shouldReceive('create')
            ->once()
            ->with($payload)
            ->andReturn($user);

        // Act
        $response = $controller->store($request);

        // Assert
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(201, $response->status());

        $data = $response->getData(true);

        $this->assertEquals('annas@test.com', $data['email']);
        $this->assertEquals('Annas', $data['name']);
    }

}