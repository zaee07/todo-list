<?php
namespace App\Services\Impl;

use App\Services\UserService;

class UserServiceImpl implements UserService {

    private $users= [
        "ihza" => "rahasia"
    ];

    function login($user, $passwd): bool
    {
        // cek nana dari arr users
        if(!isset($this->users[$user])) {
        return false;
        }

        $correctPasswd = $this->users[$user];

        // compare
        return $passwd == $correctPasswd;
    }
}