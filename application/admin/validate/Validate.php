<?php
namespace app\admin\validate;
use think\Validate;

class User extends Validate {
    protected  $rule = [
        ['name', 'require|max:1000', '用户名必须传递|用户名不能超过10个字符'],
        ['id', 'number'],
        ['status', 'number|in:-1,0,1','状态必须是数字|状态范围不合法'],
    ];

    /**场景设置**/
    protected  $scene = [
        'add' => ['name','id'],// 添加
        'status' => ['id', 'status'],
    ];
}