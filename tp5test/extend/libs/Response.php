<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/30
 * Time: 9:36
 */

namespace libs;

//根据不同数据格式显示数据
class Response
{
    const JSON = "json";
    /**
     * json/xml/array方式输出数据
     * @param $code 状态码
     * @param string $message 提示信息
     * @param array $data  数据
     * @param string $type 数据输出格式
     * @return string
     */
    public static function dataEncode($code,$message = '',$data = array(),$type= self::JSON){
        if(!is_numeric($code)){
            return '';
        }
         $type = isset($_GET['format']) ? $_GET['format'] : $type;
        $result = array(
            'code' => $code,
            'message' => $message,
            'data' => $data,
        );

        if($type == 'json') {
            self::jsonEncode($code, $message, $data);
            exit;
        } elseif($type == 'array') {
            var_dump($result);
        } elseif($type == 'xml') {
            self::xmlEncode($code, $message, $data);
            exit;
        } else {
            // TODO
        }
    }
    /**
     * json方式输出数据
     * @param $code 状态码
     * @param string $message 提示信息
     * @param array $data  数据
     * @return string
     */
    public static function jsonEncode($code,$message = '',$data = array()){
        if(!is_numeric($code)){
            return '';
        }
        $result = array(
            'code' => $code,
            'message' => $message,
            'data' => $data
        );
        echo json_encode($result);
    }
    // xml 测试输出
    public static function myxml(){
        header("Content-Type:text/xml");
        $xml = "<?xml version='1.0' encoding='UTF-8'?>\n";
        $xml .= "<root>\n";

        $xml .= "<code>200</code>\n";
        $xml .= "<message>数据返回成功</message>\n";
        $xml .= "<data>\n";
        $xml .= "<id>1</id>\n";
        $xml .= "<name>aqie</name>\n";
        $xml .= "</data>\n";

        $xml .= "</root>";
        echo $xml;
    }

    /**
     * xml方式输出数据
     * @param $code 状态码
     * @param string $message 提示信息
     * @param array $data  数据
     * @return string
     */
    public static function xmlEncode($code,$message = '',$data = array()){
        if(!is_numeric($code)){
            return '';
        }
        $result = array(
            'code' => $code,
            'message' => $message,
            'data' => $data
        );
        header("Content-Type:text/xml");  //指定页面显示类型
        $xml = "<?xml version='1.0' encoding='UTF-8'?>\n";
        $xml .= "<root>\n";
        $xml .= self::xmlToEncode($result);
        $xml .= "</root>";
        echo $xml;
    }

    // xml转码
    public static function xmlToEncode($data) {

        $xml = $attr = "";
        foreach($data as $key => $value) {
            if(is_numeric($key)) {
                $attr = " id='{$key}'";
                $key = "item";
            }
            $xml .= "<{$key}{$attr}>";
            $xml .= is_array($value) ? self::xmlToEncode($value) : $value;
            $xml .= "</{$key}>\n";
        }
        return $xml;
    }

}