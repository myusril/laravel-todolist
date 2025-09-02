<?php

namespace App\Services;

interface TodolistService {

    // Method untuk menyimpan todo baru dengan ID dan teks todo
    public function saveTodo(string $id, string $todo);

    // Method untuk mengambil semua todo yang ada (mengembalikan array)
    public function getTodoList();

    // Method untuk menghapus todo berdasarkan ID
    public function deleteTodo(string $todoId);
}
