<?php

	function error($msg)
	{
		die("<div style='font-family: helvetica; border: 1px solid; padding: 10px; color: #D8000C; background: #FFBABA;'><strong>An Error Occurred:</strong><br />{$msg}</div>");
	}

	// Validate posted data
	$error = false;
	foreach($_POST as $key => $item)
	{
		if(trim($item) == "" && $key != 'prefix')
		{
			error("Fields with a * are required, please ensure they are all entered.");
			break;
		}
	}
	if($_POST['pass1'] != $_POST['pass2'])
	{
		error("The passwords does not match.");
	}

	//Try to connect to the database
	$driver=$_POST['dbdriver'];
	echo "Summary:<br/><p>Database driver: $driver</p>";
	$dbhost = $_POST['dbhost'];
	$dbname = $_POST['dbname'];
	$dbuser = $_POST['dbuser'];
	$dbpass = $_POST['dbpass'];
	try
	{
		$connection = new PDO($driver.":host=".$dbhost.";dbname=".$dbname, $dbuser, $dbpass);
	    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
		$connection = NULL;
		error($e->getMessage());
	}
	/*switch($driver)
	{
		case 'mysql':
			try
			{
				$connection = new PDO("mysql:host=".$dbhost.";dbname=".$dbname, $dbuser, $dbpass);
			    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e)
			{
				$connection = NULL;
				error($e->getMessage());
			}
			break;
		case 'mysqli':
			try
			{
				$connection = new PDO("mysqli:host=".$dbhost.";dbname=".$dbname, $dbuser, $dbpass);
			    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e)
			{
				$connection = NULL;
				error($e->getMessage());
			}
			break;
		case 'postgre':
			break;
		case 'mssql':
			break;
		default:
			error("Unknown database driver: $driver.");
			break;
	}*/
	
/*	$connect = mysql_connect($_POST['sql-host'], $_POST['sql-username'], $_POST['sql-password']);
	if(!$connect)
	{
		error("The SQL host, username and password combination failed. Please try again");
	}

	$database = mysql_select_db($_POST['sql-database'], $connect);
	if(!$database)
	{
		error("Unable to connect to database {$_POST['sql-database']}, please check it exists & try again.");
	}


$sql = <<<SQL
CREATE TABLE `users` (
    `user_id` int(11) auto_increment,
    `username` varchar(30), 
    `display_name` varchar(50),
    `password` varchar (40),
    `admin` int(1),
    PRIMARY KEY (`user_id`)
);
CREATE TABLE `settings` (
    `setting_id` int(11) auto_increment,
    `setting_name` varchar(30), 
    `setting_value` varchar(100)
    PRIMARY KEY (`setting_id`)
);
SQL;

$sql = mysql_query($sql, $connect);
if(!$sql)
    error("Creating tables failed: " . mysql_error());

$sql = "INSERT INTO `users` (`username`, `display_name`, `password`, `admin`)\n" . 
    "VALUES ('{$_POST['admin-user']}', '{$_POST['admin-name']}', '" . sha1($_POST['admin-pass1']) . "', '1')";

$sql = mysql_query($sql, $connect);
if(!$sql)
    error("Unable to insert admin user details into user database: " . mysql_error());

$sql = "INSERT INTO `settings` (`setting_name`, `setting_value`)\n" . 
    "VALUES ('sitename', '{$_POST['settings-sitename']}'), \n" . 
    "('sitetagline', '{$_POST['settings-sitetagline']}'), \n" .
    "('siteemail', '{$_POST['settings-siteemail']}')";

$sql = mysql_query($sql, $connect);
if(!$sql){
    mysql_query("DELETE FROM `users` WHERE `user_id` = '1'"); 
    error("Unable to insert site settings into user database: " . mysql_error());
}

echo "Wooo! Your site is successfully installed! You can now go and play with it!";
*/
?>
