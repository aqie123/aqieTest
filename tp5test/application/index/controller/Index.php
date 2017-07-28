<?php
namespace app\index\controller;
use think\Controller;
header("content-type:text/html;charset=gbk");

class Index extends Controller
{
    public function index()
    {
        $Test = new \libs\ImRedis();
        return $Test->test();
    }
    //显示电话号码
    public function phone(){
        return MobileQuery::query('13207145531');
    }
}
