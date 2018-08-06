<?php

namespace RuLong\Dingtalk\Chat;

use RuLong\Dingtalk\Kernel\BaseClient;
use RuLong\Dingtalk\Kernel\Messages\Message;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param array $data
     *
     * @return array
     */
    public function create(array $data)
    {
        return $this->httpPostJson('chat/create', $data);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function update(array $data)
    {
        return $this->httpPostJson('chat/update', $data);
    }

    /**
     * @param string $chatId
     *
     * @return array
     */
    public function get(string $chatId)
    {
        return $this->httpGet('chat/get', [
            'chatid' => $chatId,
        ]);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function send(array $data = null)
    {
        return $this->httpPostJson('chat/send', $data ?? $this->data);
    }

    /**
     * @param string $chatId
     *
     * @return $this
     */
    public function toChat(string $chatId)
    {
        $this->data['chatid'] = $chatId;

        return $this;
    }

    /**
     * @param $message
     *
     * @return $this
     */
    public function withReply($message)
    {
        $this->data += Message::parse($message)->transform();

        return $this;
    }
}
