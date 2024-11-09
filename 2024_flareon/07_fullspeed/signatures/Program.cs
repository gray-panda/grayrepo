using System.Net;
using System.Text;
using System.Security.Cryptography;
using System.IO.Compression;
using System.Text.RegularExpressions;
using System.Xml.Linq;
using System.Text.Json;

class Program
{
    static readonly HttpClient client = new HttpClient();

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
