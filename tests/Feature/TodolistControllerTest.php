<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolist() {
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
        ])->get("/todolist")
        ->assertSeeText("1")
        ->assertSeeText("Yusril")
        ->assertSeeText("2")
        ->assertSeeText("Ananda");
    }
}
