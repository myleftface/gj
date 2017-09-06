<?php
namespace app\admin\controller;
use think\Controller;
class Cusuncheck extends  Base
{
    private $obj;
    public function _initialize(){

        $this->obj = model('Customer');
        $this->assign('user', $this->getLoginUser());
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
        $sdata['status'] = ['eq',1];
        //返回当前用户提交的客户数据，如果是总监则返回全部
       $user = $this->getLoginUser();
       $uid = $user->id;
        // dump($uid);
        $department = model('User')->getUserDepartmentById($uid);
        //dump($department->department);exit;
        if($department->department != 1){
           // echo $department->department;exit;
            $sdata['submitter'] = $user->username;
            //dump($sdata);exit;
        }

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
	