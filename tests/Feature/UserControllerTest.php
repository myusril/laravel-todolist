<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    // Test menampilkan halaman login
    public function testLoginPage() {
        // Akses route /login
        $this->get("/login")
        // Pastikan halaman menampilkan teks "Login"
        ->assertSeeText("Login");
    }

    // Test ketika user sudah login dan mengakses halaman login
    public function testLoginForMember() {
        // Simulasikan session user sudah login
        $this->withSession([
            "user" => "yusril"
        ])
        // Akses route /login
        ->get("/login")
        // Pastikan diarahkan ke halaman home (/)
        ->assertRedirect("/");
    }

    // Test login berhasil
    public function testLoginSuccess() {
        // Kirim POST request ke /login dengan user dan password benar
        $this->post("/login", [
            "user" => "yusril",
            "password" => "password"
        ])
        // Pastikan diarahkan ke halaman home (/)
        ->assertRedirect("/")
        // Pastikan session menyimpan user "yusril"
        ->assertSessionHas("user", "yusril");
    }

    // Test login ketika user sudah login sebelumnya
    public function testLoginForUserAlreadyLogin() {
        // Simulasikan session user sudah login
        $this->withSession([
            "user" => "yusril",
        ])
        // Kirim POST request ke /login dengan data login
        ->post("/login", [
            "user" => "yusril",
            "password" => "password"
        ])
        // Pastikan diarahkan ke halaman home (/)
        ->assertRedirect("/");
    }

    // Test validasi login gagal karena input kosong
    public function testLoginValidationError() {
        // Kirim POST request ke /login tanpa data
        $this->post("/login", [])
        // Pastikan muncul pesan error validasi
        ->assertSeeText("User or password is required");
    }

    // Test login gagal karena password salah
    public function testLoginFailed() {
        // Kirim POST request dengan user benar tetapi password salah
        $this->post("/login", [
            "user" => "ananda",
            "password" => "wrong"
        ])
        // Pastikan muncul pesan error login gagal
        ->assertSeeText("User or password wrong");
    }

    // Test logout berhasil
    public function testLogout() {
        // Simulasikan session user sudah login
        $this->withSession([
            "user" => "yusril"
        ])
        // Kirim POST request ke /logout
        ->post("/logout")
        // Pastikan diarahkan ke halaman home (/)
        ->assertRedirect("/")
        // Pastikan session user dihapus
        ->assertSessionMissing("user");
    }

    // Test logout untuk guest (belum login)
    public function testLogoutForGuest() {
        // Kirim POST request ke /logout tanpa session user
        $this->post("/logout")
        // Pastikan diarahkan ke halaman home (/)
        ->assertRedirect("/");
    }
}