<?php

function mysqli_query_or_die($query, $db)
{
	$result = mysqli_query($db, $query);
	if ($result) return $result;
	else
	{
		$err = mysqli_error();
		die("<br />{$query}<br />*** {$err} ***<br />");
	}
}

function print_db($db, $query)
{
	$result = mysqli_query_or_die($query, $db);
	$first_row = true;
	while ($row = mysqli_fetch_assoc($result))
	{
		if ($first_row == true)
		{
			$first_row = false;
			echo '<thead><tr>';
			foreach($row as $key => $field)
			{
				if ($key == 'id') echo '<th class="' . $key . '" id="idhead">' . htmlspecialchars($key) . '</th>';
				else echo '<th class="' . $key . '">' . htmlspecialchars($key) . '</th>';
			}

			echo '<th class="box">Box</th>';
			echo '</tr></thead><tbody>';
		}

		echo '<tr>';
		foreach($row as $key => $field)
		{
			echo '<td class="' . $key . '">' . htmlspecialchars($field) . '</td>';
		}

		// echo '<td class="box"><input type="checkbox" class="big-checkbox" name="box" value="'.$row["ID"].'"></td>';
		// echo '<td class="box"><input type="checkbox" class="css-checkbox" id="'.$row["ID"].'" name="box" value="'.$row["ID"].'"><label for="'.$row["ID"].'" class="css-label"></label></td>';

		echo '<td class="box"><input type="checkbox" class="css-checkbox" id="' . $row["id"] . '" name="box" value="' . $row["id"] . '"><label for="' . $row["id"] . '" class="css-label"></label></td>';
		echo '</tr>';
	}

	echo '</tbody>';
}

?>