# MISC-神奇的二维码-BitcoinPay Writeup

## 基本信息

- **NSSCTF 题号**: [P39](https://www.nssctf.cn/problem/39)
- **题目原名**: [SWPU 2019]神奇的二维码
- **题目链接**: https://www.nssctf.cn/problem/39
- **题目类型**: MISC
- **附件**: `MISC-神奇的二维码-BitcoinPay.png`

---

## 解题过程

### 第一步：二维码扫描

直接使用工具扫描图片中的二维码，得到：

```
swpuctf{flag_is_not_here}
```

这是一个**假 flag**，真正的信息隐藏在图片的其他位置。

### 第二步：PNG 尾部隐写分析

使用 `exiftool` 检查图片，发现尾部有额外数据：

```bash
$ exiftool MISC-神奇的二维码-BitcoinPay.png
...
Warning: [minor] Trailer data after PNG IEND chunk
```

用 `binwalk` 扫描发现 PNG 尾部嵌套了 **4 个 RAR 压缩包**：

```bash
$ binwalk -e MISC-神奇的二维码-BitcoinPay.png

28932         0x7104          RAR archive data, version 5.x
29034         0x716A          RAR archive data, version 5.x
94226         0x17012         RAR archive data, version 5.x
99220         0x18394         RAR archive data, version 5.x
```

### 第三步：解压 RAR 文件

提取后得到以下关键文件：

#### 1. `encode.txt`

内容：
```
YXNkZmdoamtsMTIzNDU2Nzg5MA==
```

Base64 解码后：
```
asdfghjkl1234567890
```

#### 2. `flag.doc`

经过多层 Base64 嵌套解码，最终得到：
```
comEON_YOuAreSOSoS0great
```

#### 3. `看看flag在不在里面^_^.rar`

需要密码解压，尝试密码 `asdfghjkl1234567890`，成功解压后得到一张 `flag.jpg`（表情包，干扰项）。

#### 4. `good.mp3`

需要密码解压，尝试密码 `comEON_YOuAreSOSoS0great`，成功解压出一个 MP3 音频文件。

### 第四步：音频分析 - 摩斯密码

`good.mp3` 是一个单声道音频，时长约 36 秒。生成频谱图后，观察到有规律的**垂直条纹**：

```bash
ffmpeg -i good.mp3 -lavfi showspectrumpic=s=800x600:mode=combined spectrum.png
```

频谱图特征：
- 有规律的 ON/OFF 信号
- 短脉冲约 0.14s，长脉冲约 0.29s
- 字母间隔约 1.32s

用 Python 精确提取时域信号并解码：

```python
import numpy as np

with open('good.wav', 'rb') as f:
    data = f.read()

samples = np.frombuffer(data[44:], dtype=np.int16)

# 提取包络并检测 ON/OFF
# 短脉冲(~0.14s) = "."
# 长脉冲(~0.29s) = "-"
# 1.32s 间隔 = 字母分隔
```

### 第五步：摩斯密码解码

| 摩斯码 | 字母 |
|--------|------|
| `--` | M |
| `---` | O |
| `.-.` | R |
| `...` | S |
| `.` | E |
| `..` | I |
| `...` | S |
| `...-` | V |
| `.` | E |
| `.-.` | R |
| `-.--` | Y |
| `...-` | V |
| `.` | E |
| `.-.` | R |
| `-.--` | Y |
| `.` | E |
| `.-` | A |
| `...` | S |
| `-.--` | Y |

解码结果：
```
MORSE IS VERY VERY EASY
```

---

## Flag

```
morseisveryveryeasy
```

---

## 总结

| 要点 | 说明 |
|------|------|
| **第一层** | PNG 尾部隐写 RAR 文件（`IEND` 后追加数据） |
| **第二层** | RAR 套娃：密码 `asdfghjkl1234567890` → 表情包干扰 |
| **第三层** | `flag.doc` 多层 Base64 → 密码 `comEON_YOuAreSOSoS0great` |
| **第四层** | MP3 音频中隐藏摩斯密码，频谱图/时域信号提取解码 |
| **核心技巧** | 摩斯密码 ON/OFF 时长区分：`.`=~0.14s, `-`=~0.29s |
