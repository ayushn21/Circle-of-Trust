<?php
session_start();
if (isset($_SESSION['user']))
{
	if(isset($_POST["password_data"]))
	{
		require_once(__DIR__."/../../../db/db_interface.php");
		$passwords = json_decode($_POST["password_data"],true);

		$passwords["old_password"] = hash("md5",$passwords["old_password"]);		
		$passwords["new_password"] = hash("md5",$passwords["new_password"]);

		$db_connection = pg_connect(get_connection_string(__DIR__."/../../../db/dbinfo.json"));
		$response = change_password($db_connection,$passwords,$_SESSION['user']);
		if($response == "clash")
		{
			echo "clash";
		}
		else if($response)
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