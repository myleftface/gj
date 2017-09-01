<?php

namespace app\Common\model;

use think\Model;

class Department extends Model
{
    //
    public function getDepartment() {
        $data = [
            'status' => 0,
            '$d_name' => $d_name,
        ];

        $order = [
            'id' => 'desc',
        ];

        return $this->where($data)
            ->order($order)
            ->select();
    }
  
}
