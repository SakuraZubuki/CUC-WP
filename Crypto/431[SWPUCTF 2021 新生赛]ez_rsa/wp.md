## [SWPUCTF 2021 新生赛]ez_rsa
```
p = 1325465431
q = 152317153
e = 65537
计算出d,将d用MD5加密后包裹NSSCTF{}提交

```

算就完了
```python
import gmpy2
import hashlib

p = 1325465431
q = 152317153
e = 65537

# 计算 n 和 phi(n)
n = p * q
phi_n = (p - 1) * (q - 1)

# 求私钥 d
d = gmpy2.invert(e, phi_n)

# 转成字符串后做 MD5
d_str = str(d)
md5_value = hashlib.md5(d_str.encode()).hexdigest()

# 按题目要求包裹
flag = f"NSSCTF{{{md5_value}}}"

print("d =", d)
print("MD5(d) =", md5_value)
print("flag =", flag)
```