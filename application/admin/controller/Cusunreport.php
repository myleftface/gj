<?php
namespace app\admin\controller;
use think\Controller;
class Cusunreport extends  Base
{
    private $obj;
    public function _initialize(){

        $this->obj = model('Customer');
    }
    public function index() {
        $data = input('get.');
        //$status = '0';
        $sdata =[];
    	if(!empty($data['start_time']) && !empty($data['end_time']) && strtotime($data['end_time']) > strtotime($data['start_time'])) {
    		$sdata['entry_date'] = [
    			['gt', strtotime($data['start_time'])],
    			['lt', strtotime($data['end_time'])],
    		];
    	}
    	if(!empty($data['designer'])) {
    		$sdata['designer'] = $data['designer'];
    	}
    
    	if(!empty($data['name'])) {
    		$sdata['name'] = ['like', '%'.$data['name'].'%'];
        }
        //客户状态-1 已删除 0未成交 1未审核 2已审核
        $sdata['status'] = ['eq',0];

        $customer = $this->obj->getNormalCustomers($sdata);
        //dump($customer);exit;
        return $this->fetch('', [
            'entry_date' => empty($data['entry_date']) ? '' : $data['entry_date'], 
        	'start_time' => empty($data['start_time']) ? '' : $data['start_time'],
        	'end_time' => empty($data['end_time']) ? '' : $data['end_time'],
        	'name' => empty($data['name']) ? '' : $data['name'],
            'customer' => $customer,
         ]);
    }

   
  
}
	