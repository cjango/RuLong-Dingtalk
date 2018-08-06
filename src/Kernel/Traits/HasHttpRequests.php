<?php

namespace RuLong\Dingtalk\Kernel\Traits;

use RuLong\Dingtalk\Kernel\Exceptions\ClientError;

/**
 * Trait HasHttpRequests.
 * @author
 */
trait HasHttpRequests
{
    /**
     * @var bool
     */
    protected $transform = true;

    /**
     * @param string $method
     * @param string $uri
     * @param array  $options
     *
     * @return array|\GuzzleHttp\Psr7\Response
     */
    public function request(string $method, string $uri, array $options = [])
    {
        $response = $this->app['client']->request($method, $uri, $options);

        return $this->transform ? $this->transformResponse($response) : $response;
    }

    /**
     * @return $this
     */
    public function dontTransform()
    {
        $this->transform = false;

        return $this;
    }

    /**
     * @param \GuzzleHttp\Psr7\Response $response
     *
     * @return array
     *
     * @throws \EasyDingTalk\Kernel\Exceptions\ClientError
     */
    protected function transformResponse($response): array
    {
        $result = json_decode($response->getBody()->getContents(), true);

        if (isset($result['errcode']) && $result['errcode'] !== 0) {
            throw new ClientError($result['errmsg'], $result['errcode']);
        }

        if (isset($result['error_response'])) {
            throw new ClientError($result['error_response']['msg'], $result['error_response']['code']);
        }

        return $result;
    }
}
