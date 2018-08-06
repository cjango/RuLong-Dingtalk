<?php

namespace RuLong\Dingtalk\Kernel;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\RequestInterface;
use RuLong\Dingtalk\Application;

/**
 * Class BaseClient.
 *
 * @author
 */
abstract class BaseClient
{
    use Traits\HasHttpRequests;

    /**
     * @var \RuLong\Dingtalk\Application
     */
    protected $app;

    protected $dingtalkHandlerStack;

    protected $taobaoHandlerStack;

    /**
     * @param \RuLong\Dingtalk\Application
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Make a get request.
     *
     * @param string $uri
     * @param array  $query
     *
     * @return array|\GuzzleHttp\Psr7\Response
     */
    public function httpGet(string $uri, array $query = [])
    {
        return $this->requestDingTalk('GET', $uri, [RequestOptions::QUERY => $query]);
    }

    /**
     * Make a post request.
     *
     * @param string $uri
     * @param array  $json
     * @param array  $query
     *
     * @return array|\GuzzleHttp\Psr7\Response
     */
    public function httpPostJson(string $uri, array $json = [], array $query = [])
    {
        return $this->requestDingTalk('POST', $uri, [
            RequestOptions::QUERY => $query,
            RequestOptions::JSON  => $json,
        ]);
    }

    /**
     * Upload files.
     *
     * @param string $uri
     * @param array  $files
     * @param array  $query
     *
     * @return array|\GuzzleHttp\Psr7\Response
     */
    public function httpUpload(string $uri, array $files, array $query = [])
    {
        $multipart = [];

        foreach ($files as $name => $path) {
            $multipart[] = [
                'name'     => $name,
                'contents' => fopen($path, 'r'),
            ];
        }

        return $this->requestDingTalk('POST', $uri, [
            RequestOptions::QUERY     => $query,
            RequestOptions::MULTIPART => $multipart,
        ]);
    }

    /**
     * @param string $method
     * @param array  $query
     *
     * @return array|\GuzzleHttp\Psr7\Response
     */
    public function httpGetMethod(string $method, array $query = [])
    {
        $query = compact('method') + $query;

        return $this->requestTaobao('GET', compact('query'));
    }

    /**
     * @param $method
     * @param $uri
     * @param array $options
     *
     * @return array|\GuzzleHttp\Psr7\Response
     */
    protected function requestDingTalk($method, $uri, array $options = [])
    {
        if (!$handler = $this->dingtalkHandlerStack) {
            $handler = HandlerStack::create();

            $handler->push(function (callable $handler) {
                return function (RequestInterface $request, array $options) use ($handler) {
                    return $handler($this->concat($request, ['access_token' => $this->app['credential']->token()]), $options);
                };
            });

            $this->dingtalkHandlerStack = $handler;
        }

        return $this->request($method, $uri, $options + compact('handler'));
    }

    /**
     * @param $method
     * @param array $options
     *
     * @return array|\GuzzleHttp\Psr7\Response
     */
    protected function requestTaobao($method, array $options = [])
    {
        if (!$handler = $this->taobaoHandlerStack) {
            $handler = HandlerStack::create();
            $handler->push(function (callable $handler) {
                return function (RequestInterface $request, array $options) use ($handler) {
                    $query = [
                        'session'    => $this->app['credential']->token(),
                        'timestamp'  => date('Y-m-d H:i:s'),
                        'format'     => 'json',
                        'v'          => '2.0',
                        'partner_id' => null,
                        'simplify'   => 'true',
                    ];

                    return $handler($this->concat($request, $query), $options);
                };
            });
            $this->taobaoHandlerStack = $handler;
        }

        return $this->request($method, 'https://eco.taobao.com/router/rest', $options + compact('handler'));
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     * @param array                              $query
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    protected function concat(RequestInterface $request, array $query = []): RequestInterface
    {
        parse_str($request->getUri()->getQuery(), $parsed);
        $query = http_build_query(array_merge($query, $parsed));

        return $request->withUri($request->getUri()->withQuery($query));
    }
}
