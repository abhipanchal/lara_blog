<?php

namespace App\Providers;

use App\Interfaces\PostRepositoryInterface;
use App\Interfaces\CommentRepositoryInterface;
use App\Repositories\CommentRepository;
use App\Repositories\PostRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(PostRepositoryInterface::class, function(){
            return new PostRepository();
        });
        $this->app->bind(CommentRepositoryInterface::class,function(){
                return new CommentRepository();
        });
    }
}
