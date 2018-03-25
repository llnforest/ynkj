<?php
/**
 * author: Lynn
 * since: 2018/3/23 12:05
 */
namespace admin\user\controller;

use admin\index\controller\BaseController;
use model\UserFavouriteModel;


class Favourite extends BaseController{
    //构造函数
    public function __construct(){
        parent::__construct();
    }

    //关注列表页
    public function index(){
        $orderBy  = 'create_time desc';
        $where  = getWhereParam(['b.phone'=>'like','c.title'=>'like','a.create_time'=>['start','end']],$this->param);
        if(!empty($this->param['order'])) $orderBy = $this->param['order'].' '.$this->param['by'];
        $data['list'] = UserFavouriteModel::alias('a')
            ->join('tp_user b','a.user_id = b.id','left')
            ->join('tp_house c','a.house_id = c.id','left')
            ->field('a.*,b.phone,b.name,c.title')
            ->where($where)
            ->order($orderBy)
            ->paginate($this->config_page,'',['query'=>$this->param]);
        $data['page']   = $data['list']->render();
        return view('index',$data);
    }



}