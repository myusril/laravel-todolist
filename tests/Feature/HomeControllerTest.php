<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function testForGuest() {
        $this->get("/")
        ->assertRedirect("/login");
    }

    public function testForMember() {
        $this->withSession([
            "user"=> "yusril",
        ])->get("/")
        ->assertRedirect("/todolist");
    }
}
