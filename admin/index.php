<?php
	session_start();
	if(isset($_SESSION['user']))
	{
		require("controls.php");
	}
	else
	{
		require("login.php");
	}

?>