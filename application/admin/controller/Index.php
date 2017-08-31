<?php
namespace app\admin\controller;
use think\Controller;
class Index extends Controller
{
    public function index()
    { 
       $this->assign('name','waynehall');
        return $this->fetch();
    }
    public function welcome() {
      
        return $this->fetch();
        
    }
    public function cus_add(){
        
        return $this ->fetch();
    }
}