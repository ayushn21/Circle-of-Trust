<?php
session_start();
if(isset($_SESSION['user']))
{	
	$username = $_POST["username"];
	$password = hash("md5",$_POST["pwd"]);	
	$flag = TRUE;
	
	$usersXML = simplexml_load_file("users.xml");
	
	$usernameList = $usersXML->usernames->children();
	
	foreach ($usernameList as $u)
	{
		if($u == $username)
		{		
			$flag = FALSE;
		}
	}
	
	if($flag)
	{
		$usersXML->usernames->addChild('name',$username);
		$usersXML->passwords->addChild('password',$password);
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