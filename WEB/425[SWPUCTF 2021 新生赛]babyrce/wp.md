## [SWPUCTF 2021 新生赛]babyrce
![](./pic/要求更改cookie信息.png)
![](./pic/更改cookie.png)
添加admin=1，发现存在子目录

![](./pic/查看过滤规则.png)
访问/rasalghul.php得到代码，此代码意思为使用GET方法请求输入参数url，将其的值赋给变量ip，如果变量ip的值包括空格，则输出nonono，否则将变量ip的值当做命令执行（即输出变量a）

![](./pic/列出子目录.png)
发现存在fllllaaaaaaggggggg目录

![](./pic/cat指令获取flag.png)