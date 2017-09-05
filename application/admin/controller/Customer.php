<?php
namespace app\admin\controller;
use think\Controller;
class Customer extends  Base
{
  
    public function index()
    {
        return $this->fetch();
    }
    
    public function add() {
        if(!request()->isPost()) {
            $this->error('请求错误');
        }
        // 获取表单的值
        $data = input('post.','','htmlentities');
        //检验数据
        $validate = validate('Customer');
        if(!$validate->scene('add')->check($data)) {
            $this->error($validate->getError());
        }

        // 判定提交的用户是否存在
        $accountResult1 = model('CustomerAccount')->get(['cus_phone'=>$data['cus_phone']]);
        $accountResult2= model('CustomerAccount')->get(['name'=>$data['name']]);
				//echo model('Customer')->getLastSql();exit;
        if($accountResult1 && $accountResult2) {
            $this->error('该客户已经存在');
        }
        // 客户基本信息入库
        $cusData = [
            'name' => $data['name'],
            'entry_date' => strtotime($data['entry_date']),
            'cus_phone' => $data['cus_phone'],
            'cell_address' => empty($data['cell_address']) ? '' : $data['cell_address'],
            'brand' => empty($data['brand']) ? '' : $data['brand'],
            'floor_space' => empty($data['floor_space']) ? '' : $data['floor_space'],
            'contract_id' => empty($data['contract_id']) ? '' : $data['contract_id'],
            'contract_date' => empty($data['contract_date']) ? '' : strtotime($data['contract_date']), 
            'handover_date' => empty($data['handover_date']) ? '' : strtotime($data['handover_date']), 
            'total_value' => empty($data['total_value']) ? '' : $data['total_value'],
            'payment_status' => empty($data['payment_status']) ? '' : $data['payment_status'],
            'design_fee' => empty($data['design_fee']) ? '' : $data['design_fee'],
            'cus_level' => $data['cus_level'],
            'description' => empty($data['description']) ? '' : $data['description'],
            'designer' => $data['designer'],
            'submitter' => $data['submitter'],
            'source' => empty($data['source']) ? '' : $data['source'],            
        ];
        $cusId = model('Customer')->add($cusData);
     
        if($cusId) {
            $this->success('提交成功');
        }else {
            $this->error('提交失败');
        }
       

    }
   
}
	