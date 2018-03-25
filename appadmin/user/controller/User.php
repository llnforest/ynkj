<?php
/**
 * author: Lynn
 * since: 2018/3/23 12:05
 */
namespace admin\user\controller;

use admin\index\controller\BaseController;
use model\UserModel;
use think\Config;
use think\Validate;


class User extends BaseController{
    private $roleValidate = ['phone|手机号'=>'require|unique:tp_user,phone'];
    //构造函数
    public function __construct(){
        parent::__construct();
    }

    //用户列表页
    public function index(){
        $orderBy  = 'create_time desc';
        $where  = getWhereParam(['phone'=>'like','create_time'=>['start','end']],$this->param);
        if(!empty($this->param['order'])) $orderBy = $this->param['order'].' '.$this->param['by'];
        $data['list'] = UserModel::where($where)
            ->order($orderBy)
            ->paginate($this->config_page,'',['query'=>$this->param]);
        $data['page']   = $data['list']->render();
        return view('index',$data);
    }

    //添加用户
    public function userAdd(){
        if($this->request->isPost()){
            $this->roleValidate['password|密码'] = 'require|min:6';
            $validate = new Validate($this->roleValidate);
            if(!$validate->check($this->param)) return ['code' => 0, 'msg' => $validate->getError()];
            $this->param['password'] = md5($this->param['password']);
            return operateResult(UserModel::create($this->param),'user/index','add');
        }
        return view('userAdd');
    }

    //修改用户
    public function userEdit(){
        $data['info'] = UserModel::get($this->id);
        if(!$data['info']) $this->error(lang('sys_param_error'));
        if($this->request->isPost()){
            if(!empty($this->param['password'])) $this->roleValidate['password|密码'] = 'require|min:6';
            $validate = new Validate($this->roleValidate);
            if(!$validate->check($this->param)) return ['code' => 0,'msg' => $validate->getError()];
            if(empty($this->param['password'])) unset($this->param['password']);
            else $this->param['password'] = md5($this->param['password']);
            return operateResult($data['info']->save($this->param),'user/index','edit');
        }
        return view('userEdit',$data);
    }

    // 删除用户
    public function userDelete(){
        if($this->request->isPost()) {
            $result = UserModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            return operateResult($result->delete(),'user/index','del');
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }
    
    //渲染用户列表
    public function userList(){
        if(empty($this->param['name'])) return ['code'=>0,'data'=>[]];
        $userList = UserModel::field('id,phone as name')->where(['phone'=>['like','%'.$this->param['name'].'%']])->order('create_time desc')->select();
        if(count($userList) == 0) return ['code'=>2,'data'=>$userList];
        else return ['code'=>1,'data'=>$userList];
    }

}