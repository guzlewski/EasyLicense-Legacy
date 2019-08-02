<?php

function ok($owner)
{
	echo round(microtime(true) * 1000);
	//.'|'.$owner
}

function login($logins, $link, $id)
{
	$sql = sprintf("UPDATE license SET logins = '%s' WHERE id = '%s'", mysqli_real_escape_string($link, $logins + 1) , mysqli_real_escape_string($link, $id));
	$result = mysqli_query($link, $sql);
}

function updateip($ip, $link, $id)
{
	$sql = sprintf("UPDATE license SET lastip = '%s' WHERE id = '%s'", mysqli_real_escape_string($link, $ip) , mysqli_real_escape_string($link, $id));
	$result = mysqli_query($link, $sql);
}

function loginfo($link, $ip, $success, $lickey, $hwid, $type)
{
	$sql = sprintf("INSERT INTO logs(ip, success, lickey, hwid, type) VALUES ('%s', '%s', '%s', '%s', '%s')", mysqli_real_escape_string($link, $ip) , mysqli_real_escape_string($link, $success) , mysqli_real_escape_string($link, $lickey) , mysqli_real_escape_string($link, $hwid) , mysqli_real_escape_string($link, $type));
	$result = mysqli_query($link, $sql);
}

function Allow($link, $id, $logins, $ip, $lickey, $hwid, $type, $owner)
{
	login($logins, $link, $id);
	updateip($ip, $link, $id);
	loginfo($link, $ip, '1', $lickey, $hwid, $type);
	ok($owner);
}

function Deny($i, $link, $ip, $lickey, $hwid, $type)
{
	loginfo($link, $ip, 0, $lickey, $hwid, $type);
	switch ($i)
	{
	case '-1':
		echo '-1';
		exit();
		break;

	case '0':
		echo '0';
		exit();
		break;

	case '1':
		echo '1';
		exit();
		break;

	case '2':
		echo '2';
		exit();
		break;

	case '3':
		echo '3';
		exit();
		break;

	case '69':
		echo '69';
		exit();
		break;

		echo '3';
		exit();
	}
}

if ($_SERVER["REQUEST_METHOD"] != "POST")
{
	header("Location: https://fbi.gov");
	return;
}

require_once 'db.php';

$ip = $_SERVER['REMOTE_ADDR'];
$hwid = $_POST["hwid"];
$license = $_POST["license"];
$type = $_POST["type"];
$sql = sprintf("SELECT active, hwid, banned, logins, owner, id FROM license WHERE lickey = '%s' AND type = '%s'", mysqli_real_escape_string($link, $license) , mysqli_real_escape_string($link, $type));
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) != 1)
{
	Deny(-1, $link, $ip, $license, $hwid, $type);
	return;
}

$row = mysqli_fetch_assoc($result);

if ($license === '')
{
	Deny(-1, $link, $ip, $license, $hwid, $type);
	return;
}

if ($row["banned"] == 1)
{
	Deny(69, $link, $ip, $license, $hwid, $type);
	return;
}

if ($row["active"] == 0)
{
	Deny(0, $link, $ip, $license, $hwid, $type);
	return;
}

if ($row["hwid"] != $hwid && $row["hwid"] != NULL)
{
	Deny(1, $link, $ip, $license, $hwid, $type);
	return;
}

if ($license === '')
{
	Deny(-1, $link, $ip, $license, $hwid, $type);
	return;
}

if ($row["hwid"] == NULL)
{
	$sql = sprintf("UPDATE license SET hwid = '%s' WHERE lickey = '%s' AND type = '%s'", mysqli_real_escape_string($link, $hwid) , mysqli_real_escape_string($link, $license) , mysqli_real_escape_string($link, $type));
	if (mysqli_query($link, $sql) == false) Deny(2, $link, $ip, $license, $hwid, $type);
	else
	{
		Allow($link, $row["id"], $row["logins"], $ip, $license, $hwid, $type, $row["owner"]);
		return;
	}
}

if ($row["active"] == 1 and $row["hwid"] == $hwid)
{
	Allow($link, $row["id"], $row["logins"], $ip, $license, $hwid, $type, $row["owner"]);
	return;
}
else
{
	Deny(3, $link, $ip, $license, $hwid, $type);
	mysqli_close($link);
	return;
}

?>