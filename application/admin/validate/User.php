<?php
namespace app\admin\validate;
use think\Validate;


class User extends Validate {
    protected  $rule = [
        ['name', 'require|max:1000', '用户名必须填写|用户名不能超过10个字符'],
        ['id', 'number'],
        ['status', 'number|in:-1,0,1,2','状态必须是数字|状态范围不合法'],

        ['username', 'chs|require|max:1000', '请用中文名字|用户名必须填写|用户名不能超过10个字符'],
        ['email','email','邮箱格式不正确'],
        ['department','number|in:1,2,3,4,5,6','部门错误|请选择你的部门'],
        
    ];

    /**场景设置**/
    protected  $scene = [
        'add' => ['name','id'],// 添加
        'register' => ['username','email','department'],
        'status' => ['id', 'status'],
    ];
}