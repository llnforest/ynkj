<?php
namespace app\api\controller;




use model\BaseLabelModel;
use model\HouseModel;
use model\UserFavouriteModel;
use model\UserModel;
use model\UserRequestImageModel;
use model\UserRequestModel;
use model\UserReserveModel;
use think\Config;
use think\Validate;

class User extends DefaultController {

    //构造函数
    public function __construct(){
        parent::__construct();
    }

    //个人中心
    public function houseList(){
        $this->data['user'] = $this->userData;
        $this->data['service'] = Config::get('service');
        return json(['code'=>1,'data'=>$this->data]);
    }

    //需求页面
    public function request(){
        $this->data['label'] = BaseLabelModel::order('sort asc')->select();
        return json(['code'=>1,'data'=>$this->data]);
    }

    //更换头像
    public function updateHeadUrl(){
        $headUrl = '';
        if(empty($headUrl)) return json(['code' => 0,'msg' => '头像不能为空']);
        UserModel::where(['id'=>$this->userData['id']])->update(['head_url' => $headUrl]);
        return json(['code'=>1,'msg'=>'更换成功']);
    }

    //提交需求
    public function uploadRequest(){
        $requestData = [
            'user_id' => $this->param['user_id'],
            'type'  => $this->param['type'],
            'label_id' => $this->param['label_id'],
            'remark' =>$this->param['remark']
        ];
        $roleValidate = ['type|类型' => 'require','label_id|标签id' => 'require'];
        $validate = new Validate($roleValidate);
        if(!$validate->check($this->param)) return json(['code' => 0,'msg' => $validate->getError()]);
        $request = UserRequestModel::create($requestData);

        $imgList = [];
        $imgData = [];
        foreach($imgList as $v){
            $imgData[] = ['request_id' => $request['id'],'url' => $v];
        }
        $imgModel = new UserRequestImageModel();
        $imgModel->saveAll($imgData);
        return json(['code'=>1,'msg'=>'提交成功']);
    }

    //预约看房
    public function reserveHouse(){
        $house_id = !empty($this->param['house_id']) ? $this->param['house_id'] :'';
        if(empty($house_id)) return json(['code' => 0,'msg' => '房源不能为空']);
        $reserve = UserReserveModel::get(['user_id' => $this->userData['id'],'house_id' => $house_id]);
        if(!empty($reserve)) return json(['code'=>1,'msg'=>'请勿重复预约']);
        $house = HouseModel::get($house_id);
        $reserveData = [
            'house_id' => $house_id,
            'admin_id' => $house['admin_id'],
            'user_id'  => $this->userData['id']
        ];
        if(UserReserveModel::create($reserveData)){
            return json(['code'=>1,'msg'=>'预约成功']);
        }else{
            return json(['code'=>0,'msg'=>'预约失败']);
        }
    }

    //关注
    public function favouriteHouse(){
        $house_id = !empty($this->param['house_id']) ? $this->param['house_id'] :'';
        if(empty($house_id)) return json(['code' => 0,'msg' => '房源不能为空']);
        $favouriteData = [
            'house_id' => $house_id,
            'user_id'  => $this->userData['id']
        ];
        $favourite = UserFavouriteModel::get($favouriteData);
        if(!empty($favourite)){
            $favourite->delete();
            return json(['code'=>1,'msg'=>'取消关注成功']);
        }
        if(UserFavouriteModel::create($favouriteData)){
            return json(['code'=>1,'msg'=>'关注成功']);
        }else{
            return json(['code'=>0,'msg'=>'关注失败']);
        }
    }


}