<?php

require_once(__DIR__."/db/db_interface.php");

$connection_string = get_connection_string(__DIR__."/db/dbinfo.json");
$db_connection = pg_connect($connection_string);

if($db_connection)
{
	$names = get_names($db_connection);
	
	if($names == "table_error")
	{
		$db_setup_script = file_get_contents("schema.sql");
		$result = pg_query($db_connection, $db_setup_script);
		$names = get_names($db_connection);
		echo $names;
	}
	else
	{
		echo $names;
	}
	
}
else
{
	echo "db_connection_error";
}

?>