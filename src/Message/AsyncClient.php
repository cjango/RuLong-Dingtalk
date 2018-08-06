<?php

namespace RuLong\Dingtalk\Message;

use RuLong\Dingtalk\Kernel\BaseClient;
use RuLong\Dingtalk\Kernel\Messages\Message;

/**
 * Class AsyncClient.
 *
 * @author
 */
class AsyncClient extends BaseClient
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param int $agentId
     * @param int $taskId
     *
     * @return array
     */
    public function progress(int $agentId, int $taskId)
    {
        return $this->httpGetMethod('dingtalk.corp.message.corpconversation.getsendprogress', [
            'agent_id' => $agentId,
            'task_id'  => $taskId,
        ]);
    }

    /**
     * @param int $agentId
     * @param int $taskId
     *
     * @return array
     */
    public function result(int $agentId, int $taskId)
    {
        return $this->httpGetMethod('dingtalk.corp.message.corpconversation.getsendresult', [
            'agent_id' => $agentId,
            'task_id'  => $taskId,
        ]);
    }

    /**
     * @param array|null $data
     *
     * @return array
     */
    public function send(array $data = null)
    {
        return $this->httpGetMethod('dingtalk.corp.message.corpconversation.asyncsend', $data ?? $this->data);
    }

    /**
     * @param $message
     *
     * @return $this
     */
    public function withReply($message)
    {
        $message = Message::parse($message);

        $this->data['msgtype']    = $message->type();
        $this->data['msgcontent'] = json_encode($message->body());

        return $this;
    }

    /**
     * @param string|array $user
     *
     * @return $this
     */
    public function toUser($user)
    {
        $this->data['userid_list'] = implode(',', (array) $user);

        return $this;
    }

    /**
     * @param string|array $party
     *
     * @return $this
     */
    public function toParty($party)
    {
        $this->data['dept_id_list'] = implode(',', (array) $party);

        return $this;
    }

    /**
     * @param int $agent
     *
     * @return $this
     */
    public function ofAgent(int $agent)
    {
        $this->data['agent_id'] = $agent;

        return $this;
    }

    /**
     * @return $this
     */
    public function toAll()
    {
        $this->data['to_all_user'] = 'true';

        return $this;
    }
}
