<?php

namespace Balfour\LaravelFlashMessages;

use Illuminate\Session\Store;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->singleton(FlashMessages::class, function () {
            $store = app(Store::class);
            /** @var Store $store */
            return new FlashMessages($store);
        });

        $this->app->alias('flash', FlashMessages::class);
    }
}
