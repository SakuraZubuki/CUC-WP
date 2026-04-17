c = '93 53 63 71 51 63 41 51 83 63 23 23 93 62 61 94 93 71 41 92 41 71 63 41 51 31 83 43 41 21 81 22 21 74 42'

# 九宫格键盘映射（2-9行，每行字母）
table = ['ABC','DEF','GHI','JKL','MNO','PQRS','TUV','WXYZ']

nums = c.split(' ')
result = ''
for num in nums:
    row = int(num[0]) - 2      # 第一个数字-2 = 行索引（0-7）
    col = int(num[1]) - 1      # 第二个数字-1 = 列索引
    result += table[row][col]

print(result)
# 输出：YLOPJOGJVOCCYNMZYPGXGPOGJDVIGATBASH