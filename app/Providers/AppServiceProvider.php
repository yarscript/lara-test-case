<?php

namespace App\Providers;

use App\Models\User\User;
use App\Models\User\UserModelContract;
use App\Repository\User\CreateContract as CreateUserRepositoryContract;
use App\Repository\User\Create as CreateUserRepository;
use App\Repository\BaseRepository;
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
        $this->app->bind(CreateUserRepositoryContract::class, CreateUserRepository::class);
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
}
