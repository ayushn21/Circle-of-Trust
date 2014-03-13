<?php
session_start();
if(isset($_SESSION['user']))
{	
	$username = $_SESSION['user'];
	$oldPassword = hash("md5",$_POST["oldPassword"]);
	$newPassword = hash("md5",$_POST["newPassword"]);	
	$counter = 0;
	
	$usersXML = simplexml_load_file("users.xml");
	
	$usernameList = $usersXML->usernames->children();
	
	foreach ($usernameList as $u)
	{
		if($u == $username)
		{		
			break;
		}
		$counter = $counter + 1;
	}
	
	if($usersXML->passwords->password[$counter] == $oldPassword)
	{
		$usersXML->passwords->password[$counter] = $newPassword;
		$usersXML->asXML("users.xml");
		echo "success";
	}
	else 
	{
		echo "clash";	
	} 
}
else
{
	echo "notLoggedIn";
}	

?>