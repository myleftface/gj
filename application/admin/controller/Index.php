<?php
namespace app\admin\controller;
use think\Controller;
class Index extends Base
{
    public function index(){
        return $this->fetch();
    }

    public function welcome() {
      
        return $this->fetch();
        
    }
    public function cus_add(){
        
        return $this ->fetch();
    }
    public function performance(){
        
        return $this ->fetch();
    }
    public function feedback(){
        
        return $this ->fetch();
    }
}