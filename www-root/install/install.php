<?php
ob_start();
$buffer = str_repeat(" ", 4096);
$buffer .= "\r\n<span></span>\r\n";
	echo $buffer."<!doctype html>\n<html>\n\t<head>\n\t\t";
	echo "<link rel='stylesheet' href='install.css' type='text/css' media='screen, projection'/>\n";
	echo "\t</head>\n\t<body>\n";
	echo "\t\t<div id='validation'>\n";
	ob_flush();
	flush();

	function error($msg)
	{
		echo "<span class='fail'>FAIL!</span>";
		die("<div class='error'<strong>An Error Occurred:</strong><br />{$msg}</div>");
	}

	// Validate posted data
	echo $buffer."\t\t\t<br/>Validating data... ";
	ob_flush();flush();
	$error = false;
	foreach($_POST as $key => $item)
	{
		if(trim($item) == "" && $key != 'prefix' && $key != 'dbpass')
		{
			error("Fields with a * are required, please ensure they are all entered.");
			break;
		}
	}
	if($_POST['pass1'] != $_POST['pass2'])
	{
		error("The passwords does not match.");
	}
	echo $buffer."<span class='success'>OK!</span>\n";

	//Test the XBMC database connection:
	$driver=$_POST['dbdriver'];
	$dbhost = $_POST['dbhost'];
	$dbname = $_POST['dbname'];
	$dbuser = $_POST['dbuser'];
	$dbpass = $_POST['dbpass'];
	$prefix = $_POST['prefix'];
	echo "\t\t\t<br/>Trying to connect to the '$driver' database... ";
	ob_flush();flush();
	try
	{
		$xdb = new PDO($driver.":host=".$dbhost.";dbname=".$dbname, $dbuser, $dbpass);
	    $xdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
		$xdb = NULL;
		error($e->getMessage());
	}
	echo $buffer."<span class='success'>OK!</span>\n";
	
	//Test the local settings database:
	echo "\t\t\t<br/>Checking for local settings database... ";
	ob_flush();flush();
	$dbfile="../../data/xbmcdm.db";
	if(file_exists($dbfile))
	{
		echo $buffer."\n\t\t\t<br/>&nbsp&nbspLocal settings database already exist, creating backup... ";
		ob_flush();flush();
		for($i = 0; $i <= 99; $i++)
		{
			if(!file_exists($dbfile.".$i"))
			{
				if (copy($dbfile,$dbfile.".$i"))
				{
					unlink($dbfile);
					echo $buffer."<span class='success'>OK!</span>\n\t\t\t<br/>&nbsp&nbspOld database saved as: $dbfile.$i\n";
					break;
				}
				else
				{
					error("Unable to create backup of the old settings database, check file permissions");
				}
			}
			else if($i == 99)
			{
				error("100 backups already created, please remove old backups before trying again");
			}
		}
	}
	else
	{
		echo $buffer."None found\n";flush();
	}
	echo "\t\t\t<br/>Creating new settings database... ";
	ob_flush();flush();
	try
	{
		$cdb = new PDO('sqlite:../../data/xbmcdm.db');
	    $cdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$cdb->exec("CREATE TABLE users (id INTEGER PRIMARY KEY, username VARCHAR, password VARCHAR)");
		$cdb->exec("INSERT INTO users (username, password) VALUES ('".$_POST['dbpass']."', '".MD5($_POST['pass1'])."')");
		$cdb->exec("CREATE TABLE dbconnection (hostname TEXT, username TEXT, password TEXT, database TEXT, dbdriver TEXT, dbprefix TEXT)");
		$cdb->exec("INSERT INTO dbconnection (hostname, username, password, database, dbdriver, dbprefix) VALUES ('$dbhost','$dbuser','$dbpass','$dbname','$driver','$prefix')");
	}
	catch(PDOException $e)
	{
		$xdb = NULL;
		error($e->getMessage());
	}
	echo "<span class='success'>OK!</span>\n";

	echo "\t\t\t<br/>Done!\n";
	echo "\t\t</div>\n";
	echo "\t</body>\n";
	echo "</html>";
ob_end_flush();
?>
