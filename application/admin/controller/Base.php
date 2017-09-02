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
        //  $department = model('Department')->getDpartment();
        //  $this->assgin('department',$department);
        //  $this->assign('id',$id);
        //  $this->assign('d_name',$d_name);

         //获取当前用户
         $this->assign('user', $this->getLoginUser());
      
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

    }

 


