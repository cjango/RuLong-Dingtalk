<?php

namespace RuLong\Dingtalk\Message;

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
        $app['message'] = function ($app) {
            return new Client($app);
        };

        $app['async_message'] = function ($app) {
            return new AsyncClient($app);
        };
    }
}
