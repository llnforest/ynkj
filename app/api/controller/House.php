<?php
namespace app\api\controller;



use model\BaseBetterModel;
use model\BaseLabelModel;
use model\BaseSearchModel;
use model\HouseDetailModel;
use model\HouseImageModel;
use model\HouseModel;
use model\UserFavouriteModel;
use model\UserModel;
use think\Config;

class House extends BaseController{

    //构造函数
    public function __construct(){
        parent::__construct();
    }

    //房源资料页
    public function index(){
        $this->data['house'] = HouseModel::alias('a')
            ->join('tp_base_search b','a.fangxing = b.id','left')
            ->join('tp_admin c','a.admin_id = c.id','left')
            ->where(['a.id'=>$this->id])
            ->field('a.*,b.term as fangxing_name,c.phone')
            ->find();
        if($this->data['house']['better_ids']) $this->data['betterList'] = BaseBetterModel::where(['id'=>['in',$this->data['house']['better_ids']]])->order('sort asc')->select();
        else $this->data['betterList'] = [];
        $this->data['imgList'] = HouseImageModel::where(['house_id' =>$this->id])->order('sort asc')->select();
        foreach($this->data['imgList'] as &$v){
            $v['url'] = $this->imgHost.str_replace('\\','/',str_replace('_thumb','',$v['url']));
        }
        return json(['code'=>1,'data'=>$this->data]);
    }

    //房源详情页
    public function detail(){
        $this->data['detail'] = HouseDetailModel::alias('a')
            ->join('tp_house c','a.house_id = c.id','left')
            ->join('tp_admin b','b.id = c.admin_id','left')
            ->where(['house_id' =>$this->id])
            ->field('a.*,b.phone')
            ->find();
        return json(['code'=>1,'data'=>$this->data]);
    }

    //房源列表页
    public function houseList(){
        $count = 10;
        $orderBy  = 'a.sort asc,a.update_time desc,c.sort';
        $where  = getWhereParam(['a.label_id'],$this->param);
        $where['a.status'] = 1;
        if(!empty($this->param['jiage'])){
            $price_between = BaseSearchModel::get($this->param['jiage']);
            $where['a.per_price'] = priceSplit($price_between['term']);
        }
        if(!empty($this->param['fangxing'])) $where['a.fangxing'] = $this->param['fangxing'];
        if(!empty($this->param['quyu'])) $where['a.quyu'] = $this->param['quyu'];
        $this->data['house'] = HouseModel::alias('a')
            ->join('tp_base_search b','a.fangxing = b.id','left')
            ->join('tp_house_image c','a.id = c.house_id','left')
            ->where($where)
            ->field('a.*,b.term as fangxing_name,c.url')
            ->order($orderBy)
            ->group('a.id')
            ->limit($this->param['page'] * $count,$count)
            ->select();
        foreach($this->data['house'] as &$v){
            $v['url'] = $this->imgHost.str_replace('\\','/',$v['url']);
            if($v['better_ids']) $v['betterList'] = BaseBetterModel::where(['id'=>['in',$v['better_ids']]])->order('sort asc')->select();
            else $v['betterList'] = [];
        }
        $this->data['quyu'] = BaseSearchModel::where(['type'=>1])->field('id,term,0 as selected')->order('sort asc')->select();
        $this->data['jiage'] = BaseSearchModel::where(['type'=>2])->field('id,term,0 as selected')->order('sort asc')->select();
        $this->data['fangxing'] = BaseSearchModel::where(['type'=>3])->field('id,term,0 as selected')->order('sort asc')->select();
        if($this->param['page'] == 0){
            $label = BaseLabelModel::get($this->param['label_id']);
            $this->data['label'] = $label['name'];
        }
        return json(['code'=>1,'data'=>$this->data]);
    }

    //判断是否关注
    public function isNotice(){
        $token = !empty($this->param['token'])?$this->param['token']:'000';
        $user = UserModel::get(['token' => $token,'status' => 1]);
        if(empty($user)) return json(['code'=>1,'data'=>false]);
        $user = UserFavouriteModel::get(['user_id' => $user['id'],'house_id' => $this->param['house_id']]);
        if(empty($user)) return json(['code'=>1,'data'=>false]);
        else return json(['code'=>1,'data'=>true]);
    }

}