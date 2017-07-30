1.redis-cli   启动redis服务
    hgetall PHONE:INFO   显示键值内容
2.php设计模式

3.php生成xml
    a.组装字符串
    b.使用系统类
        1.DomDocument
        2.XMLWriter
        3.SimpleXML
4.缓存技术
    1.静态缓存(生成，操作，删除)
        a.写入 fwrite file_put_contents(字符串)
        b.静态缓存设置缓存失效时间
        c.设置缓存
    2.
        相同：数据存放在内存
        Memcache

        Redis：
           a. 数据可持久化
            b.数据类型多 list set hash
            c.设置失效 setex('aqie123',15,1234567);  // 15秒
5.
    分 小时 日 月 星期 (* /(每分钟))
    crontab -e
    crontab -l
    crontab -r


