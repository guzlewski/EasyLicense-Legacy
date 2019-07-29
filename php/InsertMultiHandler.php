<?php

function generateRandomString($length = 64)
{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++)
	{
		$randomString.= $characters[rand(0, $charactersLength - 1) ];
	}

	return $randomString;
}

if ($_SERVER['REQUEST_METHOD'] != 'POST')
{
	echo 'Wrong Request!';
	return;
}

require_once '../config/db.php';

require_once 'InsertToDB.php';

if (isset($_POST['keys']))
{
	echo Insert($_POST["type"], explode(PHP_EOL, $_POST["keys"]) , $link);
	return;
}

$count = $_POST["count"];
$type = $_POST["type"];
$string = '';

for ($i = 1; $i <= $count; $i++) $string.= generateRandomString() . PHP_EOL;
echo Insert($type, explode(PHP_EOL, $string) , $link);
return;
?>