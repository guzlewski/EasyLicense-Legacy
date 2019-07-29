namespace EasyLicenseExample
{
    class Program
    {
        static void Main(string[] args)
        {
            string key = "1111111111111111111111111111111111111111111111111111111111111111";
            string url = "http://geniush-easylicense.herokuapp.com/www/login/index.php";
            string productName = "Test";

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

            System.Console.ReadLine();
        }
    }
}
