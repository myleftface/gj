<?php
namespace app\common\model;

use think\Model;

class Feedback extends BaseModel{
    public function getFeedback($cus_id=0){

        $order = [
            'id' => 'desc',
        ];

        $data = [
            'cus_id' => $cus_id,
        ];
        $result = $this->where($data)
            ->order($order)
            ->paginate();
           // echo $this->getLastSql();
        return $result;
    }
   
}