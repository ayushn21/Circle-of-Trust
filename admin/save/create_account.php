<?php
session_start();
if (isset($_SESSION['user']))
{
	if(isset($_POST["account_info"]))
	{
		require_once(__DIR__."/../../db/db_interface.php");
		$account = json_decode($_POST["account_info"],true);
		$account["password"] = hash("md5",$account["password"]);

		$db_connection = pg_connect(get_connection_string(__DIR__."/../../db/dbinfo.json"));
		$response = create_account($db_connection,$account);
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