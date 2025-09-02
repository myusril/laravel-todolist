<?php

namespace App\Services\Implementation;

use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;

class TodolistServiceImplementation implements TodolistService {

    // Method untuk menyimpan todo baru ke session
    public function saveTodo(string $id, string $todo) {
        // Cek apakah session "todolist" sudah ada
        if (!Session::exists("todolist")) {
            // Jika belum ada, buat session "todolist" dengan array kosong
            Session::put("todolist", []);
        }

        // Tambahkan todo baru ke session "todolist"
        Session::push("todolist", [
            "id" => $id,      // Simpan ID unik todo
            "todo" => $todo   // Simpan isi todo
        ]);
    }

    // Method untuk mengambil semua todo dari session
    public function getTodoList(): array {
        // Ambil data todolist dari session, jika tidak ada kembalikan array kosong
        return Session::get("todolist", []);
    }

    // Method untuk menghapus todo berdasarkan ID
    public function deleteTodo(string $todoId) {
        // Ambil semua data todolist dari session
        $todolist = Session::get("todolist");

        // Looping setiap todo untuk mencari yang sesuai dengan ID
        foreach ($todolist as $index => $value) {
            // Jika ID todo cocok dengan yang ingin dihapus
            if ($value["id"] == $todoId) {
                // Hapus todo tersebut dari array
                unset($todolist[$index]);
                // Keluar dari loop setelah menghapus
                break;
            }
        }

        // Simpan kembali todolist yang sudah diperbarui ke session
        Session::put("todolist", $todolist);
    }
}