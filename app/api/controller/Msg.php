<?php
namespace app\api\controller;



use model\BaseNoticeModel;

class Msg extends BaseController{

    //构造函数
    public function __construct(){
        parent::__construct();
    }

    //通知列表页
    public function houseList(){
        $count = 15;
        $orderBy  = 'a.sort asc,a.update_time desc';
        $this->data['notice'] = BaseNoticeModel::order($orderBy)
            ->limit($this->param['page'] * $count,$count)
            ->select();
        return json(['code'=>1,'data'=>$this->data]);
    }

    //通知详情页
    public function detail(){
        $this->data['detail'] = BaseNoticeModel::alias('a')
            ->join('tp_admin b','a.agent_id = b.id','left')
            ->where(['id' => $this->id])
            ->field('a.*,b.phone')
            ->find();
        return json(['code'=>1,'data'=>$this->data]);
    }



}