from Crypto.Util.number import bytes_to_long, getPrime, inverse
from random import randint
from secret import flag

flag = bytes_to_long(flag)
d = getPrime(randint(760, 770))
f  = open('output.txt','w')
for _ in range(1,4):
    p = getPrime(1024)
    q = getPrime(1024)
    n = p * q
    phi = (p - 1) * (q - 1)
    e = inverse(d, phi)
    
    c = pow(flag, e, n)    
    f.write('\ne'+str(_)+str(' = ')+hex(e))
    f.write('\nn'+str(_)+str(' = ')+hex(n))
    f.write('\nc'+str(_)+str(' = ')+hex(c))
f.close()
