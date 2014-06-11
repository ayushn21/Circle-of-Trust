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
			$username_to_delete = $_POST['username'];
			$number_of_admins = get_admin_count($db_connection);
			
			if($number_of_admins > 1 && $_SESSION['user'] != $username_to_delete)
			{
				$delete = delete_admin($db_connection, $username_to_delete);
				if($delete)
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
				if(!$number_of_admins > 1)
				{
					echo "one_left";
				}
				else if($_SESSION['user'] == $username_to_delete)
				{
					echo "cannot_delete_self";
				}
				else
				{
					echo "check_failure";
				}
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