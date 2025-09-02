<?php

namespace App\Services;

interface TodolistService {
    public function saveTodo(string $id, string $todo);
    public function getTodoList();
}