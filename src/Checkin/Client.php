<?php

namespace RuLong\Dingtalk\Checkin;

use RuLong\Dingtalk\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author
 */
class Client extends BaseClient
{
    /**
     * @param string $departmentId
     * @param int    $start
     * @param array  $params
     *
     * @return array
     */
    public function record($departmentId, int $start, array $params = [])
    {
        return $this->httpGet('checkin/record', [
            'department_id' => $departmentId,
            'start_time'    => $start,
            'start_time'    => $end_time,
        ] + $params);
    }
}
