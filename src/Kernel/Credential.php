<?php

namespace RuLong\Dingtalk\Kernel;

use Illuminate\Support\Facades\Cache;
use RuLong\Dingtalk\Application;

/**
 * Class Credential.
 * @author
 */
class Credential
{
    use Traits\HasHttpRequests;

    protected $app;

    /**
     * Credential constructor.
     * @param \EasyDingTalk\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Get credential token.
     *
     * @return string
     */
    public function token(): string
    {
        if ($value = $this->getToken()) {
            return $value;
        }

        $result = $this->request('GET', 'gettoken', [
            'query' => $this->credentials(),
        ]);

        return $this->setToken($result['access_token']);
    }

    /**
     * 从缓存中读取 Token
     * @Author:<C.Jason>
     * @Date:2018-08-03T11:58:31+0800
     * @return [type] [description]
     */
    protected function getToken()
    {
        return Cache::get($this->cacheKey());
    }

    /**
     * 将 Token 写入缓存
     * @param string                 $token
     * @return string
     */
    protected function setToken(string $token)
    {
        Cache::set($this->cacheKey(), $token, 100);
        return $token;
    }

    /**
     * @return array
     */
    protected function credentials(): array
    {
        return [
            'corpid'     => $this->app['config']->get('corp_id'),
            'corpsecret' => $this->app['config']->get('corp_secret'),
        ];
    }

    /**
     * @return string
     */
    protected function cacheKey(): string
    {
        return 'rulong.dingtalk.access_token.' . md5(json_encode($this->credentials()));
    }
}
