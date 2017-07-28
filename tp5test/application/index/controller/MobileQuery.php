<?php
namespace app\index\controller;
class MobileQuery{
    const PHONE_API = 'https://tcc.taobao.com/cc/json/mobile_tel_segment.htm';

    const QUERY_PHONE = 'PHONE:INFO:';

    /**
     * 显示归属地查询后数据
     * @param $phone
     */
    public static function query($phone){
        if(self::verifyPhone($phone)){
            $httRequest = new \libs\HttpRequest();
            $redis = new \libs\ImRedis();
            echo $name = $redis::getRedis()->get('name');
            $redis::getRedis()->set('name','aqie123');

            // $redisKey = sprintf(self::QUERY_PHONE . '%s', substr($phone, 0, 7));
             $redisKey = substr($phone, 0, 7);
            var_dump($redisKey);

            $response = $httRequest::request(self::PHONE_API , ['tel' => $phone]); // 请求数据
            $data = self::formatData($response);
            if($data){
                //var_dump($data);
                $json = json_encode($data);
                echo $json;

                $redis::getRedis()->hSet(self::QUERY_PHONE,$redisKey,$json);
            }
        }
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