<?php

namespace app\Common\model;

use think\Model;

class Department extends BaseModel
{
    //
    public function getDepartment() {
        $data = [
            'status' => 0,
          
        ];

        $order = [
            'id' => 'asc',
        ];

        $res = $this->where($data)
            ->order($order)
            ->select();
        
        //echo $this->getLastSql();
        //  $res = $res->toArray();
        // dump($res);
        
      return $res;
    }

   

}
