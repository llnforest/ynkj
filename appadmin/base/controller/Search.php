<?php
/**
 * author: Lynn
 * since: 2018/3/23 13:05
 */
namespace admin\base\controller;

use admin\index\controller\BaseController;
use model\BaseSearchModel;
use model\HouseModel;
use think\Config;
use think\Validate;


class Search extends BaseController{

    private $roleValidate = ['term|筛选条件' => 'require'];
    //构造函数
    public function __construct()
    {
        parent::__construct();
    }

    //筛选列表页
    public function index(){
        $orderBy  = 'type asc,sort asc';
        $where  = getWhereParam(['type','term'],$this->param);
        if(!empty($this->param['order'])) $orderBy = $this->param['order'].' '.$this->param['by'];

        $data['list'] = BaseSearchModel::where($where)
            ->order($orderBy)
            ->paginate($this->config_page,'',['query'=>$this->param]);
        $data['page']   = $data['list']->render();
        return view('index',$data);
    }

    //添加筛选
    public function searchAdd(){
        if($this->request->isPost()){
            $validate = new Validate($this->roleValidate);
            if(!$validate->check($this->param)) return ['code' => 0, 'msg' => $validate->getError()];
            return operateResult(BaseSearchModel::create($this->param),'search/index','add');
        }
        return view('searchAdd');
    }

    //修改筛选
    public function searchEdit(){
        $data['info'] = BaseSearchModel::get($this->id);
        if(!$data['info']) $this->error(lang('sys_param_error'));
        if($this->request->isPost()){
            $validate = new Validate($this->roleValidate);
            if(!$validate->check($this->param)) return ['code' => 0,'msg' => $validate->getError()];
            return operateResult($data['info']->save($this->param),'search/index','edit');
        }
        return view('searchEdit',$data);
    }

    // 删除筛选
    public function searchDelete(){
        if($this->request->isPost()) {
            $result = BaseSearchModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            if(empty(HouseModel::where(['quyu' => $this->id])->whereOr(['fangxing' => $this->id])->find()))
                return operateResult($result->delete(),'Search/index','del');
            else return ['code' => 0,'msg' => '该筛选条件已经应用，不能删除'];
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }

    // 排序筛选
    public function inputSearch(){
        if($this->request->isPost()) {
            $result = BaseSearchModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            $data = [$this->param['name'] => $this->param['data']];
            return inputResult($result->save($data),'sort');
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }

}