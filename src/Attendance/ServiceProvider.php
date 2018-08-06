<?php

namespace RuLong\Dingtalk\Attendance;

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
        $app['attendance'] = function ($app) {
            return new Client($app);
        };
    }
}
