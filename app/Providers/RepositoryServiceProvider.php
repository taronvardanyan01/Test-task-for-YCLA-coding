<?php

namespace App\Providers;

use App\Repositories\Read\Product\ProductReadRepositoryInterface;
use App\Repositories\Read\Users\UserReadRepositoryInterface;
use App\Repositories\Write\User\UserWriteRepositoryInterface;
use App\Repositories\Read\Product\ProductReadRepository;
use App\Repositories\Write\User\UserWriteRepository;
use App\Repositories\Read\Users\UserReadRepository;
use Carbon\Laravel\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            UserWriteRepositoryInterface::class,
            UserWriteRepository::class
        );

        $this->app->bind(
            UserReadRepositoryInterface::class,
            UserReadRepository::class
        );

        $this->app->bind(
            ProductReadRepositoryInterface::class,
            ProductReadRepository::class
        );
    }
}
