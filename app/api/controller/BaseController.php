<?php
namespace app\api\controller;


use think\Config;
use think\Controller;
use think\Request;


class BaseController extends Controller
{
    protected $data;
    protected $request;
    protected $param;
    protected $id;
    protected $imgHost;
    //构造函数
    public function __construct()
    {
        $this->request = Request::instance();
        $this->param = $this->request->param();
        $this->id = !empty($this->param['id'])?$this->param['id']:'';
        $this->imgHost = Config::get('upload.img_url');

        if(!Config::get('sys_open')){
            return json(['code' =>1001,'msg'=>'系统维护升级中，请稍候再试！']);
        }
        parent::__construct();
    }


}
