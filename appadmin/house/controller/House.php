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
use model\HouseModel;
use think\Validate;


class House extends BaseController{

    private $roleValidate = ['house_id|驾驶员' => 'require','bus_id|车辆' => 'require','accident_date' => 'require'];
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
            return operateResult(HouseModel::create($this->param),'house/index','add');
        }
        return view('houseAdd');
    }

    //修改房源
    public function houseEdit(){
        $data['info'] = HouseModel::get($this->id);
        if(!$data['info']) $this->error(lang('sys_param_error'));
        if($this->request->isPost()){
            $validate = new Validate($this->roleValidate);
            if(!$validate->check($this->param)) return ['code' => 0,'msg' => $validate->getError()];
            return operateResult($data['info']->save($this->param),'house/index','edit');
        }
        return view('houseEdit',$data);
    }

    // 删除房源
    public function houseDelete(){
        if($this->request->isPost()) {
            $result = HouseModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            !empty($result['banner_url']) && @unlink(Config::get('upload.path').$result['banner_url']);
            !empty($result['house_url']) && @unlink(Config::get('upload.path').$result['house_url']);
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
    //渲染用户列表
    public function houseList(){
        if(empty($this->param['name'])) return ['code'=>0,'data'=>[]];
        $houseList = HouseModel::field('id,title as name')->where(['title'=>['like','%'.$this->param['name'].'%'],'status'=>1])->order('sort asc,create_time desc')->select();
        if(count($houseList) == 0) return ['code'=>2,'data'=>$houseList];
        else return ['code'=>1,'data'=>$houseList];
    }

}