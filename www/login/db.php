<?php

define('DB_SERVER', '51.68.27.236');
define('DB_USERNAME', 'geniusho_test');
define('DB_PASSWORD', 'test');
define('DB_NAME', 'geniusho_test');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($link === false)	
{
	die("ERROR: Could not connect. " . mysqli_connect_error());
}

mysqli_set_charset($link, "utf8");

?>