<?php namespace Barryvdh\StackMiddleware;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('stack', function () {
            return new StackMiddleware($this->app);
        });

        $this->app->alias('stack', 'Barryvdh\StackMiddleware\StackMiddleware');
    }
}
