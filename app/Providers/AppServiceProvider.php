<?php

namespace App\Providers;

use App\Repositories\Comment\CommentEloquent;
use App\Repositories\Comment\CommentInterface;
use App\Repositories\Post\PostEloquent;
use App\Repositories\Post\PostInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $repositories = [
        PostInterface::class => PostEloquent::class,
        CommentInterface::class => CommentEloquent::class,
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach ($this->repositories as $interface => $elqouent) {
            $this->app->bind($interface, $elqouent);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
