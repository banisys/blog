<?php

namespace App\Providers;


use App\Models\Articles\Repositories\ArticleRepository;

use App\Models\Articles\Repositories\ArticleRepositoryInterface;

use App\Models\Categories\Repositories\CategoryRepository;
use App\Models\Categories\Repositories\CategoryRepositoryInterface;
use App\Models\Comments\Repositories\CommentRepository;
use App\Models\Comments\Repositories\CommentRepositoryInterface;
use App\Models\Users\Repositories\UserRepository;
use App\Models\Users\Repositories\UserRepositoryInterface;
use App\Models\Videos\Repositories\VideoRepository;
use App\Models\Videos\Repositories\VideoRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            ArticleRepositoryInterface::class,
            ArticleRepository::class
        );

        $this->app->bind(
            VideoRepositoryInterface::class,
            VideoRepository::class
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        $this->app->bind(
            CommentRepositoryInterface::class,
            CommentRepository::class
        );


        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );


    }
}
