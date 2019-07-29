<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/jquery-confirm.min.css">
      <link rel="stylesheet" href="css/style.css">
      <title>Geniush's License Manager</title>
   </head>
   <body>
      <nav class="navbar fixed-top navbar-expand navbar-dark bg-dark">
         <a class="navbar-brand" href="#">EasyLicenseLegacy</a>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
               <li class="nav-item active">
                  <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
               </li>
               <li class="nav-item active">
                  <a class="nav-link" href="log.php">Logs</a>
               </li>
               <li class="nav-item active">
                  <span class="nav-link" id="LicenseGenerate">License Generator</span>  
               </li>
               <li class="nav-item active">
                  <span class="nav-link" id="LicenseCreate">License Creator</span>  
               </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="index.php" method="post">
               <input class="form-control mr-sm-2" id="SearchText" type="search" placeholder="Search" aria-label="Search" name="query">
               <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
            </form>
         </div>
      </nav>
      <div class="container-fluid bg-dark text-white" id="all">
         <h1>License Manager</h1>
         <div class="table-responsive">
            <table class="table table-hover table-dark">
				<?php
					require_once 'config/db.php';
					require_once 'php/PrintDB.php';

					if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['query']))
					{
						$query = trim($_POST['query']);
						print_db($link, 'SELECT id, lickey as "License Key", hwid as "HWID", owner as "Owner", active as "Active", banned as "Banned", created as "Created", logins as "Logins", type as "Product", lastip as "Last IP" FROM license WHERE id like "' . $query . '" or lickey like "' . $query . '" or hwid like "' . $query . '" or active like "' . $query . '" or banned like "' . $query . '" or owner like "' . $query . '" or created like "' . $query . '" or logins like "' . $query . '" or type like "' . $query . '" or lastip like "' . $query . '" ORDER BY id');
						mysqli_close($link);
					}
					else
					{
						print_db($link, 'SELECT id , lickey as "License Key", hwid as "HWID", owner as "Owner", active as "Active", banned as "Banned", created as "Created", logins as "Logins", type as "Product", lastip as "Last IP" FROM license ORDER BY id');
						mysqli_close($link);
					}			  
                ?>
            </table>
         </div>         	 
	<nav class="navbar fixed-bottom navbar-expand navbar-dark bg-dark">
         <a class="navbar-brand" href="#">Buttons</a>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
               <li class="nav-item active">
                  <span class="nav-link jsbutton" id="keydisable">Deactivate Key</span>
               </li>
               <li class="nav-item active">
                  <span class="nav-link jsbutton" id="keyenable">Activate Key</span>
               </li>
               <li class="nav-item active">
                  <span class="nav-link jsbutton" id="keyban">Ban Key</span>
               </li>
			   <li class="nav-item active">
                  <span class="nav-link jsbutton" id="keyunban">Unban Key</span>
               </li>
			   <li class="nav-item active">
                  <span class="nav-link jsbutton" id="keydelete">Delete Key</span>
               </li>
			   <li class="nav-item active">
                  <span class="nav-link jsbutton" id="keyset">Set Key</span>
               </li>
			   <li class="nav-item active">
                  <span class="nav-link jsbutton" id="hwidreset">Reset HWID</span>
               </li>
			   <li class="nav-item active">
                  <span class="nav-link jsbutton" id="hwidset">Set HWID</span>
               </li>
			   <li class="nav-item active">
                  <span class="nav-link jsbutton" id="ownerreset">Reset Owner</span>
               </li>
			   <li class="nav-item active">
                  <span class="nav-link jsbutton" id="ownerset">Set Owner</span>
               </li>
			   <li class="nav-item active">
                  <span class="nav-link jsbutton" id="loginsreset">Reset Logins</span>
               </li>
			   <li class="nav-item active">
                  <span class="nav-link jsbutton" id="typereset">Reset Product</span>
               </li>
			   <li class="nav-item active">
                  <span class="nav-link jsbutton" id="typeset">Set Product</span>
               </li>
			   <li class="nav-item active">
                  <span class="nav-link jsbutton" id="ipreset">Reset IP</span>
               </li>		   
            </ul>      
	    <form class="form-inline my-2 my-lg-0">
               	<input type="checkbox" class="css-checkbox form-control mr-sm-2" id="checkAll">
		<label for="checkAll" class="css-label">Check All</label>              
            </form>			
         </div>
      </nav>	  
      </div>	  
      <script src="js/jquery-3.3.1.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js" ></script>
      <script src="js/jquery-confirm.min.js"></script>
      <script src="js/buttons.js"></script>
   </body>
</html>