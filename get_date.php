<?php 

require_once ("./db/db_interface.php");
$connection_string = get_connection_string("./db/dbinfo.json");
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