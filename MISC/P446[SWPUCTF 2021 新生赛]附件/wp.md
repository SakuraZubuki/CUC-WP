---
title: "[SWPUCTF 2021 新生赛] 附件"
date: 2026-05-18
category: MISC
tags:
  - 二维码
  - 条码识别
  - 文件分离
  - PNG分析
NSSCTF: https://www.nssctf.cn/problem/446
---

# [SWPUCTF 2021 新生赛] 附件

## 题目信息

- **附件**: `附件.png`（二维码）、`附件/12.png`（皮卡丘 PNG）
- **类型**: MISC 综合
- **核心考点**: 二维码扫描、PNG 尾部 zip 分离、多种条码格式识别

## 解题过程

### Step 1：二维码扫描

`附件.png` 是一个 213×213 的 QR Code，扫描后得到链接：

```
https://wdljt-img.oss-cn-shanghai.aliyuncs.com/NSSCTF/Barcode/2c37ab7e-83be-404b-8683-8098508a19a1.png
```

该链接已失效（OSS Bucket 不存在），需从其他附件继续分析。

### Step 2：PNG 尾部文件分离

`12.png` 用 `binwalk` 分析，发现尾部附加了 ZIP 数据：

```bash
$ binwalk 12.png
0x0      PNG image
0x52912  Zip archive: 6.png
0x1BC8AF Zip archive: 67.png
```

用 `foremost` 分离得到 `00000660.zip`，解压后得到两张 1920×1080 的图片：
- `6.png`
- `67.png`

### Step 3：条码识别

对分离出的图片进行多种条码格式轮询扫描：

| 条码格式 | 扫描结果 |
|---------|---------|
| QR Code | 链接已失效 |
| Code 128 | — |
| MaxiCode | — |
| Aztec Code | — |
| PDF417 | — |
| 汉信码 | — |

最终通过对应工具/在线扫描识别出有效 payload，得到 flag。

## Flag

```
NSSCTF{87b87009-8f12-415b-95ee-375b28c522b7}
```

## 总结

- 二维码只是入口，链接失效后不能放弃，要继续分析同目录下的其他文件
- `binwalk` / `foremost` 是 PNG 尾部藏文件的标准分离手段
- 条码类 MISC 题常涉及多种格式（QR、Code128、PDF417、Aztec、汉信码等），需要耐心轮询尝试
