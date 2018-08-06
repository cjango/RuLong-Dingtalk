<?php

namespace RuLong\Dingtalk\Kernel;

use GuzzleHttp\Client;
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

        $app['client'] = function () {
            return new Client([
                'base_uri' => 'https://oapi.dingtalk.com/',
                'headers'  => [
                    'Content-Type' => 'application/json',
                ],
                'timeout'  => 5.0,
            ]);
        };

        $app['credential'] = function ($app) {
            return new Credential($app);
        };
    }
}
