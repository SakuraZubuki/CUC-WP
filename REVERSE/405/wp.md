## [SWPUCTF 2021 新生赛]非常简单的逻辑题

### 编码逻辑
- 分解: 对每个字符 flag[i]，计算 s1 = ord(flag[i]) // 17, s2 = ord(flag[i]) % 17。
- 映射: 使用字符集 s（34字符），添加偏移 i：result += s[(s1 + i) % 34] + s[-(s2 + i + 1) % 34]。
- 输出: 42字符的编码字符串，如 'v0b9n1nkajz@j0c4jjo3oi1h1i937b395i5y5e0e$i'。

NSSCTF{Fake_RERE_QAQ}