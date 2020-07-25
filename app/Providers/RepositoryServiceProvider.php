<?php

namespace App\Providers;

use App\Repositories\YoutubeRepository;
use App\Repositories\Interfaces\YoutubeRepositoryInterface;
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
        $this->app->bind(YoutubeRepositoryInterface::class, YoutubeRepository::class);
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
