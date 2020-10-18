import random
from collections import deque

flag = "BSDCTF{1_w4nt3d_t0_put_4t_l345t_0n3_h4rd_ch411}"
print(len(flag))

flag_upper = deque([])

flag_lower = deque([])

for i in flag:
    lower_part = ord(i)&0x0f
    upper_part = int((ord(i)&0xf0)/16)
    flag_upper.append(upper_part)
    flag_lower.append(lower_part)

shift = random.randint(10,len(flag))

flag_lower.rotate(shift)

print(list(flag_upper))

print(list(flag_lower))
