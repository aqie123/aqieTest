<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/30
 * Time: 10:59
 */

namespace libs;

// 缓存相关
class FileCache
{
    private $_dir;  // 缓存路径
    const EXT = '.php';  // 文件名后缀
    public function __construct()
    {
        $this->_dir = dirname(__FILE__) . '\\files\\';  // 当前目录同级目录
    }

    /**
     * @param $key 缓存文件名
     * @param string $value 缓存数据 (传数据就是缓存，不传($data 数据)就是获取，null就是删除)
     * @param int $cacheTime 缓存时间
     * @return mixed false/字节数
     */
    public function cacheData($key, $value = "",$cacheTime = 0){
        $filename = $this->_dir  . $key . self::EXT;

        if($value !== "") {         // 将value值写入缓存
            if(is_null($value)) {  // 删除缓存
                return @unlink($filename);
            }
            $dir = dirname($filename);

            if(!is_dir($dir)) {    // 目录是否存在
                mkdir($dir, 0777);
            }

            // 11位，不满11位用0补
            $cacheTime = sprintf('%011d', $cacheTime);
            return file_put_contents($filename,json_encode($value));  // json或者序列化
        }
        if(!is_file($filename)) {           // 判断文件是否存在
            return FALSE;
        }
        $contents = file_get_contents($filename);
        return json_decode($contents,true);

    }
}