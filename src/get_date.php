<?php 

require_once (__DIR__."/db/db_interface.php");
$connection_string = get_connection_string(__DIR__."/db/dbinfo.json");
$db_connection = pg_connect($connection_string);

if($db_connection)
{
	$date = get_date($db_connection);
	echo $date;
}
else
{
	echo "db_connection_error";
}
?>