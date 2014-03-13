<?php
	session_start();
	if(isset($_SESSION['user']))
	{
		session_destroy();
		header("location:../admin.php?logout=1");
	}
	else
	{
		header("location:../admin.php?login=1");
	}
	
	?>