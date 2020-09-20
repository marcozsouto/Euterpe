<?php

namespace App\Providers;

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
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ArtistRepository::class, \App\Repositories\ArtistRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PlaylistRepository::class, \App\Repositories\PlaylistRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AlbumRepository::class, \App\Repositories\AlbumRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MusicRepository::class, \App\Repositories\MusicRepositoryEloquent::class);
        //:end-bindings:
    }
}
