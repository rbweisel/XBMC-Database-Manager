<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title>XBMC Database Manager - Installer</title>
    <link rel="stylesheet" href='install.css' type="text/css" media="screen, projection" />
</head>
<body>
	<div id="settings">
    <form method='post' action='./install.php'>
		<h1>XBMC Database Manager</h1><br/><h1>Setup</h1><br/>
		<h2>Database details:</h2>
		<table>
			<tbody>
				<tr><th>Hostname</th><td class="required"><input name="dbhost" type="text"></td></tr>
				<tr><th>Username</th><td class="required"><input name="dbuser" type="text"></td></tr>
				<tr><th>Password</th><td><input name="dbpass" type="password"></td></tr>
				<tr><th>Database</th><td class="required"><input name="dbname" type="text"></td></tr>
				<tr><th>Database driver</th><td class="required">
					<select name="dbdriver">
						<option value='mysql'>mysql</option>
						<option value='mssql'>mssql</option>
						<option value='postgre'>postgre</option>
						<option value='sqlite'>sqlsrv</option>
						<option value='odbc'>odbc</option>
						<option value='cubrid'>cubrid</option>
					</select>
				</td></tr>
				<tr><th>Database prefix</td><td><input name="prefix" type="text"></td></tr>
			</tbody>
		</table>
		<h2>User details:</h2>
		<table>
			<tbody>
				<tr><th>Username</th><td class="required"><input name="user" type="text"></td></tr>
				<tr><th>Password</th><td class="required"><input name="pass1" type="password"></td></tr>
				<tr><th>Password again</th><td class="required"><input name="pass2" type="password"></td></tr>
			</tbody>
		</table>
		<br/>
		<input type='submit' value='Submit' />
		<input type='reset' value='Reset' />
	</form>
	</div>
</body>
</html>
