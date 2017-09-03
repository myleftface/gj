<?php
namespace app\common\model;

use think\Model;

class Customer extends BaseModel
{
    /**
     * 通过状态获取客户数据
     * @param $status
     */
    public function getBisByStatus($status=0) {
        $order = [
            'id' => 'desc',
        ];

        $data = [
            'status' => $status,
        ];
        $result = $this->where($data)
            ->order($order)
            ->paginate();
        return $result;
    }
}