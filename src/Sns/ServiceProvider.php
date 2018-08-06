<?php

namespace RuLong\Dingtalk\Sns;

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
        $app['sns'] = function ($app) {
            return new Client($app);
        };
    }
}
