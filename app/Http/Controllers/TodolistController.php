<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    // Deklarasi properti untuk service todolist
    private TodolistService $todolistService;

    // Constructor untuk menginisialisasi TodolistService
    public function __construct(TodolistService $todolistService) {
        $this->todolistService = $todolistService;
    }

    // Method untuk menampilkan halaman daftar todolist
    public function indexTodo(Request $request) {
        // Ambil data todolist dari service
        $todolist = $this->todolistService->getTodoList();

        // Tampilkan view "todolist.index-todolist" dengan data todolist dan title
        return response()->view("todolist.index-todolist", [
            "title" => "Todolist",
            "todolist" => $todolist
        ]);
    }

    // Method untuk menambahkan todo baru
    public function addTodo(Request $request) {
        // Ambil input "todo" dari request
        $todo = $request->input("todo");

        // Jika input todo kosong
        if(empty($todo)) {
            // Ambil kembali data todolist dari service
            $todolist = $this->todolistService->getTodoList();
            
            // Kembalikan view dengan pesan error "Todo is required"
            return response()->view("todolist.index-todolist", [
                "title" => "Todolist",
                "todolist" => $todolist,
                "error" => "Todo is required"
            ]);
        }

        // Jika input tidak kosong, simpan todo baru dengan ID unik
        $this->todolistService->saveTodo(uniqid(), $todo);

        // Redirect kembali ke method indexTodo untuk menampilkan daftar todolist terbaru
        return redirect()->action([TodolistController::class,"indexTodo"]);
    }

    // Method untuk menghapus todo berdasarkan ID
    public function deleteTodo(Request $request, string $todoId) {
        // Hapus todo dengan ID yang diberikan
        $this->todolistService->deleteTodo($todoId);

        // Redirect kembali ke method indexTodo setelah penghapusan
        return redirect()->action([TodolistController::class,"indexTodo"]);
    }
}
