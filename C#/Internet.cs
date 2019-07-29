using System.Runtime.InteropServices;
using System.Security;

namespace EasyLicense
{
    [SecuritySafeCritical]
    class Internet
    {
        [DllImport("wininet.dll")]
        protected static extern bool InternetGetConnectedState(out int Description, int ReservedValue);
        internal static bool Connection()
        {
            int Desc;
            return InternetGetConnectedState(out Desc, 0);
        }
    }
}
