<?php
namespace app\api\controller;



use model\BaseBetterModel;
use model\BaseSearchModel;
use model\HouseDetailModel;
use model\HouseImageModel;
use model\HouseModel;
use model\UserFavouriteModel;

class House extends BaseController{

    //构造函数
    public function __construct(){
        parent::__construct();
    }

    //房源资料页
    public function house(){
        $this->data['house'] = HouseModel::alias('a')
            ->join('tp_house_search b','a.fangxing = b.id','left')
            ->join('tp_admin c','a.agent_id = b.id','left')
            ->where(['id'=>$this->id])
            ->field('a.*,b.term as fangxing_name,c.phone')
            ->find();
        if($this->data['house']['better_ids']) $this->data['betterList'] = BaseBetterModel::where(['id'=>['in',$v['better_ids']]])->order('sort asc')->select();
        else $this->data['betterList'] = [];
        $this->data['imgList'] = HouseImageModel::where(['house_id' =>$this->id])->order('sort asc')->select();
        foreach($this->data['imgList'] as &$v){
            $v['url'] = str_replace('_thumb','',$v['url']);
        }
        return json(['code'=>1,'data'=>$this->data]);
    }

    //房源详情页
    public function detail(){
        $this->data['detail'] = HouseDetailModel::alias('a')
            ->join('tp_admin b','b.id = a.agent_id','left')
            ->where(['house_id' =>$this->id])
            ->field('a.*,b.phone')
            ->find();
        return json(['code'=>1,'data'=>$this->data]);
    }

    //房源列表页
    public function houseList(){
        $count = 10;
        $orderBy  = 'a.sort asc,a.update_time desc,c.sort';
        $where  = getWhereParam(['a.fangxing','a.label_id','a.quyu'],$this->param);
        $where['status'] = 1;
        if(!empty($this->param['price'])){
            $price_between = BaseSearchModel::get($this->param['price']);
            $where['a.per_price'] = $price_between;
        }
        $this->data['house'] = HouseModel::alias('a')
            ->join('tp_house_search b','a.fangxing = b.id','left')
            ->join('tp_house_image c','a.id = c.house_id','left')
            ->where(['a.status'=>1,'a.is_commend'=>1])
            ->field('a.*,b.term as fangxing_name,c.url')
            ->order($orderBy)
            ->group('a.id')
            ->limit($this->param['page'] * $count,$count)
            ->select();
        foreach($this->data['house'] as &$v){
            if($v['better_ids']) $v['betterList'] = BaseBetterModel::where(['id'=>['in',$v['better_ids']]])->order('sort asc')->select();
            else $v['better_ids'] = [];
        }
        return json(['code'=>1,'data'=>$this->data]);
    }

    //判断是否关注
    public function isNotice(){
        $token = !empty($this->param['token'])?$this->param['token']:'000';
        $user = UserModel::get(['token' => $token,'status' => 1]);
        if(empty($user)) return ['code'=>1,'data'=>false];
        $user = UserFavouriteModel::get(['user_id' => $user['id'],'house_id' => $this->param['house_id']]);
        if(empty($user)) return ['code'=>1,'data'=>false];
        else return ['code'=>1,'data'=>true];
    }

}