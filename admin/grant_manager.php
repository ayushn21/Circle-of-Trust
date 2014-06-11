<?php
session_start();
if(isset($_SESSION['user']) && isset($_SESSION['manager']))
{
	if($_SESSION['manager'] == 't')
	{
		require_once(__DIR__."/../db/db_interface.php");

		$connection_string = get_connection_string();
		$db_connection = pg_connect($connection_string);

		if($db_connection)
		{
			$username_to_grant = $_POST['username'];
			$grant = grant_manager($db_connection, $username_to_grant);

			if($grant)
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
			echo "db_connection_error";
		}
	}
	else
	{
		echo "not_logged_in";
	}
}
else
{
	echo "not_logged_in";
}
?>