<?php

namespace App\Providers;

use App\Repositories\Contracts\GithubRepositoryInterface;
use App\Repositories\Decorators\CachingGithubRepository;
use App\Repositories\ExternalApi\ExternalGithubRepository;
use Illuminate\Support\ServiceProvider;

class GithubServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(GithubRepositoryInterface::class, function(){
            $externalApi = new ExternalGithubRepository();
            $cachingRepo = new CachingGithubRepository($this->app['cache.store'], $externalApi);
            return $cachingRepo;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
