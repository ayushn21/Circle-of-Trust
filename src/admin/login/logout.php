<?php
	session_start();
	if(isset($_SESSION['user']))
	{
		session_destroy();
		header("location:../?logout=1");
	}
	else
	{
		header("location:../?login=1");
	}
?>