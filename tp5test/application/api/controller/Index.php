<?php
namespace  app\api\controller;
use think\Controller;
use think\Paginator;

class Index extends Controller
{
    private  $obj;
    public function _initialize() {
        $this->obj = model("Admin");
    }
    public function index(){
        $arr = array(
            'id' => 1,
            'name' => '啊切'
        );
        // return json_encode($arr, JSON_UNESCAPED_UNICODE);  // 中文乱码  只接受utf8编码
        $data = "输出json数据";

        $data = iconv('UTF-8','GBK',$data);
        var_dump(json_encode($data));  // false

        // 调用封装json
        $response = new \libs\Response();
        return $response::jsonEncode(200,'提示信息',$arr);
    }

    public function test(){
        $response = new \libs\Response();
        return $response::myxml();   // 测试xml格式输出
    }
    // 测试response函数
    // http://tp5test.com/index.php/api/index/test2?format=array
    public function test2(){
        $arr = array(
            'id' => 1,
            'name' => '啊切',
            'type' => array(2,3,4),
            'test' => array(1,2,3,5=>array(2,'aqie'))
        );
        $response = new \libs\Response();
        // return $response::xmlEncode(200,'success',$arr);  // 测试xml函数
        return $response::dataEncode(200,'success',$arr,'xml');  // 测试dataEncode函数
    }

    // 将数组缓存到文件
    public function fileCache(){
        $arr = array(
            'id' => 1,
            'name' => '啊切',
            'type' => array(2,3,4),
            'test' => array(1,2,3,5=>array(2,'aqie'))
        );
        $file = new \libs\FileCache();
        // 传数据就是缓存，不传($data 数据)就是获取，null就是删除
        if($file->cacheData('aqie_cache',$arr)){
             var_dump($file->cacheData('aqie_cache'));
            echo "数据缓存成功";
        }else{
            echo "缓存数据失败";
        }


    }

    // 测试redis 和mysql连接
    public function redis(){

        $redis = new \libs\ImRedis();
        $redis::getRedis()->set('color','red');
        $redis::getRedis()->setex('aqie123',15,1234567);  // 15秒;

        // 测试 mysql db
        $connect =  \libs\Mydb::getInstance()->connect();
        var_dump($connect);
        $sql = "select * from admin";
        $result = mysql_query($sql,$connect);
        echo mysql_num_rows($result);
        var_dump($result);

    }

    // APP应用详情页
    public function listPage(){


        $response = new \libs\Response();
        $file = new \libs\FileCache();
        $file->cacheData('test','啊切aqie',180);

        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $pageSize = isset($_GET['pagesize']) ? $_GET['pagesize'] : 6;
        if(!is_numeric($page) || !is_numeric($pageSize)) {
            return Response::show(401, '数据不合法');
        }

        $admins = $this->obj->getAdmin();  // 拿到admin数据
        if($admins){
            return $response::dataEncode(200,'success',$admins,"json");
        }else{
            return $response::dataEncode(400,'failed',$admins,"json");
        }




    }

}