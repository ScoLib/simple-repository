<?php
declare(strict_types=1);

namespace Sco\Repository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register()
    {
        // Merge config
        $this->mergeConfigFrom(
            realpath(__DIR__ . '/../config/config.php'),
            'simple.repository'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            // Publish config
            $this->publishes(
                [realpath(__DIR__ . '/../config/config.php') => config_path('simple.repository.php')],
                'simple-repository-config'
            );
        }
    }
}
