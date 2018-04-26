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
        $path_name = $this->path.'/app/ynyj_ios.ipa';
        $file=fopen($path_name,"r");
        header("Content-Type: application/octet-stream");
        header("Accept-Ranges: bytes");
        header("Accept-Length: ".filesize($path_name));
        header("Content-Disposition: attachment; filename=翼鸟宜居.ipa");
        echo fread($file,filesize($path_name));
        fclose($file);
    }

    //下载安卓
    public function downAndroid(){
        $path_name = $this->path.'/app/ynyj_android.apk';
//        $file=fopen($path_name,"r");
//        header("Content-Type: application/octet-stream");
//        header("Accept-Ranges: bytes");
//        header("Accept-Length: ".filesize($path_name));
//        header("Content-Disposition: attachment; filename='翼鸟宜居.apk'");
//        echo fread($file,filesize($path_name));
//        fclose($file);

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=翼鸟宜居.apk');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($path_name));
        readfile($path_name);
        exit;
    }


}