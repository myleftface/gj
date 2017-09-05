<?php
namespace app\admin\controller;
use think\Controller;
class Customerlist extends  Base
{
    private  $obj;
    public function _initialize() {
        $this->obj = model("Customer");
    }
    /**
     * 正常的客户列表
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
    	// if(!empty($data['city_id'])) {
    	// 	$sdata['city_id'] = $data['city_id'];
    	// }
    	if(!empty($data['name'])) {
    		$sdata['name'] = ['like', '%'.$data['name'].'%'];
    	}
    	// $cityArrs = $categoryArrs = [];
        // $categorys = model("Category")->getNormalCategoryByParentId();
        // foreach($categorys as $category) {
        // 	$categoryArrs[$category->id] = $category->name;
        // }

        // $citys = model("City")->getNormalCitys();
        // foreach($citys as $city) {
        // 	$cityArrs[$city->id] = $city->name;
        // }
        

        $customer = $this->obj->getNormalCustomers($sdata);
        return $this->fetch('', [
            //'designer' => empty($data['designer']) ? '': $data['designer'],
        	'entry_date' => empty($data['entry_date']) ? '' : $data['entry_date'], 
        	'start_time' => empty($data['start_time']) ? '' : $data['start_time'],
        	'end_time' => empty($data['end_time']) ? '' : $data['end_time'],
        	'name' => empty($data['name']) ? '' : $data['name'],
            'customer' => $customer,
        ]);
    



       //$customer = $this->obj->getCustomerByStatus(1);
        //获取当前用户
       $this->assign('user', $this->getLoginUser());
        
        // return $this->fetch('', [
        //     'customer' => $customer,
          
        // ]);
        
    }
    /**
     * 待审核用户列表
     * @return mixed
     */
    // public function getCustomerNonChecked() {
    //     $customer = $this->obj->getCustomerByStatus();
    //     return $this->fetch('', [
    //         'customer' => $customer,
    //     ]);
    // }

    public function detail() {
        $id = input('get.id');
        if(empty($id)) {
            return $this->error('ID错误');
        }
        //获取提交人的数据
        $user = model('User')->getAllUser();
        //获取一级栏目的数据
       // $categorys = model('Category')->getNormalCategoryByParentId();
        // 获取客户数据
        $cusData = model('Customer')->get($id);
        //$locationData = model('BisLocation')->get(['bis_id'=>$id, 'is_main'=>1]);
        //$accountData = model('BisAccount')->get(['bis_id'=>$id, 'is_main'=>1]);
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

        $res = $this->obj->save(['status'=>$data['status']], ['id'=>$data['id']]);
        if($res) {
           
            $this->success('状态更新成功');
        }else {
            $this->error('状态更新失败');
        }

    }

}
