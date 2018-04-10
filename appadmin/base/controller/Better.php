<?php
/**
 * author: Lynn
 * since: 2018/3/23 13:05
 */
namespace admin\base\controller;


use admin\index\controller\BaseController;
use model\BaseBetterModel;
use model\HouseModel;
use model\UserRequestModel;
use think\Config;
use think\Validate;


class Better extends BaseController{

    private $roleValidate = ['name|卖点名称' => 'require'];
    //构造函数
    public function __construct()
    {
        parent::__construct();
    }

    //卖点列表页
    public function index(){
        $orderBy  = 'sort asc';
        $where  = getWhereParam(['name'],$this->param);
        if(!empty($this->param['order'])) $orderBy = $this->param['order'].' '.$this->param['by'];

        $data['list'] = BaseBetterModel::where($where)
            ->order($orderBy)
            ->paginate($this->config_page,'',['query'=>$this->param]);
        $data['page']   = $data['list']->render();
        return view('index',$data);
    }

    //添加卖点
    public function betterAdd(){
        if($this->request->isPost()){
            $validate = new Validate($this->roleValidate);
            if(!$validate->check($this->param)) return ['code' => 0, 'msg' => $validate->getError()];
            return operateResult(BaseBetterModel::create($this->param),'better/index','add');
        }
        return view('betterAdd');
    }

    //修改卖点
    public function betterEdit(){
        $data['info'] = BaseBetterModel::get($this->id);
        if(!$data['info']) $this->error(lang('sys_param_error'));
        if($this->request->isPost()){
            $validate = new Validate($this->roleValidate);
            if(!$validate->check($this->param)) return ['code' => 0,'msg' => $validate->getError()];
            return operateResult($data['info']->save($this->param),'better/index','edit');
        }
        return view('betterEdit',$data);
    }

    // 删除卖点
    public function betterDelete(){
        if($this->request->isPost()) {
            $result = BaseBetterModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msget([\'better_id\' => $g' => lang('sys_param_error')];
            if(empty(HouseModel::where(['' =>['exp','find_in_set('.$this->id.',better_ids)']])->find()))
                return operateResult($result->delete(),'better/index','del');
            else return ['code' => 0,'msg' => '该卖点已经应用，不能删除'];
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }

    // 排序卖点
    public function inputBetter(){
        if($this->request->isPost()) {
            $result = BaseBetterModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            $data = [$this->param['name'] => $this->param['data']];
            return inputResult($result->save($data),'sort');
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }

}