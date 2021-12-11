<?php

namespace app\common\model;

use think\Model;

/**
 * 参数配置
 */
class Bep20Address Extends Model
{
	// 表名
    protected $name = 'bep20_address';
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = false;
    // 追加属性
    protected $append = [
    ];

}

