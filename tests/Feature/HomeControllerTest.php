<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    // Test untuk memastikan guest (belum login) diarahkan ke halaman login
    public function testForGuest() {
        // Akses route "/" tanpa session user
        $this->get("/")
        // Pastikan diarahkan (redirect) ke halaman /login
        ->assertRedirect("/login");
    }

    // Test untuk memastikan member (sudah login) diarahkan ke halaman todolist
    public function testForMember() {
        // Simulasikan session dengan user "yusril"
        $this->withSession([
            "user" => "yusril",
        ])
        // Akses route "/"
        ->get("/")
        // Pastikan diarahkan (redirect) ke halaman /todolist
        ->assertRedirect("/todolist");
    }
}

