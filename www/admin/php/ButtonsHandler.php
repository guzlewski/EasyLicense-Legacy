<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST')
{
	echo 'Wrong Request!';
	return;
}

require_once '../config/db.php';

$action = $_POST['action'];
$box = $_POST['box'];

for($i=0;$i<count($box);$i++)
{
	$box[$i] = preg_replace("/[^0-9]/", "", $box[$i] );
}

switch ($action)
{
case "keydisable":
	KeyDisable($link, $box);
	break;

case "keyenable":
	KeyEnable($link, $box);
	break;

case "keyban":
	KeyBan($link, $box);
	break;

case "keyunban":
	KeyUnban($link, $box);
	break;

case "keydelete":
	KeyDelete($link, $box);
	break;

case "keyset":
	KeySet($link, $box, trim($_POST['text']));
	break;

case "hwidreset":
	HwidReset($link, $box);
	break;

case "hwidset":
	HwidSet($link, $box, trim($_POST['text']));
	break;

case "ownerreset":
	OwnerReset($link, $box);
	break;

case "ownerset":
	OwnerSet($link, $box, trim($_POST['text']));
	break;

case "loginsreset":
	LoginsReset($link, $box);
	break;

case "typereset":
	TypeReset($link, $box);
	break;

case "typeset":
	TypeSet($link, $box, trim($_POST['text']));
	break;

case "ipreset":
	IpReset($link, $box);
	break;

case "logdelete":
	LogDelete($link, $box);
	break;
}

return;

function KeyDisable($link, $box)
{
	$sql = '';
	foreach($box as $key => $value)
	{
		$sql.= 'UPDATE license SET active = 0 WHERE id = ' . $value . ';';
	}

	if (mysqli_multi_query($link, $sql) == true) echo "Disabled OK";
	else echo "Error";
	return;
}

function KeyEnable($link, $box)
{
	$sql = '';
	foreach($box as $key => $value)
	{
		$sql.= 'UPDATE license SET active = 1 WHERE id = ' . $value . ';';
	}

	if (mysqli_multi_query($link, $sql) == true) echo "Enabled OK";
	else echo "Error";
	return;
}

function KeyBan($link, $box)
{
	$sql = '';
	foreach($box as $key => $value)
	{
		$sql.= 'UPDATE license SET banned = 1 WHERE id = ' . $value . ';';
	}

	if (mysqli_multi_query($link, $sql) == true) echo "Banned OK";
	else echo "Error";
	return;
}

function KeyUnban($link, $box)
{
	$sql = '';
	foreach($box as $key => $value)
	{
		$sql.= 'UPDATE license SET banned = 0 WHERE id = ' . $value . ';';
	}

	if (mysqli_multi_query($link, $sql) == true) echo "Unbanned OK";
	else echo "Error";
	return;
}

function KeyDelete($link, $box)
{
	$sql = '';
	foreach($box as $key => $value)
	{
		$sql.= 'DELETE FROM license WHERE id = ' . $value . ';';
	}

	if (mysqli_multi_query($link, $sql) == true) echo "Deleted OK";
	else echo "Error";
	return;
}

function KeySet($link, $box, $param)
{
	$sql = '';
	foreach($box as $key => $value)
	{
		$sql.= "UPDATE license SET lickey = '" . mysqli_real_escape_string($link, $param) . "' WHERE id = " . $value . ';';
	}

	if (mysqli_multi_query($link, $sql) == true) echo "Set Key OK";
	else echo "Error";
	return;
}

function HwidReset($link, $box)
{
	$sql = '';
	foreach($box as $key => $value)
	{
		$sql.= 'UPDATE license SET hwid = \'\' WHERE id = ' . $value . ';';
	}

	if (mysqli_multi_query($link, $sql) == true) echo "Reset OK";
	else echo "Error";
	return;
}

function HwidSet($link, $box, $type)
{
	$sql = '';
	foreach($box as $key => $value)
	{
		$sql.= "UPDATE license SET hwid = '" . mysqli_real_escape_string($link, $type) . "' WHERE id = " . $value . ';';
	}

	if (mysqli_multi_query($link, $sql) == true) echo "Set HWID OK";
	else echo "Error";
	return;
}

function OwnerReset($link, $box)
{
	$sql = '';
	foreach($box as $key => $value)
	{
		$sql.= 'UPDATE license SET owner = \'\' WHERE id = ' . $value . ';';
	}

	if (mysqli_multi_query($link, $sql) == true) echo "Reset Owner OK";
	else echo "Error";
	return;
}

function OwnerSet($link, $box, $owner)
{
	$sql = '';
	foreach($box as $key => $value)
	{
		$sql.= "UPDATE license SET owner = '" . mysqli_real_escape_string($link, $owner) . "' WHERE id = " . $value . ';';
	}

	if (mysqli_multi_query($link, $sql) == true) echo "Set Owner OK";
	else echo "Error";
	return;
}

function LoginsReset($link, $box)
{
	$sql = '';
	foreach($box as $key => $value)
	{
		$sql.= 'UPDATE license SET logins = \'\' WHERE id = ' . $value . ';';
	}

	if (mysqli_multi_query($link, $sql) == true) echo "Reset Logins OK";
	else echo "Error";
	return;
}

function TypeReset($link, $box)
{
	$sql = '';
	foreach($box as $key => $value)
	{
		$sql.= 'UPDATE license SET type = \'\' WHERE id = ' . $value . ';';
	}

	if (mysqli_multi_query($link, $sql) == true) echo "Reset Type OK";
	else echo "Error";
	return;
}

function TypeSet($link, $box, $type)
{
	$sql = '';
	foreach($box as $key => $value)
	{
		$sql.= "UPDATE license SET type = '" . mysqli_real_escape_string($link, $type) . "' WHERE id = " . $value . ';';
	}

	if (mysqli_multi_query($link, $sql) == true) echo "Set Type OK";
	else echo "Error";
	return;
}

function IpReset($link, $box)
{
	$sql = '';
	foreach($box as $key => $value)
	{
		$sql.= 'UPDATE license SET lastip = \'\' WHERE id = ' . $value . ';';
	}

	if (mysqli_multi_query($link, $sql) == true) echo "Reset IP OK";
	else echo "Error";
	return;
}

function LogDelete($link, $box)
{
	$sql = '';
	foreach($box as $key => $value)
	{
		$sql.= 'DELETE FROM logs WHERE id = ' . $value . ';';
	}

	if (mysqli_multi_query($link, $sql) == true) echo "Deleted OK";
	else echo "Error";
	return;
}

?>