<?php

namespace App\Services\Implementation;

use App\Services\UserService;

class UserServiceImplementation implements UserService {

    // Array untuk menyimpan daftar user dan password (sebagai contoh statis)
    private array $users = [
        "yusril" => "password" // username => password
    ];

    // Method untuk melakukan proses login
    function login(string $user, string $password): bool {
        // Cek apakah username ada dalam daftar users
        if (!isset($this->users[$user])) {
            // Jika tidak ada, login gagal
            return false;
        }

        // Ambil password yang benar untuk username tersebut
        $correctPassword = $this->users[$user];

        // Bandingkan password yang dimasukkan dengan password yang benar
        return $password == $correctPassword;
    }
}