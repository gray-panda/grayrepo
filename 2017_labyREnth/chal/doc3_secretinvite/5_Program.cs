using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Security.Cryptography;

namespace Laby2017_Docs03
{
    class Program
    {
        public static byte[] MagicMum = new byte[]
        {36,57,24,27,12,18,28,24,5,77,16,77,31,7,46,12,23,68,11,20,56,46,44,12,4,75,41,40,62,57,79,37,51,40,49,4,60,10,53,52,30,79,12,12,46,23,68,78,39,54,14,7,57,13,44,40,42,22,52,59,56,7,48,41,56,17,41,37,48,37,30,51,76,21,7,48,57,75,47,52,74,74,82,5,49,60,64,64};

        public static byte[] MagicNum = new byte[]
        {9,62,27,18,14,45,45,31,17,15,36,41,69,26,86,23,28,20,22,39,26,9,5,48,44,75,59,69,43,82,47,57,37,18,31,76,52,12,4,42,26,48,8,31,30,82,7,37,51,63,12,22,82,24,72,12,60,48,5,54,30,63,16,52,56,14,9,44,49,12,8,24,73,16,37,60,8,39,73,14,20,11,40,79,56,44,64,64};

        public static string szKeyValue = "4c61627972656e746843544632303137";
        public static string szhighkey = "LvP\"L!@eo:]YPx-Avg~Sm_\u007fx>Fef|#`]fq@]T&L>Vcb(";
        public static string szlowkey = "RE,G pZ_QQt \u007f:S'^BMRXoe xs\"oO|Y#\u007f^\"SXTQ&'!P(";
        public static string szmidkey = "F^>Y!\"t|fQlcM-z>o@E#^ {y\\Q%`pS{YdvcSTd~'Ftf(";

        public static byte[] trollMum = new byte[]
        {77,13,41,73,82,75,36,51,53,45,42,12,44,46,37,55,27,76,12,72,41,59,53,13,59,59,62,12,73,21,78,79,47,63,44,59,62,11,37,41,54,37,4,24,10,48,27,82,39,10,72,25,68,28,25,14,18,37,5,45,57,76,17,12,45,41,49,27,82,12,52,30,17,53,25,78,50,4,27,74,82,45,57,62,43,60,64,64};

        public static byte[] trollNum = new byte[]
        {50,5,56,4,73,31,58,50,16,52,36,59,57,19,10,62,19,86,39,74,63,78,41,11,8,22,51,11,47,75,68,7,15,12,69,28,69,47,73,86,63,37,18,9,12,37,9,75,60,69,12,4,22,19,14,76,56,52,18,75,16,73,14,14,25,69,54,25,36,74,55,8,37,56,42,41,28,37,39,25,55,53,57,24,40,10,64,64};

        static void Main(string[] args)
        {
            // Troll Num
            string str4 = Program.Decrypt(Program.StringToXOR(Program.ByteToStr(Program.trollNum)), Program.szKeyValue);
            Console.WriteLine("Sanity Check: "+str4);

            // Low key
            String tmp = Program.xorToString(Program.szlowkey);
            String low = Program.Decrypt(tmp, Program.szKeyValue);
            Console.WriteLine("Low Key: " + low);

            // Mid Key
            tmp = Program.xorToString(Program.szmidkey);
            String mid = Program.Decrypt(tmp, Program.szKeyValue);
            Console.WriteLine("Mid Key: " + mid);

            // High Key
            tmp = Program.xorToString(Program.szhighkey);
            String high = Program.Decrypt(tmp, Program.szKeyValue);
            Console.WriteLine("High Key: " + high);

            // Strings?
            string str = Program.Decrypt(Program.StringToXOR(Program.ByteToStr(Program.trollMum)), Program.szKeyValue);
            Console.WriteLine(str);
            string str2 = Program.Decrypt(Program.StringToXOR(Program.ByteToStr(Program.MagicNum)), Program.szKeyValue);
            Console.WriteLine(str2);
            string str3 = Program.Decrypt(Program.StringToXOR(Program.ByteToStr(Program.MagicMum)), Program.szKeyValue);
            Console.WriteLine(str3);

            Console.ReadLine();
        }

        public static string Decrypt(string textToDecrypt, string key)
        {
            RijndaelManaged expr_05 = new RijndaelManaged();
            expr_05.Mode = CipherMode.CBC;
            expr_05.Padding = PaddingMode.PKCS7;
            expr_05.KeySize = 256;
            expr_05.BlockSize = 256;
            byte[] array = Convert.FromBase64String(textToDecrypt);
            byte[] arg_43_0 = Encoding.UTF8.GetBytes(key);
            byte[] array2 = new byte[32];
            int length = arg_43_0.Length;
            Array.Copy(arg_43_0, array2, length);
            expr_05.Key = array2;
            expr_05.IV = array2;
            byte[] bytes = expr_05.CreateDecryptor().TransformFinalBlock(array, 0, array.Length);
            return Encoding.UTF8.GetString(bytes);
        }

        public static string Encrypt(string textToEncrypt, string key)
        {
            RijndaelManaged expr_05 = new RijndaelManaged();
            expr_05.Mode = CipherMode.CBC;
            expr_05.Padding = PaddingMode.PKCS7;
            expr_05.KeySize = 256;
            expr_05.BlockSize = 256;
            byte[] arg_3C_0 = Encoding.UTF8.GetBytes(key);
            byte[] array = new byte[32];
            int length = arg_3C_0.Length;
            Array.Copy(arg_3C_0, array, length);
            expr_05.Key = array;
            expr_05.IV = array;
            ICryptoTransform arg_6B_0 = expr_05.CreateEncryptor();
            byte[] bytes = Encoding.UTF8.GetBytes(textToEncrypt);
            return Convert.ToBase64String(arg_6B_0.TransformFinalBlock(bytes, 0, bytes.Length));
        }

        public static string StringToXOR(string data)
        {
            string arg_05_0 = string.Empty;
            byte[] array = new byte[data.Length];
            array = Program.stringTobyte(data);
            for (int i = 0; i < array.Length; i++)
            {
                byte[] expr_24_cp_0 = array;
                int expr_24_cp_1 = i;
                expr_24_cp_0[expr_24_cp_1] ^= 37;
                byte[] expr_32_cp_0 = array;
                int expr_32_cp_1 = i;
                expr_32_cp_0[expr_32_cp_1] ^= 88;
            }
            return Program.ByteTostring(array);
        }

        public static string xorToString(string data)
        {
            string arg_05_0 = string.Empty;
            byte[] array = new byte[data.Length];
            array = Program.stringTobyte(data);
            for (int i = 0; i < array.Length; i++)
            {
                byte[] expr_24_cp_0 = array;
                int expr_24_cp_1 = i;
                expr_24_cp_0[expr_24_cp_1] ^= 21;
            }
            return Program.ByteTostring(array);
        }

        public static byte[] stringTobyte(string str)
        {
            return Encoding.UTF8.GetBytes(str.ToCharArray());
        }

        public static string ByteTostring(byte[] bt)
        {
            string text = "";
            for (int i = 0; i < bt.Length; i++)
            {
                text += Encoding.Default.GetString(bt, i, 1);
            }
            return text;
        }

        public static string ByteToStr(byte[] buf)
        {
            return Encoding.UTF8.GetString(buf);
        }
    }
}
