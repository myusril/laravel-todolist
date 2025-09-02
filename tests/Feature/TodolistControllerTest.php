<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    // Test untuk menampilkan daftar todolist yang sudah ada di session
    public function testTodolist() {
        // Simulasikan session dengan user dan 2 item todolist
        $this->withSession([
            "user" => "Yusril",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Yusril"
                ],
                [
                    "id" => "2",
                    "todo" => "Ananda"
                ]
            ]
        ])
        // Akses route /todolist
        ->get("/todolist")
        // Pastikan halaman menampilkan ID dan todo yang sesuai
        ->assertSeeText("1")
        ->assertSeeText("Yusril")
        ->assertSeeText("2")
        ->assertSeeText("Ananda");
    }

    // Test untuk menambahkan todo gagal karena input kosong
    public function testAddTodoFailed() {
        // Simulasikan session user login
        $this->withSession([
            "user" => "yusril"
        ])
        // Kirim POST request ke /todolist tanpa data todo
        ->post("/todolist", [])
        // Pastikan muncul pesan error
        ->assertSeeText("Todo is required");
    }

    // Test untuk menambahkan todo berhasil
    public function testAddTodoSuccess() {
        // Simulasikan session user login
        $this->withSession([
            "user" => "yusril"
        ])
        // Kirim POST request ke /todolist dengan data todo
        ->post("/todolist", [
            "todo" => "Yusril"
        ])
        // Pastikan diarahkan ke halaman /todolist
        ->assertRedirect("/todolist");
    }

    // Test untuk menghapus salah satu item todolist
    public function testDeleteTodolist() {
        // Simulasikan session dengan user dan 2 item todolist
        $this->withSession([
            "user" => "Yusril",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Yusril"
                ],
                [
                    "id" => "2",
                    "todo" => "Ananda"
                ]
            ]
        ])
        // Kirim POST request untuk menghapus todo dengan ID 1
        ->post("/todolist/1/delete")
        // Pastikan diarahkan kembali ke halaman /todolist
        ->assertRedirect("/todolist");
    }
}