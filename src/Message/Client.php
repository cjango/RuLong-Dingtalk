<?php

namespace RuLong\Dingtalk\Message;

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
     * @param string $messageId
     *
     * @return array
     */
    public function status(string $messageId)
    {
        return $this->httpPostJson('message/list_message_status', compact('messageId'));
    }

    /**
     * @param array|null $data
     *
     * @return array
     */
    public function send(array $data = null)
    {
        return $this->httpPostJson('message/send', $data ?? $this->data);
    }

    /**
     * @param string|array $user
     *
     * @return $this
     */
    public function toUser($user)
    {
        $this->data['touser'] = implode('|', (array) $user);

        return $this;
    }

    /**
     * @param string|array $party
     *
     * @return $this
     */
    public function toParty($party)
    {
        $this->data['toparty'] = implode('|', (array) $party);

        return $this;
    }

    /**
     * @param int $agent
     *
     * @return $this
     */
    public function ofAgent(int $agent)
    {
        $this->data['agentid'] = $agent;

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
