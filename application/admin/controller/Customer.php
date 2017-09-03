<?php
namespace app\admin\controller;
use think\Controller;
class Customer extends  Controller
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
        $data = input('post.');
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
            'entry_date' => $data['entry_date'],
            'cus_phone' => $data['cus_phone'],
            'cell_address' => $data['cell_address'],
            'brand' => $data['brand'],
            'floor_space' => $data['floor_space'],
            'contract_date' => $data['contract_date'], 
            'submitter' => $data['submitter'],
            'cus_level' => $data['cus_level'],
            'description' => empty($data['description']) ? '' : $data['description'],
            'source' =>  $data['source'],
            
        ];
        $cusId = model('Customer')->add($cusData);
        // 总店相关信息检验

        $data['cat'] = '';
        if(!empty($data['se_category_id'])) {
            $data['cat'] = implode('|', $data['se_category_id']);
        }
        // 总店相关信息入库
        $locationData = [
            'bis_id' => $bisId,
            'name' => $data['name'],
            'logo' => $data['logo'],
            'tel' => $data['tel'],
            'contact' => $data['contact'],
            'category_id' => $data['category_id'],
            'category_path' => $data['category_id'] . ',' . $data['cat'],
            'city_id' => $data['city_id'],
            'city_path' => empty($data['se_city_id']) ? $data['city_id'] : $data['city_id'].','.$data['se_city_id'],
            'api_address' => $data['address'],
            'open_time' => $data['open_time'],
            'content' => empty($data['content']) ? '' : $data['content'],
            'is_main' => 1,// 代表的是总店信息
            'xpoint' => empty($lnglat['result']['location']['lng']) ? '' : $lnglat['result']['location']['lng'],
            'ypoint' => empty($lnglat['result']['location']['lat']) ? '' : $lnglat['result']['location']['lat'],
        ];
        $locationId = model('BisLocation')->add($locationData);

        // 账户相关的信息检验
        // 自动生成 密码的加盐字符串
        $data['code'] = mt_rand(100, 10000);
        $accounData = [
            'bis_id' => $bisId,
            'username' => $data['username'],
            'code' => $data['code'],
            'password' => md5($data['password'].$data['code']),
            'is_main' => 1, // 代表的是总管理员
        ];

        $accountId = model('BisAccount')->add($accounData);
        if(!$accountId) {
            $this->error('申请失败');
        }

        // 发送邮件
        /*$url = request()->domain().url('bis/register/waiting', ['id'=>$bisId]);
        $title = "o2o入驻申请通知";
        $content = "您提交的入驻申请需等待平台方审核，您可以通过点击链接<a href='".$url."' target='_blank'>查看链接</a> 查看审核状态";
        \phpmailer\Email::send($data['email'],$title, $content);*/  // 线上关闭 发送邮件服务

        $this->success('申请成功', url('register/waiting',['id'=>$bisId]));

    }

}
	