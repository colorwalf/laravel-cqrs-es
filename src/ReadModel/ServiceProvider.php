<?php

namespace Madewithlove\LaravelCqrsEs\ReadModel;

use Broadway\ReadModel\ProjectorInterface;
use Madewithlove\LaravelCqrsEs\Inflectors\MethodNameInflector;
use Madewithlove\LaravelCqrsEs\Inflectors\ProjectClassNameInflector;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ReadModelManager::class, function () {
            return new ReadModelManager($this->app);
        });
        $this->app->alias(ReadModelManager::class, 'read_model.manager');

        $this->app->singleton('read_model.driver', function () {
            return $this->app->make('read_model.manager')->driver();
        });
    }
}