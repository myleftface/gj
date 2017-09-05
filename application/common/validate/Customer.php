<?php
namespace app\common\validate;
use think\Validate;
class Customer extends Validate {
    protected $rule = [
        'name' => 'require|max:25',
        'entry_date' => 'require',
        'cus_phone' => 'require',
        //'contract_date' => 'require',
        'designer' => 'require',
        'submitter' => 'require',
        ['id', 'number'],
        ['status', 'number|in:-1,0,1,2','状态必须是数字|状态范围不合法'],//-1 删除 0 未成交 1 未审核 2 审核通过
    ];

    // 场景设置
    protected  $scene = [
        'add' => ['name', 'entry_date', 'cus_phone', 'contract_date', 'designer', 'submitter'],
        'status' => ['id','status'],
    ];
}