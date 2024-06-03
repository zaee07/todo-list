<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\UserService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserServiceTest extends TestCase
{
    private Userservice $userService;

    protected function setUp(): void {
        parent::setUp();

        $this->userService = $this->app->make(UserService::class);
    }

    public function testLoginSuccess() {
        self::assertTrue($this->userService->login("ihza", "rahasia"));
    }

    public function tesLoginUserNotFound() {
        self::assertFalse($this->userService->login("kopi", "rahasia"));
    }

    public function tesLoginWrongPasswd() {
        self::assertFalse($this->userService->login("ihza", "secret"));
    }
}
