<?php
namespace app\index\controller;
class MobileQuery{
    const PHONE_API = 'https://tcc.taobao.com/cc/json/mobile_tel_segment.htm';

    const QUERY_PHONE = 'PHONE:INFO';

    /**
     *
     * @param $phone
     * @return mixed 反归属地查询后数据
     */
    public static function query($phone){
        $ret = [];
        if(self::verifyPhone($phone)){
            $httRequest = new \libs\HttpRequest();
            $redis = new \libs\ImRedis();
            // 测试redis是否可用
            // echo $name = $redis::getRedis()->get('name');
            $redis::getRedis()->set('name','aqie123');

             // $redisKey = sprintf(self::QUERY_PHONE . '%s', substr($phone, 0, 7));
             $redisKey = substr($phone, 0, 7);
            $phoneInfo = $redis::getRedis()->hGet(self::QUERY_PHONE,$redisKey);
            if($phoneInfo){             // redis数据库存在数据
                $ret = json_decode($phoneInfo,true);
                $ret['msg'] = "啊切提供数据";
            }else{
                $response = $httRequest::request(self::PHONE_API , ['tel' => $phone]); // 请求数据
                $data = self::formatData($response);

                if($data){
                    $json = json_encode($data);
                    $redis::getRedis()->hSet(self::QUERY_PHONE,$redisKey,$json);
                    $data['msg'] = '阿里巴巴提供数据';
                    $ret = $data;
                }
            }

        }
        // var_dump($ret);die;
        return $ret;       // return json($ret);   tp5框架
    }

    /**
     * 验证手机号码
     * @param $phone
     * @return bool
     */
    public static function verifyPhone($phone)
    {
        if (preg_match("/^1[34578]{1}\d{9}/", $phone)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 格式化数据
     *
     * @param $data
     * @return null
     */
    public static function formatData($data)
    {
        $ret = null;
        if (!empty($data)) {
            preg_match_all("/(\w+):'([^']+)/", $data, $res);
            $items = array_combine($res[1], $res[2]);
            foreach ($items as $itemKey => $itemVal) {
                $ret[$itemKey] = iconv('GB2312', 'UTF-8', $itemVal);
            }
        }
        return $ret;
    }
}