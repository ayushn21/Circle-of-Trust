<?php
	function get_connection_string()
	{
		$db_info_file = '{"host":"ec2-54-197-241-78.compute-1.amazonaws.com","dbname":"dbfik2r7lmmqbm","user":"fzqxuxyonfqoag","port":"5432","password":"53wRLwOVDPyqYDR1Q9zTgZ_tif"}';
		$db_info = json_decode($db_info_file,true);

		$connection_string = "";

		foreach ($db_info as $key => $value) 
		{
			$connection_string .= $key."=".$value." ";
		}
		return trim($connection_string);
	}

	function get_names($db_connection)
	{
		$result = pg_query($db_connection, "SELECT name,position FROM names");
		if($result)
		{
			$output = array_fill_keys(array(), '');
			while($row = pg_fetch_row($result))
			{
				$output[$row[0]] = $row[1];
			}
			return json_encode($output);
		}
		else
		{
			return "table_error";
		}
	}

	function get_date($db_connection)
	{
		$result = pg_query($db_connection, "SELECT next_date,hour,min FROM date WHERE id=1");
		if($result)
		{
			$output = array_fill_keys(array(), '');
			while($row = pg_fetch_row($result))
			{
				$output['next_date'] = $row[0];
				$output['hour'] = $row[1];
				$output['min'] = $row[2];
			}
			return json_encode($output);
		}
		else
		{
			return "table_error";
		}
	}

	function get_admin_info($db_connection)
	{
		$result = pg_query($db_connection, "SELECT username,manager FROM admins");
		if($result)
		{
			$output = array_fill_keys(array(), '');
			while($row = pg_fetch_row($result))
			{
				$output[$row[0]] = $row[1];
			}
			return json_encode($output);
		}
		else
		{
			return "table_error";
		}
	}

	function save_names($db_connection, $names)
	{
		$result = pg_query($db_connection,"DELETE FROM names; ALTER SEQUENCE names_id_seq RESTART WITH 1;");
		if($result)
		{
			$result = pg_prepare($db_connection, "save_names_query" ,"INSERT INTO names (name,position) VALUES ($1,$2)");
			$response = array();
			foreach ($names as $name => $position) 
			{
				array_push($response, pg_execute($db_connection, "save_names_query",array($name,(int)$position)));
			}
			foreach ($response as $response) 
			{
				if($response)
				{
					continue;
				}
				else
				{
					return false;
				}
			}
			return true;
		}
		else
		{
			return false;
		}
	}

	function save_date($db_connection, $date)
	{
		$result = pg_prepare($db_connection, "save_date_query" ,"UPDATE date SET next_date=$1,hour=$2,min=$3 WHERE id=1");
		$response = pg_execute($db_connection, "save_date_query",array($date["next_date"],(int)$date["hour"],(int)$date["min"]));
		return $response;
	}

	function create_account($db_connection, $account)
	{
		$check_username = pg_prepare($db_connection, "check_username_query" ,"SELECT * FROM admins where username=$1");
		$check_username = pg_execute($db_connection, "check_username_query" ,array($account["username"]));

		if(pg_num_rows($check_username) > 0)
		{
			return "clash";
		}
		else
		{
			$response = pg_prepare($db_connection, "create_account_query" ,"INSERT INTO admins (username,password,manager) VALUES ($1,$2,$3)");
			$response = pg_execute($db_connection, "create_account_query",array($account["username"],$account["password"],$account["manager"]));
			return $response;
		}
	}

	function change_password($db_connection, $passwords, $user)
	{
		$check_password = pg_prepare($db_connection, "check_password_query" ,"SELECT password FROM admins WHERE username=$1");
		$check_password = pg_execute($db_connection, "check_password_query" ,array($user));

		if(pg_fetch_row($check_password)[0] != $passwords["old_password"])
		{
			return "clash";
		}
		else
		{
			$response = pg_prepare($db_connection, "change_password_query" ,"UPDATE admins SET password=$1 WHERE username=$2");
			$response = pg_execute($db_connection, "change_password_query",array($passwords["new_password"],$user));
			return $response;
		}
	}

	function revoke_manager($db_connection, $username)
	{
		$revoke = pg_prepare($db_connection, "revoke_query", 'UPDATE admins SET manager=false WHERE username=$1');
		$revoke = pg_execute($db_connection, "revoke_query", array($username));
		return $revoke;
	}

	function get_manager_count($db_connection)
	{
		$managers_check = pg_query($db_connection, 'SELECT username FROM admins WHERE manager=true');
		return pg_num_rows($managers_check);
	}


	function grant_manager($db_connection, $username)
	{
		$grant = pg_prepare($db_connection, "grant_query", 'UPDATE admins SET manager=true WHERE username=$1');
		$grant = pg_execute($db_connection, "grant_query", array($username));
		return $grant;
	}

	function get_admin_count($db_connection)
	{
		$admins_check = pg_query($db_connection, 'SELECT * FROM admins');
		return pg_num_rows($admins_check);
	}

	function delete_admin($db_connection,$username)
	{
		$delete = pg_prepare($db_connection, "delete_query", 'DELETE FROM admins WHERE username=$1');
		$delete = pg_execute($db_connection, "delete_query", array($username));
		return $delete;
	}
?>