using System.Linq;
using System.Text;

namespace basicchall
{
    class Program
    {
        public static string usageString = "Usage: Chall.exe";

        static string encryptedstuff(string arg)
        {
            return hahalambdasgobrr(uselessEncode(arg));
        }

        public static string uselessEncode(string plainText)
        {
            var plainTextBytes = System.Text.Encoding.UTF8.GetBytes(plainText);
            return System.Convert.ToBase64String(plainTextBytes);
        }

        static string hahalambdasgobrr(string input)
        {
            return !string.IsNullOrEmpty(input) ? new string(input.ToCharArray().Select(s => { return (char)((s >= 97 && s <= 122) ? ((s + 13 > 122) ? s - 13 : s + 13) : (s >= 65 && s <= 90 ? (s + 13 > 90 ? s - 13 : s + 13) : s)); }).ToArray()) : input;
        }

        static void Main(string[] args)
        {
            string currentFlag = "8089390364467735077698396472118844991784106353624232752188925117000642749078392477000726461474971635917016810390936570526153112519081470670206265855935361540194194923977832689103430508815864607887175397925922606678257211908276404240676101731946520582573307113692772061443045502502491987593439178171359818088442419721372220822555";
            System.Numerics.BigInteger theFlag = System.Numerics.BigInteger.Parse(currentFlag);
            if (args.Length > 2)
            {
                System.Console.WriteLine(usageString);
            }

            string possibleFlag = System.Console.ReadLine();

            var result = string.Join("", possibleFlag.Select(c => ((int)c).ToString("X2")));

            var iLoveEncryption = encryptedstuff(result);

            System.Numerics.BigInteger sum = new System.Numerics.BigInteger(0);

            for (int i = 0; i < iLoveEncryption.Length; i++)
            {
                sum <<= 21;
                sum += ((int)iLoveEncryption[i]) * 0x1337;
            }

            if (sum == theFlag)
            {
                System.Console.WriteLine("You got the flag!");
            }

        }
    }
}
