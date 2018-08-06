<?php

namespace RuLong\Dingtalk\Role;

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
        $app['role'] = function ($app) {
            return new Client($app);
        };
    }
}
