<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session as FacadesSession;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{
    // Properti untuk menyimpan instance TodolistService
    private TodolistService $todolistService;

    // Method setup yang dijalankan sebelum setiap test
    protected function setUp(): void {
        parent::setUp();

        // Ambil instance TodolistService dari service container Laravel
        $this->todolistService = $this->app->make(TodolistService::class);
    }

    // Test memastikan TodolistService tidak null
    public function testTodolistNotNull() {
        self::assertNotNull($this->todolistService);
    }

    // Test menyimpan todo ke session
    public function testSaveTodo() {
        // Simpan todo dengan ID 1 dan teks "Yusril"
        $this->todolistService->saveTodo("1", "Yusril");

        // Ambil todolist dari session
        $todoList = FacadesSession::get("todolist");

        // Pastikan ID dan todo sesuai dengan data yang disimpan
        foreach ($todoList as $value) {
            self::assertEquals("1", $value["id"]);
            self::assertEquals("Yusril", $value["todo"]);
        }
    }

    // Test mengambil todolist ketika kosong
    public function testGetTodoListEmpty() {
        // Pastikan hasilnya adalah array kosong
        self::assertEquals([], $this->todolistService->getTodoList());
    }

    // Test mengambil todolist ketika sudah ada data
    public function testGetTodoListNotEmpty() {
        // Data yang diharapkan
        $expected = [
            [
                "id" => "1",
                "todo" => "Yusril",
            ],
            [
                "id" => "2",
                "todo" => "Ananda",
            ]
        ];

        // Simpan 2 todo ke session
        $this->todolistService->saveTodo("1", "Yusril");
        $this->todolistService->saveTodo("2", "Ananda");

        // Pastikan hasil getTodoList sesuai dengan data yang diharapkan
        self::assertEquals($expected, $this->todolistService->getTodoList());
    }

    // Test menghapus todo berdasarkan ID
    public function testRemoveTodo() {
        // Simpan 2 todo
        $this->todolistService->saveTodo("1", "Yusril");
        $this->todolistService->saveTodo("2", "Ananda");

        // Pastikan jumlah todo = 2
        self::assertEquals(2, sizeof($this->todolistService->getTodoList()));

        // Coba hapus ID yang tidak ada
        $this->todolistService->deleteTodo("3");

        // Pastikan jumlah tetap 2 (tidak berubah)
        self::assertEquals(2, sizeof($this->todolistService->getTodoList()));

        // Hapus todo dengan ID 1
        $this->todolistService->deleteTodo("1");

        // Pastikan jumlah sekarang = 1
        self::assertEquals(1, sizeof($this->todolistService->getTodoList()));

        // Hapus todo dengan ID 2
        $this->todolistService->deleteTodo("2");

        // Pastikan sekarang todolist kosong
        self::assertEquals(0, sizeof($this->todolistService->getTodoList()));
    }
}