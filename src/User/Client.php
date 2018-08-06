<?php

namespace RuLong\Dingtalk\User;

use RuLong\Dingtalk\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author
 */
class Client extends BaseClient
{

    /**
     * 通过CODE换取用户身份
     * @return array
     */
    public function code(string $code)
    {
        return $this->httpGet('user/getuserinfo', compact('code'));
    }

    /**
     * 获取成员详情
     * @param string $userId
     * @return array
     */
    public function get(string $userId)
    {
        return $this->httpGet('user/get', ['userid' => $userId]);
    }

    /**
     * 创建成员
     * @param array $params
     * @return array
     */
    public function create(array $params)
    {
        return $this->httpPostJson('user/create', $params);
    }

    /**
     * 更新成员
     * @param array $params
     * @return array
     */
    public function update(array $params)
    {
        return $this->httpPostJson('user/update', $params);
    }

    /**
     * 删除成员/批量删除成员
     * @param array|string $userId
     * @return array
     */
    public function delete($userId)
    {
        if (is_array($userId)) {
            return $this->httpPostJson('user/batchdelete', ['useridlist' => $userId]);
        }

        return $this->httpGet('user/delete', $userId);
    }

    /**
     * 获取部门成员
     * @param int   $departmentId
     * @param array $params
     * @return array
     */
    public function simpleList(int $departmentId, array $params = [])
    {
        return $this->httpGet('user/simplelist', [
            'department_id' => $departmentId,
        ] + $params);
    }

    /**
     * 获取部门成员（详情）
     * @param int   $departmentId
     * @param int   $size
     * @param int   $offset
     * @param array $params
     * @return array
     */
    function list(int $departmentId, int $size = 100, int $offset = 1, array $params = []) {
        return $this->httpGet('user/list', [
            'department_id' => $departmentId,
            'offset'        => $offset,
            'size'          => $size,
        ] + $params);
    }

    /**
     * 获取管理员列表
     * @return array
     */
    public function admins()
    {
        return $this->httpGet('user/get_admin');
    }

    /**
     * 根据unionid获取成员的userid
     * @param string $unionId
     * @return array
     */
    public function toUserId(string $unionId)
    {
        return $this->httpGet('user/getUseridByUnionid', [
            'unionid' => $unionId,
        ]);
    }

    /**
     * 获取企业员工人数
     * @param array $params
     * @return array
     */
    public function count(bool $onlyActive = false)
    {
        return $this->httpGet('user/get_org_user_count', ['onlyActive' => $onlyActive]);
    }
}
