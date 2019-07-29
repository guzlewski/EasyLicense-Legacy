using System;
using System.Security;

namespace EasyLicense.License
{
    [SecuritySafeCritical]
    public class Authorize
    {
        public string ServerAuthUrl
        {
            internal get; set;
        }
        public string ProductName
        {
            internal get; set;
        }
        public string ResponseStatus
        {
            get; protected set;
        }
        internal string LicenseKey
        {
            get; private set;
        }

        public bool Auth(string key)
        {
            if (!Key.Validation(key))
            {
                ResponseStatus = "Incorrect License Key!";
                return false;
            }
            if (!Internet.Connection())
            {
                ResponseStatus = "Internet Connection is Required!";
                return false;
            }
            Dead.Check();
            this.LicenseKey = key;

            var api = new Api();
            var LicenseCheckingResult = api.Check(this);
            this.ResponseStatus = api.ResponseStatus;
            api = null;

            GC.Collect();
            GC.WaitForPendingFinalizers();

            return LicenseCheckingResult;
        }
    }

    
}
