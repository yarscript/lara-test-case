<?php

namespace App\Providers;

use App\Models\User\User;
use App\Models\User\UserModelContract;
use App\Repository\User\Create as CreateUserRepository;
use App\Services\User\Create as CreateUserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserModelContract::class, User::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public array $singletons = [
        CreateUserService::class => CreateUserService::class,
        CreateUserRepository::class => CreateUserRepository::class,
    ];
}
