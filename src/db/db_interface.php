<?php
	function get_connection_string($db_info_path)
	{
		$db_info_file = file_get_contents($db_info_path);
		$db_info = json_decode($db_info_file,true);

		$connection_string = "";

		foreach ($db_info as $key => $value) 
		{
			$connection_string .= $key."=".$value." ";
		}
		return trim($connection_string);
	}

	function get_names($db_connection)
	{
		$result = pg_query($db_connection, "SELECT name,position FROM names");
		if($result)
		{
			$output = array_fill_keys('', '');
			while($row = pg_fetch_row($result))
			{
				$output[$row[0]] = $row[1];
			}
			return json_encode($output);
		}
		else
		{
			return "table_error";
		}
	}

	function get_date($db_connection)
	{
		$result = pg_query($db_connection, "SELECT next_date,hour,min FROM date");
		if($result)
		{
			$output = array_fill_keys('', '');
			while($row = pg_fetch_row($result))
			{
				$output['next_date'] = $row[0];
				$output['hour'] = $row[1];
				$output['min'] = $row[2];
			}
			return json_encode($output);
		}
		else
		{
			return "table_error";
		}
	}
?>