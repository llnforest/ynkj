<?php
/**
 * author: Lynn
 * since: 2018/3/23 12:05
 */
namespace admin\user\controller;

use admin\index\controller\BaseController;
use model\UserReserveModel;


class Reserve extends BaseController{
    //构造函数
    public function __construct(){
        parent::__construct();
    }

    //预约列表页
    public function index(){
        $orderBy  = 'create_time desc';
        $where  = getWhereParam(['a.status','b.phone'=>'like','c.title'=>'like','d.nick_name'=>'like','a.reserve_date'=>['start','end']],$this->param);
        if(!empty($this->param['order'])) $orderBy = $this->param['order'].' '.$this->param['by'];
        if($this->admin['is_agent'] == 1) $where['a.admin_id'] = ['in','1,'.$this->admin['id']];
        $data['list'] = UserReserveModel::alias('a')
            ->join('tp_user b','a.user_id = b.id','left')
            ->join('tp_house c','a.house_id = c.id','left')
            ->join('tp_admin d','a.admin_id = d.id','left')
            ->field('a.*,b.phone,b.name,c.title,d.nick_name')
            ->where($where)
            ->order($orderBy)
            ->paginate($this->config_page,'',['query'=>$this->param]);
        $data['page']   = $data['list']->render();
        return view('index',$data);
    }

    // 删除预约
    public function reserveDelete(){
        if($this->request->isPost()) {
            $result = UserReserveModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            return operateResult($result->delete(),'reserve/index','del');
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }

    // 取消预约
    public function operateReserve(){
        if($this->request->isPost()) {
            $result = UserReserveModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            $data = [$this->param['name'] => $this->param['data']];
            return switchResult($result->save($data),'status');
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }

    //确认预约
    public function checkSuccess(){
        $data['info'] = UserReserveModel::get($this->id);
        if($this->request->isPost()){
            $result['reserve_date'] = $this->param['reserve_date'];
            if (empty($result['reserve_date'])) return ['code' => 0, 'msg' => lang('sys_param_error')];
            $result['status'] = 1;
            if($data['info']->save($result)){
                return ['code' => 1, 'msg' =>'预约成功','parents_url'=>url('reserve/index')];
            } else {
                return ['code' => 0, 'msg' => '预约失败'];
            }
        }
        return view('checkSuccess',$data);
    }
}