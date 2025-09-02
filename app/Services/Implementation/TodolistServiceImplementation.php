<?php

namespace App\Services\Implementation;

use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;

class TodolistServiceImplementation implements TodolistService {
    public function saveTodo(string $id, string $todo) {
        if(!Session::exists("todolist")) {
            Session::put("todolist", []);
        }

        Session::push("todolist", [
            "id"=> $id,
            "todo" => $todo
        ]);
    }

    public function getTodoList(): array {
        return Session::get("todolist", []);
    }

    public function deleteTodo(string $todoId) {
        $todolist = Session::get("todolist");

        foreach ($todolist as $index => $value) {
            if($value["id"] == $todoId) {
                 unset($todolist[$index]);
                 break;
            }
        }

        Session::put("todolist", $todolist);
    }
}