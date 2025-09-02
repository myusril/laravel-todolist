<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller {
    // Deklarasi properti untuk UserService
    private UserService $userService;

    // Constructor untuk menginisialisasi UserService
    public function __construct(UserService $userService) {
        // Simpan instance UserService ke properti $userService
        $this->userService = $userService;
    }

    // Method untuk menampilkan halaman login
    public function login(): Response {
        // Mengembalikan view "user.login" dengan title "Login"
        return response()
        ->view("user.login", [
            "title" => "Login"
        ]);
    }

    // Method untuk memproses login user
    public function doLogin(Request $request): Response | RedirectResponse {
        // Ambil input username dari request
        $user = $request->input('user');
        // Ambil input password dari request
        $password = $request->input('password');

        // Jika username atau password kosong
        if (empty($user) || empty($password)) {
            // Kembalikan view login dengan pesan error
            return response()->view("user.login", [
                "title" => "Login",
                "error" => "User or password is required"
            ]);
        }

        // Jika login berhasil (validasi melalui UserService)
        if ($this->userService->login($user, $password)) {
            // Simpan user ke session
            $request->session()->put("user", $user);
            
            // Redirect ke halaman home
            return redirect("/");
        }

        // Jika login gagal, tampilkan kembali halaman login dengan pesan error
        return response()->view("user.login", [
            "title"=> "Login",
            "error"=> "User or password wrong"
        ]);
    }

    // Method untuk memproses logout user
    public function doLogout(Request $request): RedirectResponse {
        // Hapus data user dari session
        $request->session()->forget("user");

        // Redirect ke halaman home setelah logout
        return redirect("/");
    }
}

