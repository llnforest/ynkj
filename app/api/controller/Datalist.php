<?php
namespace app\api\controller;




use model\BaseLabelModel;
use model\HouseModel;
use model\UserFavouriteModel;
use model\UserModel;
use model\UserRecordModel;
use model\UserRequestImageModel;
use model\UserRequestModel;
use model\UserReserveModel;
use think\Config;
use think\Validate;

class Datalist extends DefaultController {

    //构造函数
    public function __construct(){
        parent::__construct();
    }

    //关注列表页
    public function NoticeList(){
        $count = 15;
        $orderBy  = 'a.create_time desc';
        $this->data['house'] = UserFavouriteModel::alias('a')
            ->join('tp_house b','a.house_id = b.id','left')
            ->where(['a.user_id'=>$this->userData['id']])
            ->field('a.*,b.title')
            ->order($orderBy)
            ->limit($this->param['page'] * $count,$count)
            ->select();
        return json(['code'=>1,'data'=>$this->data]);
    }

    //看房列表页
    public function RecordList(){
        $count = 15;
        $orderBy  = 'a.create_time desc';
        $this->data['house'] = UserRecordModel::alias('a')
            ->join('tp_house b','a.house_id = b.id','left')
            ->where(['a.user_id'=>$this->userData['id']])
            ->field('a.*,b.title')
            ->order($orderBy)
            ->limit($this->param['page'] * $count,$count)
            ->select();
        return json(['code'=>1,'data'=>$this->data]);
    }

    //预约列表页
    public function ReserveList(){
        $count = 15;
        $orderBy  = 'a.create_time desc';
        $this->data['house'] = UserReserveModel::alias('a')
            ->join('tp_house b','a.house_id = b.id','left')
            ->join('tp_admin c','a.admin_id = c.id','left')
            ->where(['a.user_id'=>$this->userData['id']])
            ->field('a.*,b.title,c.nick_name')
            ->order($orderBy)
            ->limit($this->param['page'] * $count,$count)
            ->select();
        return json(['code'=>1,'data'=>$this->data]);
    }
}