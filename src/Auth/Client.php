<?php

namespace RuLong\Dingtalk\Auth;

use RuLong\Dingtalk\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author
 */
class Client extends BaseClient
{
    /**
     * @return array
     */
    public function scopes()
    {
        return $this->httpGet('auth/scopes');
    }
}
