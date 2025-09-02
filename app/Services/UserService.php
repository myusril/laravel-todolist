<?php

namespace App\Services;

interface UserService {

    // Method untuk melakukan proses login dengan username dan password
    public function login(string $user, string $password);
}