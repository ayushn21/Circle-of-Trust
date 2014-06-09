<?php

if(isset($_POST['username']) && isset($_POST['pwd']))
{
	$username_input = $_POST["username"];
	$password_input = hash("md5",$_POST["pwd"]);

	require_once("../../db/db_interface.php");
	$connection_string = get_connection_string();

	$db_connection = pg_connect($connection_string);

	$result = pg_prepare($db_connection, "login_query", "SELECT username,password FROM admins WHERE username=$1 and password=$2");
	$result = pg_execute($db_connection, "login_query", array($username_input,$password_input));

	$no_of_results = pg_num_rows($result);

	if($no_of_results == 1)
	{
		session_start();
		$_SESSION['user'] = $username_input;
		echo "success";
	}
	else
	{
		echo "failure";
	}
}
else
{
	echo "error";
}

?>