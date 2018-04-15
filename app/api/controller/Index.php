<?php
namespace app\api\controller;



use model\BaseBannerModel;
use model\BaseBetterModel;
use model\BaseLabelModel;
use model\BaseNoticeModel;
use model\HouseModel;
use think\Config;

class Index extends BaseController{

    //构造函数
    public function __construct(){
        parent::__construct();
    }

    //首页
    public function index(){
        $this->data['token'] = $this->param['token'];
        //顶部banner
        $this->data['top'] = BaseBannerModel::where(['updown'=>1,'type'=>1])->order('sort asc')->limit(5)->select();
        foreach($this->data['top'] as $v){
            $v['url'] = $this->imgHost.str_replace('\\','/',$v['url']);
        }
        //中部banner
        $this->data['center'] = BaseBannerModel::where(['updown'=>1,'type'=>2])->order('sort asc')->limit(4)->select();
        foreach($this->data['center'] as $v){
            $v['url'] = $this->imgHost.str_replace('\\','/',$v['url']);
        }
        //标签
        $this->data['label'] = BaseLabelModel::order('sort asc')->limit(5)->select();
        foreach($this->data['label'] as $v){
            $v['url'] = $this->imgHost.str_replace('\\','/',$v['url']);
        }
        //热点通知
        $this->data['notice'] = BaseNoticeModel::field('id,title')->order('sort asc,create_time desc')->limit(5)->select();
        //房屋列表
        $this->data['house'] = HouseModel::alias('a')
            ->join('tp_base_search b','a.fangxing = b.id','left')
            ->join('tp_house_image c','a.id = c.house_id','left')
            ->where(['a.status'=>1,'a.is_commend'=>1])
            ->field('a.*,b.term as fangxing_name,c.url')
            ->order('a.sort asc,c.sort asc')
            ->group('a.id')
            ->limit('5')
            ->select();
        foreach($this->data['house'] as &$v){
            $v['url'] = $this->imgHost.str_replace('\\','/',$v['url']);
            if($v['better_ids']) $v['betterList'] = BaseBetterModel::where(['id'=>['in',$v['better_ids']]])->order('sort asc')->limit(4)->select();
            else $v['better_ids'] = [];
        }
//        return json(['code' =>0,'msg'=>'尚未登录','url'=>'source://view/login/main.ui']);
        return json(['code'=>1,'data'=>$this->data]);
    }


}