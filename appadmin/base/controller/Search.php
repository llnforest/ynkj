<?php
/**
 * author: Lynn
 * since: 2018/3/23 13:05
 */
namespace admin\base\controller;

use admin\index\controller\BaseController;


class Search extends BaseController
{

    private $roleValidate = ['user_id|驾驶员' => 'require', 'bus_id|车辆' => 'require', 'accident_date' => 'require'];

    //构造函数
    public function __construct()
    {
        parent::__construct();
    }
}