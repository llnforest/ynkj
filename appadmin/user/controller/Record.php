<?php
/**
 * author: Lynn
 * since: 2018/3/23 13:05
 */
namespace admin\user\controller;

use admin\index\controller\BaseController;
use model\UserRecordModel;
use think\Validate;


class Record extends BaseController
{

    private $roleValidate = ['house_id|房源标题' => 'require','user_id|用户手机' => 'require','record_date|看房日期'=>'require'];
    //构造函数
    public function __construct()
    {
        parent::__construct();
    }

    //看房列表页
    public function index(){
        $orderBy  = 'create_time desc';
        $where  = getWhereParam(['b.phone'=>'like','c.title'=>'like','d.nick_name'=>'like','a.record_date'=>['start','end']],$this->param);
        if(!empty($this->param['order'])) $orderBy = $this->param['order'].' '.$this->param['by'];
        if($this->admin['is_agent'] == 1) $where['a.admin_id'] = ['in','1,'.$this->admin['id']];
        $data['list'] = UserRecordModel::alias('a')
            ->join('tp_user b','a.user_id = b.id','left')
            ->join('tp_house c','a.house_id = c.id','left')
            ->join('tp_admin d','a.admin_id = d.id','left')
            ->field('a.*,b.phone,b.name,c.title,d.nick_name')
            ->where($where)
            ->order($orderBy)
            ->paginate($this->config_page,'',['query'=>$this->param]);
        $data['page']   = $data['list']->render();
        return view('index',$data);
    }

    //添加看房
    public function recordAdd(){
        if($this->request->isPost()){
            $validate = new Validate($this->roleValidate);
            if(!$validate->check($this->param)) return ['code' => 0, 'msg' => $validate->getError()];
            $this->param['admin_id'] = $this->admin['id'];
            return operateResult(UserRecordModel::create($this->param),'record/index','add');
        }
        return view('recordAdd');
    }

    // 删除看房
    public function recordDelete(){
        if($this->request->isPost()) {
            $result = UserRecordModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            return operateResult($result->delete(),'record/index','del');
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }

}