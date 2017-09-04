<?php
namespace app\admin\controller;
use think\Controller;
class Customerlist extends  Base
{
    private  $obj;
    public function _initialize() {
        $this->obj = model("Customer");
    }
    /**
     * 正常的客户列表
     * @return mixed
     */
    public function index() {
        $customer = $this->obj->getCustomerByStatus(1);
        //获取当前用户
        $this->assign('user', $this->getLoginUser());
        return $this->fetch('', [
            'customer' => $customer,
          
        ]);
        
    }
    /**
     * 待审核用户列表
     * @return mixed
     */
    public function getCustomerNonChecked() {
        $customer = $this->obj->getCustomerByStatus();
        return $this->fetch('', [
            'customer' => $customer,
        ]);
    }

    // public function detail() {
    //     $id = input('get.id');
    //     if(empty($id)) {
    //         return $this->error('ID错误');
    //     }
    //     //获取一级城市的数据
    //     //$citys = model('City')->getNormalCitysByParentId();
    //     //获取一级栏目的数据
    //    // $categorys = model('Category')->getNormalCategoryByParentId();
    //     // 获取商户数据
    //     $cusData = model('Customer')->get($id);
    //     //$locationData = model('BisLocation')->get(['bis_id'=>$id, 'is_main'=>1]);
    //     //$accountData = model('BisAccount')->get(['bis_id'=>$id, 'is_main'=>1]);
    //     return $this->fetch('',[
    //         'name' => $data['name'],
    //         'entry_date' => strtotime($data['entry_date']),
    //         'cus_phone' => $data['cus_phone'],
    //         'cell_address' => $data['cell_address'],
    //         'brand' => $data['brand'],
    //         'floor_space' => $data['floor_space'],
    //         'contract_date' => strtotime($data['contract_date']), 
    //         'submitter' => $data['submitter'],
    //         'cus_level' => $data['cus_level'],
    //         'description' => empty($data['description']) ? '' : $data['description'],
    //         //'description' => $data['description'],
    //         'source' =>  $data['source'],
    //     ]);
    // }

    // 修改状态
    public function status() {
        $data = input('get.');
        // 检验
        $validate = validate('Customer');
        if(!$validate->scene('status')->check($data)) {
            $this->error($validate->getError());
        }

        $res = $this->obj->save(['status'=>$data['status']], ['id'=>$data['id']]);
       // $location = model('BisLocation')->save(['status'=>$data['status']], ['bis_id'=>$data['id'], 'is_main'=>1]);
        //$account = model('BisAccount')->save(['status'=>$data['status']], ['bis_id'=>$data['id'], 'is_main'=>1]);
        if($res) {
            // 发送邮件
            // status 1  status 2  status -1
            // \phpmailer\Email::send($data['email'],$title, $content);
            $this->success('状态更新成功');
        }else {
            $this->error('状态更新失败');
        }

    }

}
