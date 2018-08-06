<?php

namespace RuLong\Dingtalk\Media;

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
        $app['media'] = function ($app) {
            return new Client($app);
        };
    }
}
