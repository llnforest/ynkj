<?php
/**
 * author: Lynn
 * since: 2018/3/23 12:05
 */
namespace admin\base\controller;

use admin\index\controller\BaseController;
use model\BaseNoticeModel;
use think\Config;
use think\Validate;


class Notice extends BaseController{
    private $roleValidate = ['title|通知标题' => 'require'];
    //构造函数
    public function __construct(){
        parent::__construct();
    }

    //通知列表页
    public function index(){
        $orderBy  = 'sort asc,update_time desc';
        $where  = getWhereParam(['title'=>'like','update_time'=>['start','end']],$this->param);
        if(!empty($this->param['order'])) $orderBy = $this->param['order'].' '.$this->param['by'];

        $data['list'] = BaseNoticeModel::where($where)
            ->order($orderBy)
            ->paginate($this->config_page,'',['query'=>$this->param]);
        $data['page']   = $data['list']->render();
        return view('index',$data);
    }

    //添加通知
    public function noticeAdd(){
        if($this->request->isPost()){
            $validate = new Validate($this->roleValidate);
            if(!$validate->check($this->param)) return ['code' => 0, 'msg' => $validate->getError()];
            return operateResult(BaseNoticeModel::create($this->param),'notice/index','add');
        }
        return view('noticeAdd');
    }

    //修改通知
    public function noticeEdit(){
        $data['info'] = BaseNoticeModel::get($this->id);
        if(!$data['info']) $this->error(lang('sys_param_error'));
        if($this->request->isPost()){
            $validate = new Validate($this->roleValidate);
            if(!$validate->check($this->param)) return ['code' => 0,'msg' => $validate->getError()];
            return operateResult($data['info']->save($this->param),'notice/index','edit');
        }
        return view('noticeEdit',$data);
    }

    // 删除通知
    public function noticeDelete(){
        if($this->request->isPost()) {
            $result = BaseNoticeModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            !empty($result['banner_url']) && @unlink(Config::get('upload.path').$result['banner_url']);
            !empty($result['house_url']) && @unlink(Config::get('upload.path').$result['house_url']);
            return operateResult($result->delete(),'notice/index','del');
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }

    // 排序通知
    public function inputNotice(){
        if($this->request->isPost()) {
            $result = BaseNoticeModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            $data = [$this->param['name'] => $this->param['data']];
            return inputResult($result->save($data),'sort');
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }

}