<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Http\Repositories\Contracts\BaseRepositoryInterface;
use App\Http\Repositories\Contracts\ChannelRepositoryInterface;

use App\Http\Repositories\BaseRepository;
use App\Http\Repositories\ChannelRepository;

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
