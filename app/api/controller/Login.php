<?php
namespace app\api\controller;



use fanston\common\Tools;
use fanston\third\MyCache;
use fanston\third\SendMsg;
use model\UserModel;
use think\Config;
use think\Validate;

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
            if($check['code'] != 1) return json($check);

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
            return json(['code'=>1,'msg'=>'登录成功','data'=>$data['token'],'url'=>'source://view/index.ui']);
        }else{
            return json(['code'=>0,'msg'=>lang('sys_param_error')]);
        }
    }

    //发送验证码
    public function sendSms(){
        $roleValidate = ['phone|手机号码' => 'require|mobile'];
        $validate = new Validate($roleValidate);
        if(!$validate->check($this->param))  return json(['code' => 0, 'msg' => $validate->getError()]);
        $phone = $this->param['phone'];
        //判断发送的时间间隔
        $valCache = MyCache::get(MyCache::$SMSKey.$phone);
        $time = isset($valCache['time'])?$valCache['time']:0;
        if(time()-$time <= Config::get('sms.SMSTime')) return array('code'=>2001,'msg'=>lang('sms_phone_time_error'));
        //判断当日发送量
        $numCache = MyCache::get(MyCache::$SMSNumKey.$phone);
        $day = isset($numCache['day'])?$numCache['day']:'';
        $num = isset($numCache['num'])?$numCache['num']:0;
        if($day == date('Y-m-d',time())){
            if($num >= Config::get('sms.SMSNum')) return array('code'=>2001,'msg'=>lang('sms_phone_num_error'));

        }

        $code = rand(100000,999999);
        //获取短信模板，发送短信
        $content = SendMsg::getTemplate(1,['[0]' => $code]);
        $result = SendMsg::send($phone,$content);
        if($result){
            MyCache::set(MyCache::$SMSNumKey.$phone,array('day'=>date('Y-m-d',time()),'num'=>$num+1),3600*24);
            MyCache::set(MyCache::$SMSKey.$phone,array('sms'=>$code,'time'=>time()),1800);
            return json(['code' => 1,'msg'=>'发送成功']);
        }else{
            return json(['code' => 0,'msg'=>'发送失败']);
        }

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