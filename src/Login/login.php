<?php
	$users = simplexml_load_file('../XML/users.xml');
	$username = $users->usernames->children();
	
	$usernameInput = $_POST["username"];
	$passwordInput = hash("md5",$_POST["pwd"]);
	$counter = 0;
	
	$userFound = false;
	$pwdFound = false;
	
	foreach($username as $u)
	{
		if($usernameInput==$u)
		{
			$userFound = true;
			if($passwordInput==$users->passwords->password[$counter])
			{
				$pwdFound = true;
				session_start();
				$_SESSION['user'] = $usernameInput;
				echo "success";
			}
		}
		$counter = $counter + 1;
	}
	
	if(!$userFound || !$pwdFound)
	{
		echo "failure";
	}
?>