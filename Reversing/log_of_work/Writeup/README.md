 
# Writeup

This is a .NET chall, the source code can be obtained using DnSpy.

So this is a challenge where the hardest part would be to decrypt this loop:

```Csharp
for (int i = 0; i < iLoveEncryption.Length; i++)
            {
                sum <<= 21;
                sum += ((int)iLoveEncryption[i]) * 0x1337;
            }
```

This can be trivially done by simply modding the `right` variable with 2²¹ and then dividing it by 0x1337, and here's the code to do that:

```python
import codecs
import base64

hugeNumber = 8089390364467735077698396472118844991784106353624232752188925117000642749078392477000726461474971635917016810390936570526153112519081470670206265855935361540194194923977832689103430508815864607887175397925922606678257211908276404240676101731946520582573307113692772061443045502502491987593439178171359818088442419721372220822555

firstStage = ""

while hugeNumber > 0:
    firstStage += chr(int(hugeNumber%(2**21)/0x1337))
    hugeNumber = hugeNumber>>21;
```

After that, it's decoding rot13, and base64, after which you have to decode hex:

```python
hexstring = base64.b64decode(codecs.decode(firstStage,'rot13')[::-1])

print(codecs.decode(hexstring,'hex').decode('ascii'))
```

The final answer is: `BSDCTF{1m_50_50rry}`

