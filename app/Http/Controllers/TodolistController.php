<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService) {
        $this->todolistService = $todolistService;
    }

    public function indexTodo(Request $request) {
        $todolist = $this->todolistService->getTodoList();

        return response()->view("todolist.index-todolist", [
            "title" => "Todolist",
            "todolist" => $todolist
        ]);
    }

    public function addTodo(Request $request) {

    }

    public function deleteTodo(Request $request, string $todoId) {

    }
}
