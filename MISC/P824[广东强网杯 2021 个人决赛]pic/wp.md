# MISC - 盲水印双图隐写 Writeup

## 基本信息

- **NSSCTF 题号**: [P824](https://www.nssctf.cn/problem/824)
- **题目原名**: [广东强网杯 2021 个人决赛]pic
- **题目链接**: https://www.nssctf.cn/problem/824
- **题目类型**: MISC
- **附件**: `b1177a5db0ef4fc5a9a972edb92e5e0a.zip`
- **解压后**: `12.png`（一张皮卡丘图片）

---

## 解题过程

### 第一步：ZIP 解压与初步分析

解压附件后得到 `12.png`，使用 `file` 命令检查：

```bash
$ file 12.png
12.png: PNG image data, 819 x 720, 8-bit/color RGBA, non-interlaced
```

### 第二步：PNG 尾部文件附加隐写

使用 `binwalk` 扫描 `12.png`，发现 PNG 数据尾部附加了一个 ZIP 压缩包：

```bash
$ binwalk 12.png

DECIMAL       HEXADECIMAL     DESCRIPTION
--------------------------------------------------------------------------------
338194        0x52912         Zip archive data, at least v2.0 to extract, compressed size: 1482618, uncompressed size: 1486879, name: 6.png
1820847       0x1BC8AF        Zip archive data, at least v2.0 to extract, compressed size: 2162502, uncompressed size: 2251673, name: 67.png
```

提取 ZIP 并解压，得到两张尺寸相同的动漫壁纸：
- `6.png` (1920×1080, RGB)
- `67.png` (1920×1080, RGB)

### 第三步：双图对比分析

两张图片外观几乎完全一致。使用 Python 对比像素值，发现差异**仅存在于蓝色通道（B通道）**：

```python
import numpy as np
from PIL import Image

im1 = np.array(Image.open('6.png'))
im2 = np.array(Image.open('67.png'))

print('Arrays equal:', np.array_equal(im1, im2))  # False
print('Diff pixels count:', np.count_nonzero(im1 != im2))  # 427558
print('Diff only in channel:', np.where(np.any(im1 != im2, axis=(0,1)))[0])  # [2]
```

差异值范围 `-228 ~ 18`，绝大多数集中在 `±10`，这是典型的**频域盲水印（Invisible Watermark）**特征。

### 第四步：盲水印提取

该题为 **双图盲水印**，需要使用专门的盲水印提取工具。这里使用开源项目 [chishaxie/BlindWaterMark](https://github.com/chishaxie/BlindWaterMark) 中的 `bwmforpy3.py` 脚本：

```bash
# 下载工具
git clone https://gitcode.com/gh_mirrors/bli/BlindWaterMark.git

# 运行解码（6.png 作为原图，67.png 作为带水印图）
python3 bwmforpy3.py decode 6.png 67.png flag.png
```

输出：
```
image<6.png> + image(encoded)<67.png> -> watermark<flag.png>
```

### 第五步：读取 Flag

打开提取出的 `flag.png`，在图片顶部可清晰看到水印文字：

```
flag{VhdRCg1v7OzzoYM}
```

---

## 涉及知识点

1. **文件附加隐写（File Carving）**: PNG 尾部附加 ZIP 数据，使用 `binwalk` 提取
2. **双图盲水印（Dual-Image Blind Watermark）**: 利用 FFT 频域将水印嵌入图片，肉眼不可见，需原图+带水印图配合提取
3. **工具**: `binwalk`, `bwmforpy3.py` (BlindWaterMark)

---

## 最终 Flag

```
flag{VhdRCg1v7OzzoYM}
```
