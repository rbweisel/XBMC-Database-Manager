			<div id="navigation">
				<a href="movies">Movies</a>
				<a href="shows">TV-Shows</a>
				<a href="music">Music</a>
				<a href="settings" id="current">Settings</a>
			</div>
			<script>
				$(document).ready(function()
				{
					$('#contentnav').load("settings/getcontentmenu");
				});
			</script>
			<div id="background">
				<div id="sidebar" class="roundcorners">
