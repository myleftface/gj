<?php
namespace app\admin\controller;
use think\Controller;
class Cusfeedback extends  Base
{
    private  $obj;
     public function _initialize() {
         $this->obj = model("Customer");
         $this->assign('user', $this->getLoginUser());
     }
    /**
     * 未删除的客户列表
     * @return mixed
     */
    public function index() {
        $data = input('get.');
    	$sdata = [];
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
         $sdata['status'] = ['gt',0];
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
        return $this->fetch('', [
        	'entry_date' => empty($data['entry_date']) ? '' : $data['entry_date'], 
        	'start_time' => empty($data['start_time']) ? '' : $data['start_time'],
        	'end_time' => empty($data['end_time']) ? '' : $data['end_time'],
        	'name' => empty($data['name']) ? '' : $data['name'],
            'customer' => $customer,
        ]);

    }
    //客户回访填写
   
    
    public function feedback($id=0) {
        if(intval($id) < 1) {
            $this->error('参数不合法');
        }
        
        $customer = model('Customer')->get($id);
        
        return $this->fetch('', [
            'customer'=> $customer,
        ]);
    }


    public function fbsave() {

        
        //print_r($_POST);
        //print_r(input('post.'));
        //print_r(request()->post());
        /**
         * 做下严格判定
         */
        if(!request()->isPost()) {
            $this->error('请求失败');
        }
       
        $data = input('post.','','htmlentities');
        //dump($data);exit;
        //halt($data);
        //echo 12;exit;
        ///$data['status'] = 10;
        //debug('begin');
        $validate = validate('feedback');
        //$data['id'] = htmlentities($data['id']);
        if(!$validate->scene('update')->check($data)) {
            $this->error($validate->getError());
        }
        // 客户基本信息入库
         $fdData = [
            'cus_id' => $data['id'],
            'status' => 1,
            'feedback' => empty($data['feedback']) ? '' : $data['feedback'],
            'fb_date' => empty($data['fb_date']) ? '' : strtotime($data['fb_date']), 
            'next_date' => empty($data['next_date']) ? '' : strtotime($data['next_date']), 
        ];
        if(!empty($data['id'])) {
            return $this->fbupdate($fdData);
        }
        //debug('end');
       // echo debug('begin', 'end','m');exit;

      
    }
    public function fbupdate($data) {
           //dump($data);exit;
         $validate = validate('Feedback');
        if(!$validate->scene('update')->check($data)) {
            $this->error($validate->getError());
        }      

        $res = model('Feedback')->save($data);
        if($res) {
            $this->success('客户回访更新成功');
        } else {
            $this->error('客户回访更新失败');
        }
    }

    public function fbdetail() {
        $cus_id = input('get.id');
        if(empty($cus_id)) {
            return $this->error('没有回访数据');
        }
        //获取提交人的数据
         $user = model('Customer')->getCustomerById($cus_id);
        // 获取回访数据
        $fbData = model('Feedback')->getFeedback($cus_id);
       // dump($fbData);exit;
        return $this->fetch('',[
            'user' => $user,
            'fbData' => $fbData,
            ]);
    }

}
