from z3 import *

# 目标结果
target_result = 591620785604527668617886

# --- 约束条件 ---
FLAG_LEN = 18
FLAG_PREFIX = "NSSCTF{"
FLAG_SUFFIX = "}"

# --- Z3 设置 ---
solver = Solver()
flag_chars = [BitVec(f'c_{i}', 8) for i in range(FLAG_LEN)]

# --- 添加约束 ---

# 1. 基础约束：所有字符都是可打印 ASCII (32-126)
for char_var in flag_chars:
    solver.add(And(char_var >= 32, char_var <= 126))

# 2. 格式约束：固定的前缀和后缀
for i, char_val in enumerate(FLAG_PREFIX):
    solver.add(flag_chars[i] == ord(char_val))
solver.add(flag_chars[FLAG_LEN - 1] == ord(FLAG_SUFFIX))

unknown_part_start_index = len(FLAG_PREFIX)
unknown_part_end_index = FLAG_LEN - len(FLAG_SUFFIX)

for i in range(unknown_part_start_index, unknown_part_end_index):
    char_var = flag_chars[i]
    is_upper = And(char_var >= ord('A'), char_var <= ord('Z'))
    is_underscore = (char_var == ord('_'))
    solver.add(Or(is_upper, is_underscore))

# 3. 加密逻辑约束 (与之前完全相同)
reversed_flag_chars = flag_chars[::-1]
result = None
for i in range(0, FLAG_LEN - 1):
    s1 = ZeroExt(120, reversed_flag_chars[i])
    s2 = ZeroExt(120, reversed_flag_chars[i+1])
    current_val = (s1 << 8) ^ (s2 << 4) ^ s2
    if i == 0:
        result = current_val
    else:
        result = (result << 4) ^ current_val
solver.add(result == target_result)

# --- 循环求解，找出所有可能的解 ---
print(f"[*] 正在爆破所有长度为 {FLAG_LEN}，格式为 '{FLAG_PREFIX}...{FLAG_SUFFIX}' 的解...")
solution_count = 0
while solver.check() == sat:
    solution_count += 1
    model = solver.model()

    # 从模型中提取 flag
    flag_list = [chr(model[c].as_long()) for c in flag_chars]
    flag = "".join(flag_list)

    print(f"[+] 找到解 #{solution_count}: {flag}")

    # 关键：添加约束以排除当前解，从而在下一次循环中找到新的解
    # 我们需要排除整个flag的所有变量组合
    current_solution_expr = And([c == model[c] for c in flag_chars])
    solver.add(Not(current_solution_expr))

print("-" * 30)
if solution_count == 0:
    print("[-] 未找到任何满足条件的解。")
else:
    print(f"[*] 爆破完成，共找到 {solution_count} 个数学解。")