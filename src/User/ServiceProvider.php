<?php

namespace RuLong\Dingtalk\User;

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
        $app['user'] = function ($app) {
            return new Client($app);
        };
    }
}
