<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" /><!-- Change charset if needed, also below, meta charset-->
		<meta name="description" content="XBMC Database Manager" />
		<meta name="keywords" content="XBMC Database Manager" />
		<meta name="author" content="Vicious" />
		<meta charset="UTF-8">
		<link rel="stylesheet" href='<?php echo base_url();?>css/style.css' type="text/css" media="screen, projection" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>shadowbox/shadowbox.css">
		<title><?php if (isset($title)){echo $title . " - ";} ?>XBMC Database Manager</title>
		<!--<script src="http://code.jquery.com/jquery-latest.js"></script>-->
		<!--<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.7.js"></script>-->
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.1.7.min.js"></script>

		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.autosize-min.js"></script>

		<script type="text/javascript" src="<?php echo base_url();?>js/custom.js"></script>
	</head>
	<body>
		<div id="wrapper">
			<div id="header" class="head">
				<div id="headerlogo">
					<a href="<?=base_url()?>"><img src="<?php echo base_url();?>img/header.png" /></a>
				</div>
				<div id="user">
					<?php
						if($this->session->userdata('logged_in'))
						{
							$session_user = $this->session->userdata('logged_in');
							echo "Logged in as: $session_user ";
							echo "<a href=\"" . base_url() . "/main/logout\"><button>Logout</button></a>";
						}
						else
						{ ?>
						<?php echo validation_errors();?>
						<?php echo form_open('verifylogin'); ?>
						<?php $value = uri_string();
						echo form_hidden('redirect', $value); ?>
							<table border="0">
								<tr>
									<td>
										<label for="username">User:</label>
									</td>
									<td>
										<input type="text" size="10" id="username" name="username"/>
									</td>
									<td>
										<label for="password">Pass:</label>
									</td>
									<td>
										<input type="password" size="10" id="password" name="password"/>
									</td>
									<td>
										<input type="submit" value="Login"/>
									</td>
								</tr>
							</table>
						</form><?php
						}
					?>
				</div>
			</div>
