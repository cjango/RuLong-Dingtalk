<?php

namespace RuLong\Dingtalk\Jssdk;

/**
 * Class ConfigBuilder.
 *
 * @author
 */
class ConfigBuilder
{
    /**
     * @var \RuLong\Dingtalk\Jssdk\Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var array
     */
    protected $apiList = [];

    /**
     * @var int
     */
    protected $agentId;

    /**
     * @var int
     */
    protected $type = 0;

    /**
     * @var int
     */
    protected $timestamp;

    /**
     * @var string
     */
    protected $nonce;

    /**
     * ConfigBuilder constructor.
     *
     * @param \EasyDingTalk\Jssdk\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Set url.
     *
     * @param string $url
     *
     * @return $this
     */
    public function setUrl(string $url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url.
     *
     * @return string
     */
    public function getUrl(): string
    {
        if (is_null($this->url)) {
            $this->url = \Request::url();
        }

        return $this->url;
    }

    /**
     * @param array $apiList
     *
     * @return $this
     */
    public function useApi(array $apiList)
    {
        $this->apiList = $apiList;

        return $this;
    }

    /**
     * @param int $agentId
     *
     * @return $this
     */
    public function ofAgent(int $agentId)
    {
        $this->agentId = $agentId;

        return $this;
    }

    /**
     * @param int $type
     *
     * @return $this
     */
    public function setType(int $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param int $timestamp
     *
     * @return $this
     */
    public function setTimestamp(int $timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * @param string $nonce
     *
     * @return $this
     */
    public function setNonce(string $nonce)
    {
        $this->nonce = $nonce;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'agentId'   => $this->agentId,
            'corpId'    => $this->client->corpId(),
            'timeStamp' => $timestamp = $this->timestamp ?: time(),
            'nonceStr'  => $nonce = $this->nonce ?: uniqid(),
            'signature' => $this->client->signature($this->getUrl(), $nonce, $timestamp),
            'type'      => $this->type,
            'jsApiList' => $this->apiList,
        ];
    }

    /**
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}
