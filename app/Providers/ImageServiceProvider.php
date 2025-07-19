<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Services\ImageService;

class ImageServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ImageService::class, function ($app) {
            return new ImageService();
        });
    }

    public function boot()
    {
        //
    }
}
