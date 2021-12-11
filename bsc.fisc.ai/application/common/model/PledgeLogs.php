<?php

namespace app\common\model;

use think\Model;

/**
 * 参数配置
 */
class PledgeLogs Extends Model
{
	// 表名
    protected $name = 'pledge_logs';
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = false;
    // 追加属性
    protected $append = [
    ];

}

