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
         <a class="navbar-brand" href="#">Auth.black</a>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
               <li class="nav-item active">
                  <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
               </li>
               <li class="nav-item active">
                  <a class="nav-link" href="log.php">Logs</a>
               </li>               
            </ul>
            <form class="form-inline my-2 my-lg-0" action="log.php" method="post">
               <input class="form-control mr-sm-2" id="SearchText" type="search" placeholder="Search" aria-label="Search" name="query">
               <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
            </form>
         </div>
      </nav>
      <div class="container-fluid bg-dark text-white" id="all">
         <h1>Geniush</h1>
         <div class="table-responsive">
            <table class="table table-hover table-dark">
				<?php		   
					require_once 'config/db.php';
					require_once 'php/PrintDB.php';
				  
					if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['query']))
					{
						$query = trim($_POST['query']);
						print_db($link, 'SELECT id, ip as "IP", time as "Time", success as "Success", lickey as "License Key", hwid as "HWID", type as "Product" FROM logs WHERE id like "' . $query . '" or ip like "'.$query.'" or time like "'.$query.'" or success like "'.$query.'" or lickey like "'.$query.'" or hwid like "'.$query .'" or type like "'.$query.'" ORDER BY id');
						mysqli_close($link);
					}
					else
					{
						print_db($link, 'SELECT id, ip as "IP", time as "Time", success as "Success", lickey as "License Key", hwid as "HWID", type as "Product" FROM logs ORDER BY id');
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
                  <span class="nav-link" id="LogDelete">Delete Log</span>
               </li>		   
            </ul>      
			<form class="form-inline my-2 my-lg-0">
               <input type="checkbox" class="css-checkbox form-control mr-sm-2" id="checkAll">
			   <label for="checkAll" class="css-label my-2 my-sm-0">Check All</label>              
            </form>			
         </div>
      </nav>
      </div>	  
      <script src="js/jquery-3.3.1.min.js "></script>
      <script src="js/popper.min.js "></script>
      <script src="js/bootstrap.min.js " ></script>
      <script src="js/jquery-confirm.min.js "></script>
      <script src="js/buttons.js"></script>
   </body>
</html>