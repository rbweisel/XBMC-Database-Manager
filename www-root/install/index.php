<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title>XBMC Database Manager - Installer</title>
</head>
<body>
    <form method='post' action='./install.php'>
		<h2>Database details:</h2>
		<table>
			<tbody>
				<tr><td>Hostname</th><td><input name="dbhost" type="text"></td><td>*</td></tr>
				<tr><td>Username</th><td><input name="dbuser" type="text"></td><td>*</td></tr>
				<tr><td>Password</th><td><input name="dbpass" type="password"></td><td>*</td></tr>
				<tr><td>Database</th><td><input name="dbname" type="text"></td><td>*</td></tr>
				<tr><td>Database driver</th><td>
					<select name="dbdriver">
						<?php
						foreach(PDO::getAvailableDrivers() as $driver)
						{
							echo "<option value='$driver'>$driver</option>";
						}
						?>		
					</select>
				</td><td>*</td></tr>
				<tr><td>Database prefix</td><td><input name="prefix" type="text"></td></tr>
			</tbody>
		</table>
		<h2>User details:</h2>
		<table>
			<tbody>
				<tr><td>Username</th><td><input name="user" type="text"></td><td>*</td></tr>
				<tr><td>Password</th><td><input name="pass1" type="password"></td><td>*</td></tr>
				<tr><td>Password again</th><td><input name="pass2" type="password"></td><td>*</td></tr>
			</tbody>
		</table>
		<table>
			<tbody>
				<input type='submit' value='Install!' />
				<input type='reset' value='Start Again!' />
			</tbody>
		</table>
	</form>
</body>
</html>
