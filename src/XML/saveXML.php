<?php
session_start();
if(isset($_SESSION['user']))
{
	$users = $_POST["users"];
	$circle = $_POST["circle"];
	
	$xmlDoc = new SimpleXMLElement("<members></members>");
	
	$xmlDoc->addChild('names');
	$xmlDoc->addChild('circles');
	
	foreach ($users as $u)
	{
		$xmlDoc->names->addChild('name',$u);
	}
	
	foreach ($circle as $c)
	{
		$xmlDoc->circles->addChild('circle',$c);
	}
	
	$xmlDoc->asXML("names.xml");
	echo "success";
}
else
{
	echo "notLoggedIn";
}
?>