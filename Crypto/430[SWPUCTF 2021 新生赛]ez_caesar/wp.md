## 430[SWPUCTF 2021 新生赛]ez_caesar

```python
import base64
def caesar(plaintext):
    str_list = list(plaintext)
    i = 0
    while i < len(plaintext):
        if not str_list[i].isalpha():
            str_list[i] = str_list[i]
        else:
            a = "A" if str_list[i].isupper() else "a"
            str_list[i] = chr((ord(str_list[i]) - ord(a) + 5) % 26 + ord(a) or 5)
        i = i + 1

    return ''.join(str_list)
```
为凯撒加密，偏移量为5
base64解密后将源代码的`+5`改为`-5`即可，后续`or5`为干扰条件
```python
            str_list[i] = chr((ord(str_list[i]) - ord(a) + 5) % 26 + ord(a) or 5)
```

获取最终flag为`NSSCTF{youhaveknowcaesar}`