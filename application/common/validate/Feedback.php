<?php
namespace app\common\validate;
use think\Validate;
class Feedback extends Validate {
    protected $rule = [
        
        'fb_date' => 'require',
        'id', 'number',
        'status', 'number|in:-1,1','状态必须是数字|状态范围不合法',//-1 删除 1 正常
    ];

    // 场景设置
    protected  $scene = [
        
        'status' => ['id','status'],
        'update' =>['id','fb_date']
    ];
}

