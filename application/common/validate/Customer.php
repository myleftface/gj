<?php
namespace app\common\validate;
use think\Validate;
class Customer extends Validate {
    protected $rule = [
        'name' => 'require|max:25',
        //'entry_date' => 'require',
        'cus_phone' => 'require',
        //'contract_date' => 'require',
        'designer' => 'require',
        'submitter' => 'require',
       
    ];

    // 场景设置
    protected  $scene = [
        'add' => ['name', 'entry_date', 'cus_phone', 'contract_date', 'designer', 'submitter'],
    ];
}