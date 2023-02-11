<?php

namespace App\Providers;

use App\Repositories\MySql\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mapMySqlRepositoryProviders();
    }

    /**
     * MySql Database repository providers
     */
    public function mapMySqlRepositoryProviders()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**y
     *
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
