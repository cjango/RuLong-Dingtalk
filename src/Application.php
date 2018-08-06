<?php

namespace RuLong\Dingtalk;

use Pimple\Container;

class Application extends Container
{

    /**
     * @var array
     */
    protected $providers = [
        Attendance\ServiceProvider::class,
        Auth\ServiceProvider::class,
        Chat\ServiceProvider::class,
        Checkin\ServiceProvider::class,
        Department\ServiceProvider::class,
        Jssdk\ServiceProvider::class,
        Kernel\ServiceProvider::class,
        Media\ServiceProvider::class,
        Message\ServiceProvider::class,
        Role\ServiceProvider::class,
        Sns\ServiceProvider::class,
        User\ServiceProvider::class,
    ];

    /**
     * Application constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        parent::__construct();

        $this['config'] = function () use ($config) {
            return new Kernel\Config($config);
        };

        $this->registerProviders();
    }

    /**
     * Register providers.
     */
    protected function registerProviders()
    {
        foreach ($this->providers as $provider) {
            $this->register(new $provider());
        }
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function __get($id)
    {
        return $this->offsetGet($id);
    }

}
