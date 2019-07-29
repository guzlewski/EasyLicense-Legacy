<?php

function Insert($type, $pieces, $link)
{
	$rozmiar = count($pieces);
	$querry = '';
	$ok = 0;
	$bad = 0;
	for ($i = 0; $i < $rozmiar; $i++)
	{
		$key = $pieces[$i];
		$key = preg_replace('/\s+/', '', $key);
		$input = true;
		if (strlen($key) > 0)
		{
			$sql = "SELECT * FROM license WHERE lickey = '" . $key . "' AND type = '" . $type . "'";
			$result = mysqli_query($link, $sql);
			$row = mysqli_fetch_assoc($result);
			if (strlen($row['lickey']) > 0)
			{
				$bad++;
				$input = false;
			}

			if ($input == true)
			{
				$querry.= sprintf("INSERT INTO license (lickey, type) VALUES ('%s', '%s');", mysqli_real_escape_string($link, $key) , mysqli_real_escape_string($link, $type));
				$ok++;
			}
		}
	}

	if (mysqli_multi_query($link, $querry) == true) return " Good: $ok Bad: $bad";
	else return mysqli_error( $link ).'error';
}

?>