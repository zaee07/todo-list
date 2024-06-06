<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage() {
        $this->get('/login')->assertSeeText('Login Page');
    }

    public function testLoginForMember() {
        $this->withSession([
            'user'=> 'ihza'
            ])->get('/login')->assertRedirect('/');
    }

    public function testLoginSuccess() {
        $this->post('/login',
        [
           'user' => "ihza",
           'password' => "rahasia" 
        ])->assertRedirect('/')->assertSessionHas("user", "ihza");
    }

    public function testAlreadyLogin() {
        $this->withSession([
            'user' => 'ihza'])
        ->post('/login',
        [
           'user' => "ihza",
           'password' => "rahasia" 
        ])->assertRedirect('/')->assertSessionHas("user", "ihza");
    }

    public function testLoginValidationErr() {
        $this->post('/login', [])->assertSeeText('user or password is required');
    }

    public function testLoginFailed() {
        $this->post('login',
        [
            'user' => 'i',
            'password' => 'o'
            ])->assertSeeText('user or password is wrong');
    }

    public function testLogout() {
        $this->withSession([
            "user" => "ihza"
            ])->post('/logout')
                ->assertRedirect('/')->assertSessionMissing('user');
    }
}
