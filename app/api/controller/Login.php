<?php
namespace app\api\controller;



use fanston\common\Tools;
use fanston\third\MyCache;
use model\BaseBetterModel;
use model\BaseSearchModel;
use model\HouseDetailModel;
use model\HouseImageModel;
use model\HouseModel;
use model\UserModel;
use think\Config;

class Login extends BaseController{

    //构造函数
    public function __construct(){
        parent::__construct();
    }

    //房源资料页
    public function login(){
        $param = $this->param;
        $where  = [];
        if (!empty($param['phone']) && !empty($param['usms'])) {
            $check = self::sCheckSms($param['phone'],$param['usms']);
            if($check['code'] != 1) return $check;

            $where['phone'] = $param['phone'];
            $user = UserModel::get($where);
            $signArr = [
                'phone' => $param['phone'],
                'create_time' => date('Y-m-d H:i:s',time()),
                'nonce_str' => Tools::genRandomString()
                ];
            $data['token'] = Tools::getSign($signArr,Config::get('secret_key'));
            $data['phone'] = $param['phone'];
            if(!empty($user)){
                if(!$user['status']) return json(['code'=>0,'msg'=>'对不起，您的手机号已被停用']);
                $user->save($data);
            }else{
                UserModel::create($data);
            }
            self::removeSms($param['phone']);
            return json(['code'=>1,'msg'=>lang('login_success'),'data'=>$data['token'] ]);
        }else{
            return json(['code'=>0,'msg'=>lang('system_data_error')]);
        }
    }

    //发送验证码
    public static function sendSms($phone){
        $SendMessage = new SendMessage();
        $result = $SendMessage->sendSms($phone);
        return $result;
    }

    //删除已用短信验证码
    public static function removeSms($phone){
        MyCache::rm(MyCache::$SMSKey.$phone);
    }

    //静态验证短信验证码
    public static function sCheckSms($phone,$usms){
        if(empty($phone))
            return array('code'=>2001,'msg'=>lang('sms_check_phone_error'));
        if(empty($usms))
            return array('code'=>2001,'msg'=>lang('sms_data_error'));
        $valCache = MyCache::get(MyCache::$SMSKey.$phone);
        $sms = isset($valCache['sms'])?$valCache['sms']:'';
        if($usms != $sms)
            return array('code'=>2001,'msg'=>lang('sms_data_error'));
        MyCache::rm(MyCache::$SMSKey.$phone);
        return array('code'=>1,'msg'=>lang('sms_check_success'));
    }


}