<?php

namespace RuLong\Dingtalk\Department;

use RuLong\Dingtalk\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author
 */
class Client extends BaseClient
{
    /**
     * 获取部门列表
     * @param int $id
     * @return array
     */
    function list(int $id = 0) {

        if ($id == 0) {
            return $this->httpGet('department/list');
        }

        return $this->httpGet('department/list', compact('id'));
    }

    /**
     * 获取部门id列表
     * @param int $id
     * @return array
     */
    public function list_ids(int $id)
    {
        return $this->httpGet('department/list_ids', compact('id'));
    }

    /**
     * 获取部门详情
     * @param int $id
     * @return array
     */
    public function get(int $id)
    {
        return $this->httpGet('department/get', compact('id'));
    }

    /**
     * 创建部门
     * @param array $data
     * @return array
     */
    public function create(array $data)
    {
        return $this->httpPostJson('department/create', $data);
    }

    /**
     * 更新部门
     * @param array $data
     * @return array
     */
    public function update(array $data)
    {
        return $this->httpPostJson('department/update', $data);
    }

    /**
     * 删除部门
     * @param int $id
     * @return array
     */
    public function delete(int $id)
    {
        return $this->httpGet('department/delete', compact('id'));
    }

    /**
     * 查询部门的所有上级父部门路径
     * @param int $id
     * @return array
     */
    public function parent(int $id)
    {
        return $this->httpGet('department/list_parent_depts_by_dept', compact('id'));
    }

    /**
     * 查询指定用户的所有上级父部门路径
     * @param string $userId
     * @return array
     */
    public function userParent(string $userId)
    {
        return $this->httpGet('department/list_parent_depts', compact('userId'));
    }
}
