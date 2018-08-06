<?php

namespace RuLong\Dingtalk\Chat;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider.
 *
 * @author
 */
class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['chat'] = function ($app) {
            return new Client($app);
        };
    }
}
