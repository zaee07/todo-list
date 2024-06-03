<?php
namespace App\Services;

interface UserService{
    function login($user, $passwd): bool;
}