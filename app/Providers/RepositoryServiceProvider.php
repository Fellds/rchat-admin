<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Http\Repositories\Contracts\BaseRepositoryInterface;
use App\Http\Repositories\Contracts\ChannelRepositoryInterface;
use App\Http\Repositories\Contracts\RadioRepositoryInterface;

use App\Http\Repositories\BaseRepository;
use App\Http\Repositories\ChannelRepository;
use App\Http\Repositories\RadioRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(ChannelRepositoryInterface::class, ChannelRepository::class);
        $this->app->bind(RadioRepositoryInterface::class, RadioRepository::class);
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
