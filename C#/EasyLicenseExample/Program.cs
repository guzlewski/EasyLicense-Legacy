namespace EasyLicenseExample
{
    class Program
    {
        static void Main(string[] args)
        {
            string key = "1111111111111111111111111111111111111111111111111111111111111111";
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
                return;
            }

        }
    }
}
