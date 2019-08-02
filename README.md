# EasyLicense-Legacy
 
This repository contains fully working C# - Web license system. C# part require [Leaf.xNet library](https://github.com/csharp-leaf/Leaf.xNet) for networking. I'm working on new version this is generally not supported, only critical fixes.

## Features:
- every license key is binded to hwid on first use and is valid only one this pc
- logs ip and hwid of every license check request, you can see who is tring to bruteforce
- build in key generator (for now only 64 lenght, alphanumeric)
- view last ip in admin panel
- reset, set hwid, deactivate key etc.
- ban key - autodelete program from banned user computer and shutdown his pc

<img src="https://imgur.com/2eRQz3z.png">

<img src="https://imgur.com/GGtF4Tk.png">

## How to install
1. Create MYSQL database and import file panel.sql
2. Edit files admin/config/db.php and login/db.php with database credentials
3. Make sure db admin panel is working, generate some keys
4. Add C# files to your project and input url and productname (program exemple in C#/EasyLicenseExample)
Thats all, if you did everything properly it should work.

## Demo
Demo avaible [here](http://demo-easylicense.herokuapp.com/admin/index.php).
Example c# code for demo
```csharp
string key = "PUIuxZktNjvrZD7KQutLwa8RRZVJk1aXtadzI1Bn4K0dAGtyJoY8r4UEqqSBY36y";
string url = "http://demo-easylicense.herokuapp.com/login/index.php";
string productName = "Demo";

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
```
