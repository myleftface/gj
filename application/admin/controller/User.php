<?php
namespace app\admin\controller;
use think\Controller;

class User extends Base
{   
    private  $obj;
    public function _initialize() {
        $this->obj = model("User");
    }

    public function index()
    {
        $users = $this->obj->getAllUser();
        return $this->fetch('',[
            'users'=>$users,
        ]);
    }

    public function login()
    {
        //return [1,2];
        // 获取session
        $user = session('gj_user','', 'gj');
        if($user && $user->id) {
           $this->redirect(url('user/register'));
        }
        return $this->fetch();
    }
    public function register()
    {
        if(request()->isPost()){
            $data = input('post.','','htmlentities');

            if(!captcha_check($data['verifycode'])) {
                // 校验失败
                $this->error('验证码不正确');
            }
            //严格校验 tp5 validate

            if($data['password'] != $data['repassword']) {
                $this->error('两次输入的密码不一样');
            }
            // 自动生成 密码的加盐字符串
            $data['code'] = mt_rand(100, 10000);
            $data['password'] = md5($data['password'].$data['code']);
            //$data = 12;// test
            try {
                $res = model('User')->add($data);
            }catch (\Exception $e) {
                $this->error($e->getMessage());
            }
            if($res) {
                $this->success('注册成功，请通知管理员审核',url('user/login'));
            }else{
                $this->error('注册失败');
            }

        }else {
           
            return $this->fetch();
            
        }
       
    }

    public function logincheck() {
        //判定
        if(!request()->isPost()) {
           $this->error('提交不合法');
        }
        $data = input('post.','','htmlentities');
        //严格检验 tp5 validate

        try {
            $user = model('User')->getUserByUsername($data['username']);
        }catch (\Exception $e){
            $this->error($e->getMessage());
        }
        ///print_r($user);

        if(!$user || $user->status != 1) {
            $this->error('用户不存在，或未通过审核');
        }
        // 判定密码是否合理
        if(md5($data['password'].$user->code) != $user->password) {
            $this->error('密码不正确');
        }

        // 登录成功
        model('User')->updateById(['last_login_time'=>time()], $user->id);

        //把用户信息记录到session
        session('gj_user', $user, 'gj');

        $this->success('登录成功', url('index/index'));

    }

    public function logout() {
        session(null, 'gj');
        $this->redirect('user/login');
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
        $validate = validate('user');
        $data['username'] = htmlentities($data['username']);
        if(!$validate->scene('add')->check($data)) {
            $this->error($validate->getError());
        }
        if(!empty($data['department'])) {
            return $this->update($data);
        }
        //debug('end');
        //echo debug('begin', 'end','m');exit;

        // 把$data 提交model层
        $res = $this->obj->add($data);
        if($res) {
            $this->success('新增成功');
        }else {
            $this->error('新增失败');
        }
    }
  

    public function update($data) {
        $res =  $this->obj->save($data, ['department' => intval($data['department'])]);
        if($res) {
            $this->success('更新成功');
        } else {
            $this->error('更新失败');
        }
    }


    // public function status() {
    //     $data = input('get.');
    //     $validate = validate('User');
    //     if(!$validate->scene('status')->check($data)) {
    //         $this->error($validate->getError());
    //     }

    //     $res = $this->obj->save(['status'=>$data['status']], ['id'=>$data['id']]);
    //     if($res) {
    //         $this->success('状态更新成功');
    //     }else {
    //         $this->error('状态更新失败');
    //     }

    // }

      // 修改状态
      public function status() {
        $data = input('get.');
        // 检验小伙伴自行完成
        $validate = validate('User');
        if(!$validate->scene('status')->check($data)) {
            $this->error($validate->getError());
        }

        $res = $this->obj->save(['status'=>$data['status']], ['id'=>$data['id']]);
       // $location = model('BisLocation')->save(['status'=>$data['status']], ['bis_id'=>$data['id'], 'is_main'=>1]);
       // $account = model('BisAccount')->save(['status'=>$data['status']], ['bis_id'=>$data['id'], 'is_main'=>1]);
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
