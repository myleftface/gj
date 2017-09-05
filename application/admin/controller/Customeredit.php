<?php
namespace app\admin\controller;
use think\Controller;
class Customeredit extends  Base
{
  
    public function index()
    {
        return $this->fetch();
    }
    
    public function edit() {
        if(!request()->isPost()) {
            $this->error('请求错误');
        }
        // 获取表单的值
        $data = input('post.');
        //检验数据
        $validate = validate('Customer');
        if(!$validate->scene('edit')->check($data)) {
            $this->error($validate->getError());
        }

        // 判定提交的用户是否存在
       // $accountResult1 = model('CustomerAccount')->get(['cus_phone'=>$data['cus_phone']]);
        //$accountResult2= model('CustomerAccount')->get(['name'=>$data['name']]);
				//echo model('Customer')->getLastSql();exit;
        //if($accountResult1 && $accountResult2) {
        //    $this->error('该客户已经存在');
        //}
        // 客户基本信息入库
        $cusData = [
            'name' => $data['name'],
            'entry_date' => strtotime($data['entry_date']),
            'cus_phone' => $data['cus_phone'],
            'cell_address' => $data['cell_address'],
            'brand' => $data['brand'],
            'floor_space' => $data['floor_space'],
            'handover_date' => strtotime($data['handover_date']), 
            'total_value' => $data['total_value'],
            'design_fee' => $data['design_fee'],
            'contract_date' => strtotime($data['contract_date']), 
            'submitter' => $data['submitter'],
            'cus_level' => $data['cus_level'],
            'description' => empty($data['description']) ? '' : $data['description'],
            //'description' => $data['description'],
            'designer' => $data['designer'],
            'source' =>  $data['source'],
            
        ];
        $cusId = model('Customer')->add($cusData);
     
        if($cusId) {
            $this->success('提交成功');
        }else {
            $this->error('提交失败');
        }
       

    }
   
}
	