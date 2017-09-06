<?php
namespace app\admin\controller;
use think\Controller;

class Base extends Controller {
    public $account = '';
   
    public function _initialize(){
         // 判定用户是否登录
         $isLogin = $this->isLogin();
         if(!$isLogin) {
             return $this->redirect('user/login');
         }
         //部门数据
         $department = model('Department')->getDepartment();
          $this->assign('department',$department);
        //设计师数据
         $submitter = model('User')->getAllUserByDepartment();
         $this->assign('submitter',$submitter);

         //获取当前用户
         $this->assign('user', $this->getLoginUser());
        //获取客户
        // $customers = model("Customer");
       
    }
        //获取部门名称    
      
       //判定是否登录
       public function isLogin() {
        // 获取sesssion
        $user = $this->getLoginUser();
        if($user && $user->id) {
            return true;
        }
        return false;

    }
 
    public function getLoginUser(){
        if(!$this->account){
            $this->account = session('gj_user','','gj');
        }
        return $this->account;
    }



    public function detail() {
        $id = input('get.id');
        if(empty($id)) {
            return $this->error('ID错误');
        }
        //获取提交人的数据
        $user = model('User')->getAllUser();
        // 获取客户数据
        $cusData = model('Customer')->get($id);
        return $this->fetch('',[
            'user' => $user,
            'cusData' => $cusData,
            // 'name' => empty($data['name']) ? '' : $data['name'],
            // 'entry_date' => empty($data['entry_date']) ? '' : strtotime($data['entry_date']), 
            // 'cell_phone' => empty($data['cell_phone']) ? '' : $data['cell_phone'],
            // 'cell_address' => empty($data['cell_address']) ? '' : $data['cell_address'],
            // 'brand' => empty($data['brand']) ? '' : $data['brand'],
            // 'floor_space' => empty($data['floor_space']) ? '' : $data['floor_space'],
            // 'contract_id' => empty($data['contract_id']) ? '' : $data['contract_id'],
            // 'contract_date' => empty($data['contract_date']) ? '' : strtotime($data['contract_date']), 
            // 'handover_date' => empty($data['handover_date']) ? '' : strtotime($data['handover_date']), 
            // 'submitter' => empty($data['submitter']) ? '' : $data['submitter'],
            // 'cus_levle' => empty($data['cus_levle']) ? '' : $data['cus_levle'],
            // 'description' => empty($data['description']) ? '' : $data['description'],
            // 'total_value' => empty($data['total_value']) ? '' : $data['total_value'],
            // 'paymentstatus' => empty($data['paymentstatus']) ? '' : $data['paymentstatus'],
            // 'source' => empty($data['source']) ? '' : $data['source'],
            ]);
    }


    // 修改状态
    public function status() {
        $data = input('get.');
        // 检验
         $validate = validate('Customer');
         if(!$validate->scene('status')->check($data)) {
             $this->error($validate->getError());
         }

        $res = model('Customer')->save(['status'=>$data['status']], ['id'=>$data['id']]);
        if($res) {
           
            $this->success('状态更新成功');
        }else {
            $this->error('状态更新失败');
        }

    }
   

    public function report($id=0) {
        if(intval($id) < 1) {
            $this->error('参数不合法');
        }
        
        $customer = model('Customer')->get($id);
        
        return $this->fetch('', [
            'customer'=> $customer,
        ]);
    }

    public function save() {
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
        $validate = validate('Customer');
        //$data['id'] = htmlentities($data['id']);
        if(!$validate->scene('update')->check($data)) {
            $this->error($validate->getError());
        }
        // 客户基本信息入库
         $cusData = [
            'id' => $data['id'],
            'status' => 1,
            'contract_id' => empty($data['contract_id']) ? '' : $data['contract_id'],
            'contract_date' => empty($data['contract_date']) ? '' : strtotime($data['contract_date']), 
            'handover_date' => empty($data['handover_date']) ? '' : strtotime($data['handover_date']), 
            'start_date' => empty($data['start_date']) ? '' : strtotime($data['start_date']), 
            'total_value' => empty($data['total_value']) ? '' : $data['total_value'],
            'payment_status' => empty($data['payment_status']) ? '' : $data['payment_status'],
            'design_fee' => empty($data['design_fee']) ? '' : $data['design_fee'],
                
        ];
        if(!empty($data['id'])) {
            return $this->update($cusData);
        }
        //debug('end');
       // echo debug('begin', 'end','m');exit;

      
    }
    public function update($data) {
           //dump($data);exit;
         $validate = validate('Customer');
        if(!$validate->scene('update')->check($data)) {
            $this->error($validate->getError());
        }      

        $res = model('Customer')->save($data, ['id' => intval($data['id'])]);
        if($res) {
            $this->success('业绩上报成功');
        } else {
            $this->error('业绩上报失败');
        }
    }


    }

 


