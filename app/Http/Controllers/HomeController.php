<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Method untuk menangani request ke halaman home
    public function home(Request $request): RedirectResponse {
        // Mengecek apakah session dengan key "user" sudah ada
        if($request->session()->exists("user")) {
            // Jika session user ada, redirect ke halaman todolist
            return redirect("/todolist");
        } else {
            // Jika session user tidak ada, redirect ke halaman login
            return redirect("/login");
        }
    }
}
