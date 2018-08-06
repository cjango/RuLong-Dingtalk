<?php

namespace RuLong\Dingtalk\Providers;

use Illuminate\Support\ServiceProvider;
use RuLong\Dingtalk\Application;

class DingtalkServiceProvider extends ServiceProvider
{

    protected $defer = true;

    public function boot()
    {
        // 发布配置
        $this->publishes([
            __DIR__ . '/../../config/dingtalk.php' => config_path('dingtalk.php'),
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/dingtalk.php', 'dingtalk'
        );

        $this->app->singleton('dingtalk', function ($app) {
            $config = config('dingtalk');
            return new Application($config);
        });
    }

    public function provides()
    {
        return ['dingtalk'];
    }
}
