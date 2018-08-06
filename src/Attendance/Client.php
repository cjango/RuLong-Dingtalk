<?php

namespace RuLong\Dingtalk\Attendance;

use RuLong\Dingtalk\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author
 */
class Client extends BaseClient
{
    /**
     * 考勤打卡记录开放
     * @param array  $userIds
     * @param string $from
     * @param string $to
     *
     * @return array
     */
    public function record(array $userIds, \Datetime $from, \Datetime $to)
    {
        return $this->httpPostJson('attendance/listRecord', [
            'userIds'       => $userIds,
            'checkDateFrom' => $from->format('Y-m-d H:i:s'),
            'checkDateTo'   => $to->format('Y-m-d H:i:s'),
        ]);
    }

    /**
     * 考勤打卡结果开放
     * @param string $userId
     * @param string $from
     * @param string $to
     *
     * @return array
     */
    function list(array $userId, \Datetime $from, \Datetime $to) {
        return $this->httpPostJson('attendance/list', [
            'userId'       => $userId,
            'workDateFrom' => $from->format('Y-m-d H:i:s'),
            'workDateTo'   => $to->format('Y-m-d H:i:s'),
            'offset'       => 0,
            'limit'        => 50,
        ]);
    }
}
