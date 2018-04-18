<?php
namespace app\api\controller;


use model\UserModel;
use think\Config;
use think\Controller;
use think\Request;


class DefaultController extends BaseController
{
    protected $userData;
    //构造函数
    public function __construct()
    {
        parent::__construct();
        $token = !empty($this->param['token'])?$this->param['token']:'000';
        $this->userData = UserModel::get(['token' => $token,'status' => 1]);
//        $this->userData = UserModel::get(2);
        if(empty($this->userData)){
            die(json_encode(['code' =>1002,'msg'=>'用户尚未登录，请先登录！','url' => 'source://view/login/main.ui']));
        }

    }


}
