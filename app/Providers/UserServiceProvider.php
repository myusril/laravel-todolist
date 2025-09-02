<?php

namespace App\Providers;

use App\Services\Implementation\UserServiceImplementation;
use App\Services\UserService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider implements DeferrableProvider
{
    // Deklarasi properti $singletons untuk binding interface ke implementasi
    public array $singletons = [
        // Bind interface UserService ke implementasi UserServiceImplementation
        UserService::class => UserServiceImplementation::class
    ];

    // Method provides untuk menentukan service apa saja yang disediakan oleh provider ini
    public function provides() {
        // Mengembalikan daftar service yang disediakan (dalam hal ini UserService)
        return [UserService::class];
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
