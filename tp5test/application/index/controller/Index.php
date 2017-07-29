<?php
namespace app\index\controller;
use think\Controller;
header("content-type:text/html;charset=gbk");

class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
    //显示电话号码
    public function phone(){
        $params = $_POST;
        $phone = $params['phone'];
        // var_dump($phone);die;
        $response = MobileQuery::query($phone);

        // var_dump($response);die; // 这是一个对象
        if (is_array($response) and isset($response['province'])) {
            $response['phone'] = $phone;
            $response['code'] = 200;
        } else {
            $response['code'] = 400;
            $response['msg'] = '手机号码错误';
        }
        // var_dump($response);die;
        return $response;

    }
}
