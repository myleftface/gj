<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function status($status) {
    if($status == 1) {
        $str = "<span class='label label-success radius'>正常</span>";
    }elseif($status ==0) {
        $str = "<span class='label label-danger radius'>待审</span>";
    }else {
        $str = "<span class='label label-danger radius'>禁用</span>";
    }
    return $str;
}
function  cus_status($status) {
    if($status == 1) {
        $str = "<span class='label label-warning radius'>未审核</span>";
    }elseif($status == 0) {
        $str = "<span class='label label-primary radius'>未成交</span>";
    }elseif($status == 2) {
        $str = "<span class='label label-success radius'>审核通过</span>";
    }else{
        $str = "<span class='label label-danger radius'>已删除</span>";
    }
    return $str;
}
/**
 * 通用的分页样式
 * @param $obj
 */
 function pagination($obj) {
    if(!$obj) {
        return '';
    }
    // 优化的方案
    $params = request()->param();
    return '<div class="cl pd-5 bg-1 bk-gray mt-20 tp5-gj">'.$obj->appends($params)->render().'</div>';
}

