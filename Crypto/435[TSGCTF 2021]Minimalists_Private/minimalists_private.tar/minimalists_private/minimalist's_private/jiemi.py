from Crypto.Util.number import isPrime, inverse, long_to_bytes
import math

# 题目给出的数据
N = 1108103848370322618250236235096737547381026108763302516499816051432801216813681568375319595638932562835292256776016949573972732881586209527824393027428125964599378845347154409633878436868422905300799413838645686430352484534761305185938956589612889463246508935994301443576781452904666072122465831585156151 # 填入 N
e = 65537   # 填入 e
c = 254705401581808316199469430068831357413481187288921393400711004895837418302514065107811330660948313420965140464021505716810909691650540609799307500282957438243553742714371028405100267860418626513481187170770328765524251710154676478766892336610743824131087888798846367363259860051983889314134196889300426 # 填入 c

# 枚举 a, b，其中 a * b <= 10000
found = False
for a in range(1, 10001):
    if found:
        break
    for b in range(1, 10001 // a + 1):
        S = a * b
        # 判别式 Δ = (a - b)^2 + 4*S*N
        delta = (a - b) ** 2 + 4 * S * N
        sqrt_delta = math.isqrt(delta)
        if sqrt_delta * sqrt_delta != delta:
            continue  # 不是完全平方数，跳过

        # 求解 g = (- (a+b) + sqrt(Δ)) // (2*S)
        num = - (a + b) + sqrt_delta
        if num <= 0 or num % (2 * S) != 0:
            continue
        g = num // (2 * S)

        p = a * g + 1
        q = b * g + 1

        if p * q != N:
            continue
        # 验证素数（可选）
        if not (isPrime(p) and isPrime(q)):
            continue

        print(f"[+] 找到分解：")
        print(f"    a = {a}, b = {b}, g = {g}")
        print(f"    p = {p}")
        print(f"    q = {q}")

        # 计算私钥
        phi = (p - 1) * (q - 1)
        # 也可用卡迈克尔函数 λ = lcm(p-1, q-1)，效果相同
        d = inverse(e, phi)
        m = pow(c, d, N)
        flag = long_to_bytes(m)
        print(f"[+] Flag: {flag.decode()}")
        found = True
        break

if not found:
    print("[-] 未找到有效的 a, b，请检查数据或扩大搜索范围。")