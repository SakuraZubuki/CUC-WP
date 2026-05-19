---
title: "[SWPUCTF 2021 新生赛] 附件.txt"
date: 2026-05-18
category: MISC
tags:
  - 文本分析
  - 假 flag 混入
NSSCTF: https://www.nssctf.cn/problem/447
---

# [SWPUCTF 2021 新生赛] 附件.txt

## 题目信息

- **附件**: `附件.txt`
- **类型**: MISC 文本分析
- **核心考点**: 从大量假 flag 中找出真 flag

## 解题过程

文件只有一行，但长达 207KB，包含近 8000 个格式各异的假 flag，如：

```
FAKeFlag{59d3U0sr0O5Cbu7f}faKEFLAg{e3fFYfYOU17D5RR5}fAKeFlag{L0B5DcL67DAfA9Io}...
```

### Step 1：提取所有前缀

用正则提取 `前缀{内容}` 模式，统计所有前缀：

```python
import re
from collections import Counter

with open('附件.txt', 'r') as f:
    content = f.read()

patterns = re.findall(r'([A-Za-z]+)\{([^}]+)\}', content)
prefixes = [p for p, _ in patterns]
print(Counter(prefixes).most_common(20))
```

发现绝大多数前缀都是 `FAKeFlag` / `faKEFLAg` / `FakefLaG` 等大小写变体，共 258 种不同的假前缀。

### Step 2：词频统计提取真 flag

对所有假 flag 的 `{}` 内内容做字符频率统计（不区分大小写）：

```python
import re
from collections import Counter

with open('附件.txt', 'r') as f:
    content = f.read()

flags = re.findall(r'\{([^}]+)\}', content)
c = ''.join(flags)

f = Counter(c.lower())
for char, count in f.most_common():
    if count > 1:  # 舍弃仅出现 1 次的字符（空格、换行等噪声）
        print(char, end='')
```

输出：

```
yourflagis81e57d2bc90364
```

去掉干扰前缀 `yourflagis`，得到真 flag：`81e57d2bc90364`

## Flag

```
NSSCTF{81e57d2bc90364}
```

## 总结

- 这道题的核心就是**找不同**：真 flag 被埋在大量高度相似的假 flag 中
- 自动化方法是统计前缀频率，异常值（frequency=1）即为真 flag
- 也可以肉眼观察或用 `sort | uniq -c` 快速定位
