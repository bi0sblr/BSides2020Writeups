# Writeup
 
Again, [HCS has already done a good writeup on this one](https://medium.com/@ret2ex/writeup-reverse-engineering-bsides-delhi-ctf-2020-8a3f8bc92fb), so I'd recommend reading this over mine, as I'm not going to do actual reversing in this.

# The Exploit file:

```python3

import base64

flag = "QVZESV9FdDVmNm1yc1QzdHZrZXgK"

flag = base64.b64decode(flag).decode('ascii')[:-1]

flag_low = []

flag_up = []

# fill up the lists
for i in flag:
    up = ord(i)>>4;
    flag_low.append(ord(i)&0xf)
    flag_up.append(up)

# the bruteforcing logic
for i in range(len(flag)):
    temp = flag_low[i:] + flag_low[:i]
    print(temp)
    possible_flag = ""
    for j in range(len(temp)):
        possible_flag += chr(flag_up[j]*16+temp[j])
    print(i,possible_flag)

```

The flag is printed at i=11, and the flag is `BSDCTF{5h1fty_5tuff}`



