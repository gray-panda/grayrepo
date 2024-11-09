using System.Net;
using System.Text;
using System.Security.Cryptography;
using System.IO.Compression;
using System.Text.RegularExpressions;
using System.Xml.Linq;
using System.Text.Json;

using Org.BouncyCastle.Crypto;

using Org.BouncyCastle.Crypto.Engines;
using Org.BouncyCastle.Crypto.Generators;
using Org.BouncyCastle.Crypto.Modes;
using Org.BouncyCastle.Crypto.Paddings;
using Org.BouncyCastle.Crypto.Parameters;
using Org.BouncyCastle.Security;
using Org.BouncyCastle.Asn1.X9;
using Org.BouncyCastle.Math.EC;
using Org.BouncyCastle.Math;

class Program
{
    static readonly HttpClient client = new HttpClient();

    // For Bouncy Castle
    public static byte[] EncryptData(string message, string password)
    {
        // Generate a random salt
        var salt = new byte[8];
        new SecureRandom().NextBytes(salt);
        // Derive key and IV from the password and salt
        Pkcs5S2ParametersGenerator generator = new Pkcs5S2ParametersGenerator();
        generator.Init(PbeParametersGenerator.Pkcs5PasswordToBytes(password.ToCharArray()), salt, 1000);
        ParametersWithIV keyParam = (ParametersWithIV)generator.GenerateDerivedMacParameters(256 + 128);
        // Create AES cipher in CBC mode with PKCS7 padding
        var cipher = new PaddedBufferedBlockCipher(new CbcBlockCipher(new AesEngine()));
        cipher.Init(true, keyParam);
        // Convert message to byte array and encrypt
        byte[] inputBytes = Encoding.UTF8.GetBytes(message);
        byte[] outputBytes = new byte[cipher.GetOutputSize(inputBytes.Length)];
        int length = cipher.ProcessBytes(inputBytes, 0, inputBytes.Length, outputBytes, 0);
        cipher.DoFinal(outputBytes, length);
        return outputBytes;
    }

    static async Task Main()
    {
        // String manipulation
        string exampleString = "Hello World";
        string lowerString = exampleString.ToLower();
        string upperString = exampleString.ToUpper();
        string trimmedString = exampleString.Trim();
        bool containsHello = exampleString.Contains("Hello");
        string replacedString = exampleString.Replace("World", "Universe");

        // File operations
        string filePath = @"temp.txt";
        File.WriteAllText(filePath, exampleString);
        string readFile = File.ReadAllText(filePath);

        // Networking
        WebClient client = new WebClient();
        byte[] data = client.DownloadData("http://example.com");

        // Encoding
        string encodedString = Convert.ToBase64String(Encoding.UTF8.GetBytes(exampleString));
        byte[] decodedBytes = Convert.FromBase64String(encodedString);
        string decodedString = Encoding.UTF8.GetString(decodedBytes);

        // LINQ and Collections
        List<int> numbers = new List<int> { 1, 2, 3, 4, 5 };
        int maxNumber = numbers.Max();
        int minNumber = numbers.Min();
        IEnumerable<int> sortedNumbers = numbers.OrderBy(n => n);

        // Math operations
        double squareRoot = Math.Sqrt(25);
        double power = Math.Pow(2, 3);
        double absoluteValue = Math.Abs(-10.5);

        // Additional Networking Functions
        string url = "http://example.com";
        HttpWebRequest request = (HttpWebRequest)WebRequest.Create(url);
        HttpWebResponse response = (HttpWebResponse)request.GetResponse();
        Stream responseStream = response.GetResponseStream();
        StreamReader reader = new StreamReader(responseStream);
        string responseText = reader.ReadToEnd();

        // Cryptographic Functions
        // Simple MD5 hash
        using (MD5 md5 = MD5.Create())
        {
            byte[] inputBytes = Encoding.ASCII.GetBytes("Hello World");
            byte[] hashBytes = md5.ComputeHash(inputBytes);
            string hash = BitConverter.ToString(hashBytes).Replace("-", "").ToLowerInvariant();
        }

        // RSA Encryption and Decryption
        string original = "Hello World!";
        using (RSACryptoServiceProvider rsa = new RSACryptoServiceProvider())
        {
            byte[] encryptedData = rsa.Encrypt(Encoding.UTF8.GetBytes(original), true);
            byte[] decryptedData = rsa.Decrypt(encryptedData, true);
        }

        // Output network response and cryptographic results
        Console.WriteLine($"HTTP Response: {responseText}");

        // XML Parsing
        string xmlString = "<root><element>Value</element></root>";
        XDocument doc = XDocument.Parse(xmlString);
        string elementValue = doc.Root.Element("element").Value;

        // Json parsing
        string jsonString = "{\"name\":\"John Doe\",\"age\":30}";
        using (JsonDocument json_doc = JsonDocument.Parse(jsonString))
        {
            JsonElement root = json_doc.RootElement;
            string name = root.GetProperty("name").GetString();
            int age = root.GetProperty("age").GetInt32();
            Console.WriteLine($"Name: {name}, Age: {age}");
        }

        // Regular Expressions
        string data2 = "Example 123";
        Match match = Regex.Match(data2, @"\d+");
        string matchedNumber = match.Value;

        // File Compression
        string startPath = "./";
        string zipPath = "output.zip";
        ZipFile.CreateFromDirectory(startPath, zipPath);

        // Environment Information
        string osVersion = Environment.OSVersion.ToString();
        int processorCount = Environment.ProcessorCount;

        // BouncyCastle Example
        X9ECParameters ecParams = ECNamedCurveTable.GetByName("secp256k1");
        string message = "Hello, this is a test message!";
        string password = "StrongPassword123";
        byte[] encryptedMessage = EncryptData(message, password);
        Console.WriteLine("Original Message: " + message);
        Console.WriteLine("Encrypted Message: " + BitConverter.ToString(encryptedMessage));

        // flare7
        BigInteger q = new BigInteger(Convert.FromHexString("c90102faa48f18b5eac1f76bb40a1b9fb0d841712bbe3e5576a7a56976c2baeca47809765283aa078583e1e65172a3fd"));
        BigInteger a = new BigInteger(Convert.FromHexString("a079db08ea2470350c182487b50f7707dd46a58a1d160ff79297dcc9bfad6cfc96a81c4a97564118a40331fe0fc1327f"));
        BigInteger b = new BigInteger(Convert.FromHexString("9f939c02a7bd7fc263a4cce416f4c575f28d0c1315c4f0c282fca6709a5f9f7f9c251c9eede9eb1baa31602167fa5380"));
        FpCurve curve = new FpCurve(q, a, b);
        BigInteger gx = new BigInteger(Convert.FromHexString("087b5fe3ae6dcfb0e074b40f6208c8f6de4f4f0679d6933796d3b9bd659704fb85452f041fff14cf0e9aa7e45544f9d8"));
        BigInteger gy = new BigInteger(Convert.FromHexString("127425c1d330ed537663e87459eaa1b1b53edfe305f6a79b184b3180033aab190eb9aa003e02e9dbf6d593c5e3b08182"));
        SecureRandom sc = new SecureRandom();
        System.Random rr = new System.Random(0);
        
        curve.CreatePoint(gx, gy);
        ECParameters eca = new ECParameters();

        // Output to verify operations
        Console.WriteLine($"Lowercase: {lowerString}");
        Console.WriteLine($"Uppercase: {upperString}");
        Console.WriteLine($"Trimmed: {trimmedString}");
        Console.WriteLine($"Contains 'Hello': {containsHello}");
        Console.WriteLine($"Replaced String: {replacedString}");
        Console.WriteLine($"Read from file: {readFile}");
        Console.WriteLine($"Encoded string: {encodedString}");
        Console.WriteLine($"Decoded string: {decodedString}");
        Console.WriteLine($"Max number: {maxNumber}");
        Console.WriteLine($"Min number: {minNumber}");
        Console.WriteLine($"Sorted numbers: {string.Join(", ", sortedNumbers)}");
        Console.WriteLine($"Square root of 25: {squareRoot}");
        Console.WriteLine($"2 raised to the power of 3: {power}");
        Console.WriteLine($"Absolute value of -10.5: {absoluteValue}");

        // Clean up
        File.Delete(filePath);
    }
}