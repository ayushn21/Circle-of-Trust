<?php
session_start();
if(isset($_SESSION['user']))
{
	$date = $_POST["date"];
	$hour = $_POST["hour"];
	$min = $_POST["min"];
	
	$xmlDoc = new SimpleXMLElement("<dates></dates>");
	$xmlDoc->addChild('date',$date);
	$xmlDoc->addChild('hour',$hour);
	$xmlDoc->addChild('min',$min);
	
	$xmlDoc->asXML("date.xml");
	echo "success";
}
else
{
	echo "notLoggedIn";
}

?>