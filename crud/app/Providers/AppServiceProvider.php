<?php

namespace App\Providers;

use App\Jobs\TestCreatePostJob;
use App\Repository\CommentRepositoryInterface;
use App\Repository\impl\CommentRepository;
use App\Repository\impl\PostRepository;
use App\Repository\impl\UserRepository;
use App\Repository\PostRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use App\Service\CommentServiceInterface;
use App\Service\impl\CommentService;
use App\Service\impl\PostService;
use App\Service\impl\UserService;
use App\Service\PostServiceInterface;
use App\Service\UserServiceInterface;
use Illuminate\Contracts\Foundation\Application;
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

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);

        $this->app->bindMethod([TestCreatePostJob::class, 'handle'], function (TestCreatePostJob $job, Application $app) {
            return $job->handle($app->make(PostServiceInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
