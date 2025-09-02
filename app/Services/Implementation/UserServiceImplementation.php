<?php

namespace App\Services\Implementation;

use App\Services\UserService;

class UserServiceImplementation implements UserService {
    private array $users = [
        "yusril" => "password"
    ];

    function login(string $user, string $password): bool {
        if(!isset($this->users[$user])) {
            return false;
        }

        $correctPassword = $this->users[$user];

        return $password == $correctPassword;
    }
}