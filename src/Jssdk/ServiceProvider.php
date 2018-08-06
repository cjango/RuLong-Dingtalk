<?php

namespace RuLong\Dingtalk\Jssdk;

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
        $app['jssdk'] = function ($app) {
            return new Client($app);
        };
    }
}
