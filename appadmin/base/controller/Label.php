<?php
/**
 * author: Lynn
 * since: 2018/3/23 13:05
 */
namespace admin\base\controller;


use admin\index\controller\BaseController;
use model\BaseLabelModel;
use model\HouseModel;
use model\UserRequestModel;
use think\Config;
use think\Validate;


class Label extends BaseController{

    private $roleValidate = ['url|标签图片' => 'require','name|标签名称' => 'require'];
    //构造函数
    public function __construct()
    {
        parent::__construct();
    }

    //标签列表页
    public function index(){
        $orderBy  = 'sort asc';
        $where  = getWhereParam(['name'],$this->param);
        if(!empty($this->param['order'])) $orderBy = $this->param['order'].' '.$this->param['by'];

        $data['list'] = BaseLabelModel::where($where)
            ->order($orderBy)
            ->paginate($this->config_page,'',['query'=>$this->param]);
        $data['page']   = $data['list']->render();
        return view('index',$data);
    }

    //添加标签
    public function labelAdd(){
        if($this->request->isPost()){
            $validate = new Validate($this->roleValidate);
            if(!$validate->check($this->param)) return ['code' => 0, 'msg' => $validate->getError()];
            return operateResult(BaseLabelModel::create($this->param),'label/index','add');
        }
        return view('labelAdd');
    }

    //修改标签
    public function labelEdit(){
        $data['info'] = BaseLabelModel::get($this->id);
        if(!$data['info']) $this->error(lang('sys_param_error'));
        if($this->request->isPost()){
            $validate = new Validate($this->roleValidate);
            if(!$validate->check($this->param)) return ['code' => 0,'msg' => $validate->getError()];
            return operateResult($data['info']->save($this->param),'label/index','edit');
        }
        return view('labelEdit',$data);
    }

    // 删除标签
    public function labelDelete(){
        if($this->request->isPost()) {
            $result = BaseLabelModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            if(empty(HouseModel::get(['label_id' => $this->id])) && empty(UserRequestModel::get(['label_id' => $this->id])))
                return operateResult($result->delete() && @unlink(Config::get('upload.path').$result['url']),'label/index','del');
            else return ['code' => 0,'msg' => '该标签已经应用，不能删除'];
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }

    // 排序标签
    public function inputLabel(){
        if($this->request->isPost()) {
            $result = BaseLabelModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            $data = [$this->param['name'] => $this->param['data']];
            return inputResult($result->save($data),'sort');
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }

}