<?php

return [
    /*
     * 默认配置，将会合并到各模块中
     */
    'defaults' => [
        // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
        'response_type'     => 'collection',
        // 使用 Laravel 的缓存系统
        'use_laravel_cache' => true,
    ],

    /*
     * 服务端接口信息
     */
    'server'   => [
        'default' => [
            'corp_id'     => 'ding1e7a95c4f7e948db',
            'corp_secret' => 'xCSfJryFYJk9u3n4zWUqBAz9dJguPduST7lMTgEU-4dRYbMO9PYS0DqMf2Awjvdm',
        ],
    ],
];
