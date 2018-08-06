<?php

namespace RuLong\Dingtalk\Role;

use RuLong\Dingtalk\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author
 */
class Client extends BaseClient
{
    /**
     * @param int      $roleId
     * @param int|null $size
     * @param int|null $offset
     *
     * @return array
     */
    public function simpleList(int $roleId, int $size = null, int $offset = null)
    {
        return $this->httpGetMethod('dingtalk.corp.role.simplelist', [
            'role_id' => $roleId,
            'size'    => $size,
            'offset'  => $offset,
        ]);
    }

    /**
     * @param int|null $size
     * @param int|null $offset
     *
     * @return array
     */
    function list(int $size = null, int $offset = null) {
        return $this->httpGetMethod('dingtalk.corp.role.list', compact('size', 'offset'));
    }

    /**
     * @param array $roleList
     * @param array $userList
     *
     * @return array
     */
    public function attach(array $roleList, array $userList)
    {
        return $this->httpGetMethod('dingtalk.corp.role.addrolesforemps', [
            'roleid_list' => $roleList,
            'userid_list' => $userList,
        ]);
    }

    /**
     * @param array $roleList
     * @param array $userList
     *
     * @return array
     */
    public function detach(array $roleList, array $userList)
    {
        return $this->httpGetMethod('dingtalk.corp.role.removerolesforemps', [
            'roleid_list' => $roleList,
            'userid_list' => $userList,
        ]);
    }

    /**
     * @param int $roleId
     *
     * @return array
     */
    public function delete(int $roleId)
    {
        return $this->httpGetMethod('dingtalk.corp.role.deleterole', [
            'role_id' => $roleId,
        ]);
    }

    /**
     * @param int $groupId
     *
     * @return array
     */
    public function group(int $groupId)
    {
        return $this->httpGetMethod('dingtalk.corp.role.getrolegroup', [
            'group_id' => $groupId,
        ]);
    }
}
