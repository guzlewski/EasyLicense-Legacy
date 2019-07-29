using System;
using System.Linq;
using System.Management;
using System.Security;
using System.Text;
using Leaf.xNet;

namespace EasyLicense.License
{
    [SecuritySafeCritical]
    class Api
    {
        internal string ResponseStatus
        {
            get;
            private set;
        }
        protected string PostData(Authorize var)
        {
            return "hwid=" + HWID() + "&license=" + var.LicenseKey + "&type=" + var.ProductName;
        }
        protected string HWID()
        {
            byte[] query = { 83, 69, 76, 69, 67, 84, 32, 83, 101, 114, 105, 97, 108, 78, 117, 109, 98, 101, 114, 32, 70, 82, 79, 77, 32, 87, 105, 110, 51, 50, 95, 79, 112, 101, 114, 97, 116, 105, 110, 103, 83, 121, 115, 116, 101, 109 };
            var s = new ManagementObjectSearcher(Encoding.ASCII.GetString(query));
            var obj = s.Get().Cast<ManagementObject>().First();
            var serial = obj["SerialNumber"].ToString();
            return serial;
        }
        internal bool Check(Authorize Provider)
        {
            try
            {
                using (var Request = new HttpRequest())
                {
                    Request.ConnectTimeout = 7500;
                    Request.ReadWriteTimeout = 7500;

                    var Response = Request.Post(Provider.ServerAuthUrl, PostData(Provider), "application/x-www-form-urlencoded");
                    if (Response.Address.ToString() != Provider.ServerAuthUrl)
                    {
                        this.ResponseStatus = "Incorrect Request!";
                        return false;
                    }
                    if (Response.ToString() == "-1")
                    {
                        this.ResponseStatus = "Incorrect License!";
                        return false;
                    }
                    if (Response.ToString() == "0")
                    {
                        this.ResponseStatus = "Your License is inactive!";
                        return false;
                    }
                    if (Response.ToString() == "1")
                    {
                        this.ResponseStatus = "License is binded to another PC!";
                        return false;
                    }
                    if (Response.ToString() == "2")
                    {
                        this.ResponseStatus = "License binding Error!";
                        return false;
                    }
                    if (Response.ToString() == "3")
                    {
                        this.ResponseStatus = "Unknown Server Error!";
                        return false;
                    }
                    if (Response.ToString() == "69")
                    {
                        this.ResponseStatus = "";
                        Dead.GoKill();
                        return false;
                    }
                    if (Int64.TryParse(Response.ToString(), out long time) == false)
                    {
                        Console.WriteLine(Response);
                        Console.WriteLine();
                        this.ResponseStatus = "Unexpected Server Response!";
                        return false;
                    }
                    this.ResponseStatus = "License OK";
                    return true;
                }
            }
            catch
            {
                this.ResponseStatus = "License Checking Error!";
                return false;
            }
        }
    }
}
