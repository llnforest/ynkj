<?php
/**
 * author: Lynn
 * since: 2018/3/23 12:05
 */
namespace admin\house\controller;

use admin\index\controller\BaseController;
use chromephp\chromephp;
use model\BaseLabelModel;
use model\BaseSearchModel;
use model\HouseDetailModel;
use model\HouseImageModel;
use model\HouseModel;
use model\UserRequestImageModel;
use model\UserRequestModel;
use think\Validate;


class House extends BaseController{

    private $roleValidate = ['title|房源名称' => 'require','price|房源售价' => 'require|number','mianji|房源面积' => 'number'];
    //构造函数
    public function __construct()
    {
        parent::__construct();
    }

    //房源列表页
    public function index(){
        $orderBy  = 'sort asc,update_time desc';
        $where  = getWhereParam(['a.fangxing','a.quyu','b.name','c.nick_name'=>'like','a.status','a.title'=>'like','a.update_time'=>['start','end']],$this->param);
        if(!empty($this->param['order'])) $orderBy = $this->param['order'].' '.$this->param['by'];

        $data['list'] = HouseModel::alias('a')
            ->join('tp_base_label b','a.label_id = b.id','left')
            ->join('tp_admin c','a.admin_id = c.id','left')
            ->join('tp_base_search d','a.quyu = d.id','left')
            ->join('tp_base_search e','a.fangxing = e.id','left')
            ->field('a.*,b.name as label_name,c.nick_name,d.term as quyu_name,e.term as fangxing_name')
            ->where($where)
            ->order($orderBy)
            ->paginate($this->config_page,'',['query'=>$this->param]);
        $data['page']   = $data['list']->render();
        $data['labelList'] = BaseLabelModel::order('sort asc')->select();
        $data['fangList'] = BaseSearchModel::where(['type'=>3])->order('sort asc')->select();
        $data['quList'] = BaseSearchModel::where(['type'=>1])->order('sort asc')->select();
        return view('index',$data);
    }

    //添加房源
    public function houseAdd(){
        if($this->request->isPost()){
            $validate = new Validate($this->roleValidate);
            if(!$validate->check($this->param)) return ['code' => 0, 'msg' => $validate->getError()];
            if($house = HouseModel::create($this->param)){
                HouseDetailModel::create(['house_id'=>$house['id'],'shuifeijiexi'=>$this->param['shuifeijiexi'],'zhuangxiumiaoshu'=>$this->param['zhuangxiumiaoshu'],'huxingjieshao'=>$this->param['huxingjieshao'],'hexinmaidian'=>$this->param['hexinmaidian']]);
                $imgList = json_decode($this->param['img_data'],true);
                if(count($imgList) > 0){
                    foreach($imgList as &$item){
                        $item['house_id'] = $house['id'];
                    }
                    $imgModel = new HouseImageModel();
                    $imgModel->saveAll($imgList);
                }
                //发布
                if(!empty($this->param['request_id'])) UserRequestModel::where(['id'=>$this->param['request_id']])->update(['status'=>3]);
            }
            return operateResult($house,'house/index','add');
        }
        if($this->id){//从需求处发布
            $request = UserRequestModel::get($this->id);
            $data = ['request_id'=>$this->id,'label_id'=>$request['label_id']];
            $data['imgList'] = UserRequestImageModel::all(['request_id' => $this->id]);
        }//从需求处发布
        $data['labelList'] = BaseLabelModel::order('sort asc')->select();
        $data['fangList'] = BaseSearchModel::where(['type'=>3])->order('sort asc')->select();
        $data['quList'] = BaseSearchModel::where(['type'=>1])->order('sort asc')->select();
        return view('houseAdd',$data);
    }

    //修改房源
    public function houseEdit(){
        $data['info'] = HouseModel::alias('a')
            ->join('tp_house_detail b','a.id = b.house_id','left')
            ->join('tp_admin c','a.admin_id = c.id','left')
            ->field('a.*,b.shuifeijiexi,b.zhuangxiumiaoshu,b.huxingjieshao,b.hexinmaidian,c.nick_name')
            ->where(['a.id'=>$this->id])
            ->find();
        if(!$data['info']) $this->error(lang('sys_param_error'));
        if($this->request->isPost()){
            $validate = new Validate($this->roleValidate);
            if(!$validate->check($this->param)) return ['code' => 0,'msg' => $validate->getError()];
            if($house = $data['info']->save($this->param)){
                HouseDetailModel::where(['house_id'=>$this->id])->update(['shuifeijiexi'=>$this->param['shuifeijiexi'],'zhuangxiumiaoshu'=>$this->param['zhuangxiumiaoshu'],'huxingjieshao'=>$this->param['huxingjieshao'],'hexinmaidian'=>$this->param['hexinmaidian']]);
                HouseImageModel::where(['house_id'=>$this->id])->delete();
                $imgList = json_decode($this->param['img_data'],true);
                if(count($imgList) > 0){
                    foreach($imgList as &$item){
                        $item['house_id'] = $this->id;
                    }
                    $imgModel = new HouseImageModel();
                    $imgModel->saveAll($imgList);
                }
            }
            return operateResult($house,'house/index','edit');
        }
        $data['labelList'] = BaseLabelModel::order('sort asc')->select();
        $data['fangList'] = BaseSearchModel::where(['type'=>3])->order('sort asc')->select();
        $data['quList'] = BaseSearchModel::where(['type'=>1])->order('sort asc')->select();
        $data['imgList'] = HouseImageModel::where(['house_id'=>$this->id])->order('sort asc')->select();
        return view('houseEdit',$data);
    }

    //查看房源
    public function houseDetail(){
        $data['info'] = HouseModel::alias('a')
            ->join('tp_house_detail b','a.id = b.house_id','left')
            ->join('tp_base_label c','a.label_id = c.id','left')
            ->join('tp_base_search d','a.quyu = d.id','left')
            ->join('tp_base_search e','a.fangxing = e.id','left')
            ->join('tp_admin f','a.admin_id = f.id','left')
            ->field('a.*,b.shuifeijiexi,b.zhuangxiumiaoshu,b.huxingjieshao,b.hexinmaidian,c.name as label_name,d.term as quyu_name,e.term as fangxing_name,f.nick_name')
            ->where(['a.id'=>$this->id])
            ->find();
        if(!$data['info']) $this->error(lang('sys_param_error'));
        $data['imgList'] = HouseImageModel::where(['house_id'=>$this->id])->order('sort asc')->select();
        return view('houseDetail',$data);
    }

    // 删除房源
    public function houseDelete(){
        if($this->request->isPost()) {
            $result = HouseModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            return operateResult($result->delete(),'house/index','del');
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }

    // 排序房源
    public function inputHouse(){
        if($this->request->isPost()) {
            $result = HouseModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            $data = [$this->param['name'] => $this->param['data']];
            return inputResult($result->save($data),'sort');
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }

    // 房源状态变更
    public function operateHouse(){
        if($this->request->isPost()) {
            $result = HouseModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            $data = [$this->param['name'] => $this->param['data']];
            if($this->param['data'] == 1) $data['guapai_date'] = date('Y-m-d',time());
            return switchResult($result->save($data),'status');
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }

    //渲染用户列表
    public function houseList(){
        if(empty($this->param['name'])) return ['code'=>0,'data'=>[]];
        $houseList = HouseModel::field('id,title as name')->where(['title'=>['like','%'.$this->param['name'].'%'],'status'=>1])->order('sort asc,create_time desc')->select();
        if(count($houseList) == 0) return ['code'=>2,'data'=>$houseList];
        else return ['code'=>1,'data'=>$houseList];
    }

}