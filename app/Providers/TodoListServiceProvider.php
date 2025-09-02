<?php

namespace App\Providers;

use App\Services\Implementation\TodolistServiceImplementation;
use App\Services\TodolistService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TodoListServiceProvider extends ServiceProvider implements DeferrableProvider
{
    // Deklarasi properti $singletons untuk binding service ke implementasi
    public array $singletons = [
        // Bind interface TodolistService ke implementasi TodolistServiceImplementation
        TodolistService::class => TodolistServiceImplementation::class,
    ];

    // Method provides untuk mendeklarasikan service yang disediakan oleh provider
    public function provides(): array {
        // Mengembalikan daftar service yang disediakan (dalam hal ini TodolistService)
        return [TodolistService::class];
    }
    
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
