<?php

namespace App\Providers;

use App\Services\GithubWrapper;
use App\Services\GitService;
use App\Services\Interfaces\IGitService;
use App\Services\Interfaces\IGitWrapper;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->scoped(IGitWrapper::class, function (Application $app) {
            return new GithubWrapper();
        });

        $this->app->scoped(IGitService::class, function (Application $app) {
            return new GitService($app->make(IGitWrapper::class));
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
