<?php

namespace App\Providers;

use App\Classes\TweetFormatter;
use App\Classes\TwitterHandler;
use App\Contracts\TweetFormatterContract;
use App\Contracts\TwitterHandlerContract;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Spatie\Menu\Laravel\Facades\Menu;

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
        $this->registerMacros();

    }


    private function registerMacros()
    {
        $items = [
            'home' => '<i class="fas fa-chart-pie"></i><span>Dashboard</span>',
            'tweet.index' => '<i class="fab fa-twitter"></i><span>Tweets</span>',
            'user.index' => '<i class="fas fa-user"></i><span>User Profile</span>'
        ];

        Menu::macro('sideBar', function () use ($items) {
            return Menu::build($items, function ($menu, $label, $route) {
                $menu->route($route, $label);
            })
                ->addClass('nav flex-column')
                ->addItemParentClass('nav-item')
                ->addItemClass('nav-link')
                ->setActiveFromRequest();
        });
    }
}
