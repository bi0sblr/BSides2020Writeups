#include <stdio.h>
#include <string.h>

unsigned char code[] = "\xfe\xe3\x22\x4e\xe3\x22\xd6\x53\xe3\x20\xee\x53\xa4\x1d\xab\x97\xe9\xa4\x2e\x33\xaa\xab\xab\xe3\x20\xee\x53\xe3\x28\x6b\xaa\xa4\x1d\xab\x97\xf8\xa4\x2e\x2e\xaa\xab\xab\xe3\x20\xee\x53\xe3\x28\x6b\xa9\xa4\x1d\xab\x97\xef\xa4\x2e\xd9\xaa\xab\xab\xe3\x20\xee\x53\xe3\x28\x6b\xa8\xa4\x1d\xab\x97\xe8\xa4\x2e\xf4\xaa\xab\xab\xe3\x20\xee\x53\xe3\x28\x6b\xaf\xa4\x1d\xab\x97\xff\xa4\x2e\xe7\xaa\xab\xab\xe3\x20\xee\x53\xe3\x28\x6b\xae\xa4\x1d\xab\x97\xed\xa4\x2e\x92\xaa\xab\xab\xe3\x20\xee\x53\xe3\x28\x6b\xad\xa4\x1d\xab\x97\xd0\xa4\x2e\x8d\xaa\xab\xab\xe3\x20\xee\x53\xe3\x28\x6b\xac\xa4\x1d\xab\x97\xd8\xa4\x2e\xb8\xaa\xab\xab\xe3\x20\xee\x53\xe3\x28\x6b\xa3\xa4\x1d\xab\x97\xde\xa4\x2e\xab\xaa\xab\xab\xe3\x20\xee\x53\xe3\x28\x6b\xa2\xa4\x1d\xab\x97\xdb\xa4\x2e\x46\xab\xab\xab\xe3\x20\xee\x53\xe3\x28\x6b\xa1\xa4\x1d\xab\x97\x98\xa4\x2e\x71\xab\xab\xab\xe3\x20\xee\x53\xe3\x28\x6b\xa0\xa4\x1d\xab\x97\xd9\xa4\x2e\x6c\xab\xab\xab\xe3\x20\xee\x53\xe3\x28\x6b\xa7\xa4\x1d\xab\x97\xf4\xa4\x2e\x1f\xab\xab\xab\xe3\x20\xee\x53\xe3\x28\x6b\xa6\xa4\x1d\xab\x97\xd8\xa4\x2e\xa\xab\xab\xab\xe3\x20\xee\x53\xe3\x28\x6b\xa5\xa4\x1d\xab\x97\xc3\xa4\x2e\x25\xab\xab\xab\xe3\x20\xee\x53\xe3\x28\x6b\xa4\xa4\x1d\xab\x97\x9b\xde\xd4\xe3\x20\xee\x53\xe3\x28\x6b\xbb\xa4\x1d\xab\x97\xd9\xde\xdb\xe3\x20\xee\x53\xe3\x28\x6b\xba\xa4\x1d\xab\x97\xdf\xde\xca\xe3\x20\xee\x53\xe3\x28\x6b\xb9\xa4\x1d\xab\x97\xf4\xde\xf9\xe3\x20\xee\x53\xe3\x28\x6b\xb8\xa4\x1d\xab\x97\xcd\xde\xe8\xe3\x20\xee\x53\xe3\x28\x6b\xbf\xa4\x1d\xab\x97\xc7\xde\x9f\xe3\x20\xee\x53\xe3\x28\x6b\xbe\xa4\x1d\xab\x97\x9f\xde\x8e\xe3\x20\xee\x53\xe3\x28\x6b\xbd\xa4\x1d\xab\x97\xcc\xde\xbd\xe3\x20\xee\x53\xe3\x28\x6b\xbc\xa4\x1d\xab\x97\xd6\xde\xac\x13\x15\x11\x78\x6b\x40\xae\x13\x44\x15\x9c\xb8\xf6\x68";

int main(int argc, char **argv) {
  int foo_value, pin;
  int (*foo)() = (int(*)())code;

  printf("Enter the PIN to decrypt the second part of the chall (less than 0xff):");
  
  scanf("%d", &pin);
  
  printf("Decrypting shellcode...\n");

  for(int i = 0; i < 438; i++)
  {
      __asm__("db 0x20");
      code[i] = code[i]^pin;
  }
  
  foo_value = (unsigned) foo(argv[1]);
 
  if(foo_value < 0)
      printf("You have gotten the flag! Submit it now and Good job!\n");
  else
      printf("Try Again?\n");
  
  return 0;
}
