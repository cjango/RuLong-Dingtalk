<?php

namespace RuLong\Dingtalk\Checkin;

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
        $app['checkin'] = function ($app) {
            return new Client($app);
        };
    }
}
