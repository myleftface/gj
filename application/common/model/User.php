<?php
namespace app\common\model;

use think\Model;

class User extends BaseModel
{
    public function add($data = []) {
        // 如果提交的数据不是数组
        if(!is_array($data)) {
            exception('传递的数据不是数组');
        }

        $data['status'] = 0;
        return $this->data($data)->allowField(true)
            ->save();
    }

    /**
     * 根据用户名获取用户信息
     * @param $username
     */
    public function getUserByUsername($username) {
        if(!$username) {
            exception('用户名不合法');
        }

        $data = ['username' => $username];
        return $this->where($data)->find();
    }


    public function getUserById($id) {
        if(!$id) {
            exception('ID不合法');
        }

        $data = ['id' => $id];
        return $this->where($data)->find();
    }


    public function getAllUser() {
        $data = [
          
            'status' => ['neq',-1],
        ];

        $order =[
         
            'id' => 'desc',
        ];
        $result = $this->where($data)
            ->order($order)
            ->paginate();
        //echo $this->getLastSql();

        return $result;

    }
    public function getAllUserByDepartment() {
        $data = [
          
            'status' => ['neq',-1],
            'department'=>['gt',1],
        ];

        $order =[
         
            'id' => 'desc',
        ];
        $result = $this->where($data)
            ->order($order)
            ->paginate();
        //echo $this->getLastSql();

        return $result;

    }

    public function getUserDepartmentById($id=0) {
        $data = [
            'status' => 1,
            'id' => $id,
        ];
        $res = $this->where($data)->find();
        //echo $this->getLastSql();
        //  $res = $res->toArray();
        // dump($res);
      return $res;
    }
}
