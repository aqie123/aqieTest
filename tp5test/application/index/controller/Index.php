<?php
namespace app\index\controller;
use think\Controller;
header("content-type:text/html;charset=gbk");

class Index extends Controller
{
    const Lottery_API = 'http://f.apiplus.net/ssq.json';
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

    // 获取彩票接口数据
    public function getLottery(){
        
        $httRequest = new \libs\HttpRequest();
        $response = $httRequest::request(self::Lottery_API);
        $opencode = [];
        $response = json_decode($response,true);
        foreach($response['data'] as $k =>&$v){
            $v['opencode']=preg_replace("/[+]/",',',$v['opencode']);
            //$opencode[] = $v['opencode'];
        }
        //return json_encode($opencode);
        return json_encode($response['data']);
    }

    public function getLottery2(){
        // http://www.opencai.net/apifree/
        $lottery_url = 'http://f.apiplus.net/ssq.json';
        echo '<br>采集地址：'.$lottery_url.'<br>';
        $lottery_url .= '?_='.time();
        $json = file_get_contents(urldecode($lottery_url));
        $json = json_decode($json);
        echo "<br>".date('Y-m-d H:i:s')."共采集到{$json->rows}行开奖数据：<br>";

        for ($i = 0; $i < count($json->data); $i++) {
            $p = $json ->data[$i]->expect;
            echo '<br>开奖期号：'.substr($p,0,8).'-'.substr($p,-3,3);
            echo '<br>开奖号码：'.$json ->data[$i]->opencode;
            echo '<br>开奖时间：'.$json ->data[$i]->opentime;
            echo '<br>';
        }
    }
}
