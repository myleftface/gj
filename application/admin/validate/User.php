<?php
namespace app\admin\validate;
use think\Validate;


class User extends Validate {
    protected  $rule = [
        ['name', 'require|max:1000', '用户名必须填写|用户名不能超过10个字符'],
        ['id', 'number'],
        ['status', 'number|in:-1,0,1,2','状态必须是数字|状态范围不合法'],
        ['email','email','邮箱格式不正确'],
        
    ];

    /**场景设置**/
    protected  $scene = [
        'add' => ['name','id'],// 添加
        'status' => ['id', 'status'],
    ];
}