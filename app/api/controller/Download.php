<?php
namespace app\api\controller;



use think\Config;
use think\Controller;

class Download extends Controller {
    private $path;
    //构造函数
    public function __construct(){
        $this->path = Config::get('upload.path');
        parent::__construct();
    }

    //下载苹果
    public function downIos(){

    }

    //下载安卓
    public function downAndroid(){
        $path_name = $this->path.'/app/ynyj_android.apk';
        $file=fopen($path_name,"r");
        header("Content-Type: application/octet-stream");
        header("Accept-Ranges: bytes");
        header("Accept-Length: ".filesize($path_name));
        header("Content-Disposition: attachment; filename='ynkj'");
        echo fread($file,filesize($path_name));
        fclose($file);
    }


}