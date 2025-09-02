<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    // Deklarasi properti untuk menyimpan instance UserService
    private UserService $userService;

    // Method yang dijalankan sebelum setiap test
    protected function setUp(): void {
        // Panggil setUp parent untuk inisialisasi Laravel
        parent::setUp();

        // Ambil instance UserService dari container Laravel
        $this->userService = $this->app->make(UserService::class);
    }

    // Test login berhasil dengan username dan password benar
    public function testLoginSuccess() {
        // Pastikan login dengan user "yusril" dan password "password" mengembalikan true
        self::assertTrue($this->userService->login("yusril", "password"));
    }

    // Test login gagal ketika user tidak terdaftar
    public function testLoginFail() {
        // Pastikan login dengan user "ananda" yang tidak terdaftar mengembalikan false
        self::assertFalse($this->userService->login("ananda", "wrong"));
    }

    // Test login gagal ketika password salah
    public function testLoginWrongPassword() {
        // Pastikan login dengan user "yusril" tapi password salah mengembalikan false
        self::assertFalse($this->userService->login("yusril", "wrong"));
    }
}