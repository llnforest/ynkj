<?php
/**
 * author: Lynn
 * since: 2018/3/23 12:05
 */
namespace model;

class UserRequestModel extends \think\Model
{
    // 设置完整的数据表（包含前缀）
    protected $name = 'tp_user_request';
    protected $autoWriteTimestamp = 'datetime';

    //初始化属性
    protected function initialize()
    {
    }

}
?>