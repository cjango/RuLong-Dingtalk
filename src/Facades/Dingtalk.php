<?php

namespace RuLong\Dingtalk\Facades;

use Illuminate\Support\Facades\Facade;

class Dingtalk extends Facade
{

    /**
     * 外观模式，获取Rbas实例
     * @Author:<C.Jason>
     * @Date:2018-06-22T16:01:36+0800
     * @return [type] [description]
     */
    public static function getFacadeAccessor()
    {
        return app('dingtalk');
    }
}
