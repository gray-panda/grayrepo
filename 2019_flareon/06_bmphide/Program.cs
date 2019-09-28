using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Drawing;
using System.IO;

namespace Flare2019_6_bmphied
{
    class Program
    {
        public static int yy = 20;
        public static string ww = "1F7D";
        public static string zz = "MTgwMw==";

        static void Main(string[] args)
        {           
            Bitmap bmp = new Bitmap("image.bmp");
            byte[] enc = Program.reverse_i(bmp);
            File.WriteAllBytes("msg.enc", enc);

            byte[] msg = Program.reverse_h(enc);
            File.WriteAllBytes("msg", msg);
            return;
        }

        public static byte[] reverse_h(byte[] data)
        {
            byte[] array = new byte[data.Length];
            int num = 0;
            for (int i=0; i < data.Length; i++)
            {
                byte key1 = Program.g(num++);
                byte key2 = Program.g(num++);
                //byte key1 = 0x3f;
                //byte key2 = 0xfd;

                byte tmp = data[i];
                tmp = Program.b(tmp, 3);
                tmp = Program.e(tmp, key2);
                tmp = Program.d(tmp, 7);
                tmp = Program.e(tmp, key1);
                array[i] = tmp;
            }
            return array;
        }

        public static byte[] h(byte[] data) // modded by the init code?
        {
            byte[] array = new byte[data.Length];
            int num = 0;
            for (int i = 0; i < data.Length; i++)
            {
                int num2 = (int)Program.g(num++);
                int num3 = (int)data[i];
                num3 = (int)Program.e((byte)num3, (byte)num2);
                num3 = (int)Program.b((byte)num3, 7);
                int num4 = (int)Program.g(num++);
                num3 = (int)Program.e((byte)num3, (byte)num4);
                num3 = (int)Program.d((byte)num3, 3);
                array[i] = (byte)num3;
            }
            return array;
        }

        public static byte[] h_orig(byte[] data)
        {
            byte[] array = new byte[data.Length];
            int num = 0;
            for (int i = 0; i < data.Length; i++)
            {
                int num2 = (int)Program.f(num++); // f modded to point to g
                int num3 = (int)data[i];
                num3 = (int)Program.e((byte)num3, (byte)num2);
                num3 = (int)Program.a((byte)num3, 7);   // a modded to point to b
                int num4 = (int)Program.f(num++);
                num3 = (int)Program.e((byte)num3, (byte)num4);
                num3 = (int)Program.c((byte)num3, 3); // c modded to point to d
                array[i] = (byte)num3;
            }
            return array;
        }

        public static byte g(int idx)
        {
            //byte b = unchecked((byte)((long)(idx + 1) * (long)((ulong)-306674912)));
            byte b = (byte)((idx + 1) * 0xc5);
            //byte k = (byte)((idx + 2) * 1669101435);
            byte k = (byte)((idx + 2) * 0x7d);
            return Program.e(b, k);
        }

        public static byte f(int idx)
        {
            int num = 0;
            int num2 = 0;
            byte result = 0;
            int[] array = new int[]
            {
                121,255,214,60,106,216,149,89,96,29,81,123,182,24,167,252,
                88,212,43,85,181,86,108,213,50,78,247,83,193,35,135,217,
                0,64,45,236,134,102,76,74,153,34,39,10,192,202,71,183,
                185,175,84,118,9,158,66,128,116,117,4,13,46,227,132,240,
                122,11,18,186,30,157,1,154,144,124,152,187,32,87,141,103,
                189,12,53,222,206,91,20,174,49,223,155,250,95,31,98,151,
                179,101,47,17,207,142,199,3,205,163,146,48,165,225,62,33,
                119,52,241,228,162,90,140,232,129,114,75,82,190,65,2,21,
                14,111,115,36,107,67,126,80,110,23,44,226,56,7,172,221,
                239,161,61,93,94,99,171,97,38,40,28,166,209,229,136,130,
                164,194,243,220,25,169,105,238,245,215,195,203,170,16,109,176,
                27,184,148,131,210,231,125,177,26,246,127,198,254,6,69,237,
                197,54,59,137,79,178,139,235,249,230,233,204,196,113,120,173,
                224,55,92,211,112,219,208,77,191,242,133,244,168,188,138,251,
                70,150,145,248,180,218,42,15,159,104,22,37,72,63,234,147,
                200,253,100,19,73,5,57,201,51,156,41,143,68,8,160,58
            };
            for (int i = 0; i <= idx; i++)
            {
                num++;
                num %= 256;
                num2 += array[num];
                num2 %= 256;
                int num3 = array[num];
                array[num] = array[num2];
                array[num2] = num3;
                result = (byte)array[(array[num] + array[num2]) % 256];
            }
            return result;
        }

        public static byte e(byte b, byte k)
        {
            for (int i = 0; i < 8; i++)
            {
                bool flag = (b >> i & 1) == (k >> i & 1);
                if (flag)
                {
                    b = (byte)((int)b & ~(1 << i) & 255);
                }
                else
                {
                    b = (byte)((int)b | (1 << i & 255));
                }
            }
            return b;
        }

        public static byte a(byte b, int r)
        {
            return (byte)(((int)b + r ^ r) & 255);
        }

        public static byte c(byte b, int r)
        {
            byte b2 = 1;
            for (int i = 0; i < 8; i++)
            {
                bool flag = (b & 1) == 1;
                if (flag)
                {
                    b2 = (byte) (b2 * 2 + 1 & byte.MaxValue);
                }
                else
                {
                    b2 = (byte) (b2 - 1 & byte.MaxValue);
                }
            }
            return b2;
        }

        public static byte b(byte b, int r)
        {
            for (int i = 0; i < r; i++)
            {
                byte b2 = (byte) ((b & 128) / 128);
                b = (byte) ((b * 2 & byte.MaxValue) + b2);
            }
            return b;
        }

        public static byte d(byte b, int r)
        {
            for (int i = 0; i < r; i++)
            {
                byte b2 = (byte) ((b & 1) * 128);
                b = (byte) ((b / 2 & byte.MaxValue) + b2);
            }
            return b;
        }

        public static byte[] reverse_i(Bitmap bm)
        {
            int msglen = bm.Width * bm.Height;
            byte[] ret = new byte[msglen];

            for (int i=0; i < bm.Width; i++)
            {
                for (int j=0; j < bm.Height; j++)
                {
                    Color pixel = bm.GetPixel(i, j);
                    byte tmp = (byte)((pixel.R & 0x7) | ((pixel.G & 0x7) << 3) | ((pixel.B & 0x3) << 6));
                    ret[(i * bm.Height) + j] = tmp;
                }
            }

            return ret;
        }

        public static void i(Bitmap bm, byte[] data)
        {
            int num = 0;
            for (int i = 0; i < bm.Width; i++)
            {
                for (int j = 0; j < bm.Height; j++)
                {
                    bool flag = num > data.Length - 1;
                    if (flag)
                    {
                        break;
                    }
                    Color pixel = bm.GetPixel(i, j);
                    int red = ((int)pixel.R & 0xf8) | ((int)data[num] & 0x07);
                    int green = ((int)pixel.G & 0xf8) | (data[num] >> 0x03 & 0x07);
                    int blue = ((int)pixel.B & 0xfc) | (data[num] >> 0x06 & 0x03);
                    Color color = Color.FromArgb(0, red, green, blue);
                    bm.SetPixel(i, j, color);
                    num += 1;
                }
            }
        }

        public static void i_orig(Bitmap bm, byte[] data)
        {
            int num = Program.j(103);
            for (int i = Program.j(103); i < bm.Width; i++)
            {
                for (int j = Program.j(103); j < bm.Height; j++)
                {
                    bool flag = num > data.Length - Program.j(231);
                    if (flag)
                    {
                        break;
                    }
                    Color pixel = bm.GetPixel(i, j);
                    int red = ((int)pixel.R & Program.j(27)) | ((int)data[num] & Program.j(228));
                    int green = ((int)pixel.G & Program.j(27)) | (data[num] >> Program.j(230) & Program.j(228));
                    int blue = ((int)pixel.B & Program.j(25)) | (data[num] >> Program.j(100) & Program.j(230));
                    Color color = Color.FromArgb(Program.j(103), red, green, blue);
                    bm.SetPixel(i, j, color);
                    num += Program.j(231);
                }
            }
        }

        public static int j(byte z)
        {
            uint num = Convert.ToUInt32(Program.ww, 16);
            num = (uint)((ulong)num * (ulong)((long)Program.yy));
            byte[] bytes = Convert.FromBase64String(Program.zz);
            string value = Encoding.Default.GetString(bytes);
            num += Convert.ToUInt32(value);
            num += 4u;
            num += (uint)Program.f(6);
            z = Program.b(z, 1);
            return (int)Program.e(z, (byte)num);
        }

        public static int j_orig(byte z)
        {
            byte b = 5;
            uint num = 0u;
            string value = "";
            byte[] bytes = new byte[8];
            for (;;)
            {
                bool flag = b == 1;
                if (flag)
                {
                    num += 4u;
                    b += 2;
                }
                else
                {
                    bool flag2 = b == 2;
                    if (flag2)
                    {
                        num = (uint)((ulong)num * (ulong)((long)Program.yy));
                        b += 8;
                    }
                    else
                    {
                        bool flag3 = b == 3;
                        if (flag3)
                        {
                            num += (uint)Program.f(6);
                            b += 1;
                        }
                        else
                        {
                            bool flag4 = b == 4;
                            if (flag4)
                            {
                                z = Program.b(z, 1);
                                b += 2;
                            }
                            else
                            {
                                bool flag5 = b == 5;
                                if (flag5)
                                {
                                    num = Convert.ToUInt32(Program.ww, 16);
                                    b -= 3;
                                }
                                else
                                {
                                    bool flag6 = b == 6;
                                    if (flag6)
                                    {
                                        break;
                                    }
                                    bool flag7 = b == 7;
                                    if (flag7)
                                    {
                                        num += Convert.ToUInt32(value);
                                        b -= 6;
                                    }
                                    else
                                    {
                                        bool flag8 = b == 10;
                                        if (flag8)
                                        {
                                            bytes = Convert.FromBase64String(Program.zz);
                                            b += 4;
                                        }
                                        else
                                        {
                                            bool flag9 = b == 14;
                                            if (flag9)
                                            {
                                                value = Encoding.Default.GetString(bytes);
                                                b -= 7;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            return (int)Program.e(z, (byte)num);
        }

    }
}
