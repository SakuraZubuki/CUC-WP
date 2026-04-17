## [SWPUCTF 2021 新生赛]原来你也玩原神
![](./pic/分析压缩包是mp3前缀.png)
![](./pic/分析频谱.png)
于是修改后缀名为mp3,分析频谱无明显信息

![](./pic/提取MP3隐藏文件.png)
![](./pic/分析txt文件发现文件头是zip格式.png)
使用mp3stego获取隐藏txt文件，将其放进winhex中发现前缀为zip格式

![](./pic/发现是伪加密.png)
![](./pic/修改后解压获取flag.png)