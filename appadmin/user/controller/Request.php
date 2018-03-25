<?php
/**
 * author: Lynn
 * since: 2018/3/23 13:05
 */
namespace admin\user\controller;

use admin\index\controller\BaseController;
use model\BaseLabelModel;
use model\UserRequestImageModel;
use model\UserRequestModel;
use think\Config;


class Request extends BaseController{
    //构造函数
    public function __construct(){
        parent::__construct();
    }

    //需求列表页
    public function index(){
        $orderBy  = 'create_time desc';
        $where  = getWhereParam(['a.status','a.type','a.label_id','b.phone'=>'like','c.nick_name'=>'like','a.create_time'=>['start','end']],$this->param);
        if(!empty($this->param['order'])) $orderBy = $this->param['order'].' '.$this->param['by'];
        if($this->admin['is_agent'] == 1) $where['a.admin_id'] = ['in','0,'.$this->admin['id']];
        $data['list'] = UserRequestModel::alias('a')
            ->join('tp_user b','a.user_id = b.id','left')
            ->join('tp_admin c','a.admin_id = c.id','left')
            ->join('tp_base_label d','a.label_id = d.id','left')
            ->field('a.*,b.phone,b.name,c.nick_name,d.name as label_name')
            ->where($where)
            ->order($orderBy)
            ->paginate($this->config_page,'',['query'=>$this->param]);
        $data['page']   = $data['list']->render();
        $data['labelList'] = BaseLabelModel::order('sort asc')->select();
        return view('index',$data);
    }

    // 删除需求
    public function requestDelete(){
        if($this->request->isPost()) {
            $result = UserRequestModel::get($this->id);
            $imageList = UserRequestImageModel::all(['request_id' => $this->id]);
            foreach($imageList as $item){
                @unlink(Config::get('upload.path').$item['url']);
            }
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            return operateResult($result->delete(),'request/index','del');
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }

    // 审核需求
    public function requestCheck(){
        $data['info'] = UserRequestModel::alias('a')
                        ->join('tp_user b','a.user_id = b.id','left')
                        ->join('tp_admin c','a.admin_id = c.id','left')
                        ->join('tp_base_label d','a.label_id = d.id','left')
                        ->field('a.*,b.phone,b.name,c.nick_name,d.name as label_name')
                        ->where(['a.id' =>$this->id])
                        ->find();
        if($this->request->isPost()) {
            $result = UserRequestModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            return operateResult($data['info']->save($this->param),'request/index','status');
        }
        $data['imgList'] = UserRequestImageModel::all(['request_id'=>$this->id]);
        return view('request/requestCheck',$data);
    }

}