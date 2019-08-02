namespace EasyLicenseExample
{
    class Program
    {
        static void Main(string[] args)
        {
            // License key generated in admin panel. Can be loaded from file,
            string key = "1111111111111111111111111111111111111111111111111111111111111111";

            // Url to login api eg. http://demo-easylicense.herokuapp.com/login
            string url = "";

            // Name of product set in admin panel
            string productName = "";

            var license = new EasyLicense.License.Authorize();
            license.ServerAuthUrl = url;
            license.ProductName = productName;
            bool success = license.Auth(key);

            if (!success)
            {
                System.Console.WriteLine("Auth fail!");
                System.Console.WriteLine("Reason: " + license.ResponseStatus);
            }
            else System.Console.WriteLine("Success!");

            System.Console.ReadLine();
            return;
        }
    }
}
