<?php
session_start();
if (isset($_SESSION['user']))
{
	if(isset($_POST["user_data"]))
	{
		require_once(__DIR__."/../../db/db_interface.php");
		$users = json_decode($_POST["user_data"],true);

		$db_connection = pg_connect(get_connection_string(__DIR__."/../../db/dbinfo.json"));
		$response = save_names($db_connection,$users);
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