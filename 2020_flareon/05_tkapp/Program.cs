using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Security.Cryptography;
using System.IO;

namespace flare2020
{
    class Program
    {
        static void Main(string[] args)
        {
            byte[] key = SHA256.Create().ComputeHash(Encoding.ASCII.GetBytes("the kind of challenges we are gonna make here"));
            byte[] bytes = Encoding.ASCII.GetBytes("NoSaltOfTheEarth");
            byte[] enc = File.ReadAllBytes("Runtime.dll");
            try
            {
                string result = GetString(enc, key, bytes);
                Console.WriteLine(result);
                byte[] something = Convert.FromBase64String(result);
                File.WriteAllBytes("flag.jpg", something);
                Console.WriteLine("Wrote output into flag.jpg");

            }
            catch (Exception ex)
            {
                Console.WriteLine("Failed: " + ex.Message, 1000);
            }
        }

        public static string GetString(byte[] cipherText, byte[] Key, byte[] IV)
        {
            string result = null;
            using (RijndaelManaged rijndaelManaged = new RijndaelManaged())
            {
                rijndaelManaged.Key = Key;
                rijndaelManaged.IV = IV;
                ICryptoTransform cryptoTransform = rijndaelManaged.CreateDecryptor(rijndaelManaged.Key, rijndaelManaged.IV);
                using (MemoryStream memoryStream = new MemoryStream(cipherText))
                {
                    using (CryptoStream cryptoStream = new CryptoStream(memoryStream, cryptoTransform, 0))
                    {
                        using (StreamReader streamReader = new StreamReader(cryptoStream))
                        {
                            result = streamReader.ReadToEnd();
                        }
                    }
                }
            }
            return result;
        }
    }
}
