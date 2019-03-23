<?php

namespace App\Providers;

use App\Classes\TweetFormatter;
use App\Classes\TwitterHandler;
use App\Contracts\TweetFormatterContract;
use App\Contracts\TwitterHandlerContract;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Schema;
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
        $this->app->bind(TwitterHandlerContract::class, TwitterHandler::class);
        $this->app->bind(TweetFormatterContract::class, TweetFormatter::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Resource::withoutWrapping();

    }
}
