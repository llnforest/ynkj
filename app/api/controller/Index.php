<?php
namespace app\api\controller;



use model\BaseBannerModel;
use model\BaseBetterModel;
use model\BaseLabelModel;
use model\BaseNoticeModel;
use model\HouseModel;

class Index extends BaseController{

    //构造函数
    public function __construct(){
        parent::__construct();
    }

    //首页
    public function index(){
        $this->data['top'] = BaseBannerModel::where(['updown'=>1,'type'=>1])->order('sort asc')->limit(5)->select();
        $this->data['center'] = BaseBannerModel::where(['updown'=>1,'type'=>2])->order('sort asc')->limit(4)->select();
        $this->data['label'] = BaseLabelModel::order('sort asc')->limit(5)->select();
        $this->data['notice'] = BaseNoticeModel::order('sort asc,create_time desc')->limit(5)->select();
        $this->data['house'] = HouseModel::alias('a')
            ->join('tp_house_search b','a.fangxing = b.id','left')
            ->join('tp_house_image c','a.id = c.house_id','left')
            ->where(['a.status'=>1,'a.is_commend'=>1])
            ->field('a.*,b.term as fangxing_name,c.url')
            ->order('a.sort asc,c.sort asc')
            ->group('a.id')
            ->limit('5')
            ->select();
        foreach($this->data['house'] as &$v){
            if($v['better_ids']) $v['betterList'] = BaseBetterModel::where(['id'=>['in',$v['better_ids']]])->order('sort asc')->select();
            else $v['better_ids'] = [];
        }
        return json(['code'=>1,'data'=>$this->data]);
    }


}