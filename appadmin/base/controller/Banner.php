<?php
/**
 * author: Lynn
 * since: 2018/3/23 12:05
 */
namespace admin\base\controller;

use admin\index\controller\BaseController;
use chromephp\chromephp;
use model\BaseBannerModel;
use think\Config;
use think\Validate;


class Banner extends BaseController{

    private $roleValidate = ['url|图片地址' => 'require','href|超链接' => 'url'];
    //构造函数
    public function __construct()
    {
        parent::__construct();
    }

    //banner列表页
    public function index(){
        $orderBy  = 'updown desc,type asc,sort asc';
        $where  = getWhereParam(['updown','type'],$this->param);
        if(!empty($this->param['order'])) $orderBy = $this->param['order'].' '.$this->param['by'];

        $data['list'] = BaseBannerModel::where($where)
                            ->order($orderBy)
                            ->paginate($this->config_page,'',['query'=>$this->param]);
        $data['page']   = $data['list']->render();
        return view('index',$data);
    }

    //添加banner
    public function bannerAdd(){
        if($this->request->isPost()){
            $validate = new Validate($this->roleValidate);
            if(!$validate->check($this->param)) return ['code' => 0, 'msg' => $validate->getError()];
            return operateResult(BaseBannerModel::create($this->param),'banner/index','add');
        }
        return view('bannerAdd');
    }

    //修改banner
    public function bannerEdit(){
        $data['info'] = BaseBannerModel::get($this->id);
        if(!$data['info']) $this->error(lang('param_error'));
        if($this->request->isPost()){
            $validate = new Validate($this->roleValidate);
            if(!$validate->check($this->param)) return ['code' => 0,'msg' => $validate->getError()];
            return operateResult($data['info']->save($this->param),'banner/index','edit');
        }
        return view('bannerEdit',$data);
    }

    // 删除banner
    public function bannerDelete(){
        if($this->request->isPost()) {
            $result = BaseBannerModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            chromephp::info(Config::(__ImagePath__));
            @unlink(Config::get('upload.path').$result['url']);
//            return operateResult($result->delete(),'banner/index','del');
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }

    // 排序banner
    public function inputBanner(){
        if($this->request->isPost()) {
            $result = BaseBannerModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            $data = [$this->param['name'] => $this->param['data']];
            return inputResult($result->save($data),'sort');
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }

    // 操作banner
    public function switchBanner(){
        if($this->request->isPost()) {
            $result = BaseBannerModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            $data = [$this->param['name'] => $this->param['data']];
            return switchResult($result->save($data),'status');
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }
}