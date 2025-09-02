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
        $todo = $request->input("todo");

        if(empty($todo)) {
            $todolist = $this->todolistService->getTodoList();
            
            return response()->view("todolist.index-todolist", [
                "title" => "Todolist",
                "todolist" => $todolist,
                "error" => "Todo is required"
            ]);
        }

        $this->todolistService->saveTodo(uniqid(), $todo);

        return redirect()->action([TodolistController::class,"indexTodo"]);
    }

    public function deleteTodo(Request $request, string $todoId) {
        $this->todolistService->deleteTodo($todoId);

        return redirect()->action([TodolistController::class,"indexTodo"]);
    }
}
