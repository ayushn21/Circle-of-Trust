<?php
session_start();
if (isset($_SESSION['user']))
{
	if(isset($_POST["next_date"]))
	{
		require_once(__DIR__."/../../db/db_interface.php");
		$date = json_decode($_POST["next_date"],true);

		$db_connection = pg_connect(get_connection_string(__DIR__."/../../db/dbinfo.json"));
		$response = save_date($db_connection,$date);
		if($response)
		{
			echo "success";
		}
		else
		{
			echo "failure";
		}
	}
	else
	{
		echo "input_error";
	}
}
else
{
	echo "not_logged_in";
}

?>