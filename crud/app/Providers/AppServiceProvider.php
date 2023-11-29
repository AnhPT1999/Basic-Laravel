<?php

namespace App\Providers;

use App\Repository\CommentRepositoryInterface;
use App\Repository\impl\CommentRepository;
use App\Repository\impl\PostRepository;
use App\Repository\PostRepositoryInterface;
use App\Service\CommentServiceInterface;
use App\Service\impl\CommentService;
use App\Service\impl\PostService;
use App\Service\PostServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(PostServiceInterface::class, PostService::class);

        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(CommentServiceInterface::class, CommentService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
