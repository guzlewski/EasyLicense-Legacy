using System.Linq;
using System.Security;

namespace EasyLicense
{
    [SecuritySafeCritical]
    class Key
    {
        internal static bool Validation(string key)
        {
            string AllowedChars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^";
            if (key.Length != 64) return false;
            if (!key.All(c => AllowedChars.Contains(c))) return false;
            return true;
        }
    }
}
