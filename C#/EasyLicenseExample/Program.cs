namespace EasyLicenseExample
{
    class Program
    {
        static void Main(string[] args)
        {
            string key = "";
            string url = "";
            string productName = "";

            var license = new EasyLicense.License.Authorize();
            license.ServerAuthUrl = url;
            license.ProductName = productName;
            bool success = license.Auth(key);

            if (!success)
            {
                System.Console.WriteLine("Auth fail!");
                System.Console.WriteLine("Reason: " + license.ResponseStatus);
                System.Console.ReadLine();
                return;
            }
            else System.Console.WriteLine("Success!");

            System.Console.ReadLine();
        }
    }
}
