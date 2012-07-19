<script type="text/javascript" src="<?php echo base_url();?>shadowbox/shadowbox.js"></script>
<script type="text/javascript">
	Shadowbox.init();
</script>
<?php
if(isset($thumb))
{
	$thumb_found = false;
	$thumburl = base_url().'thumbs/'.substr($thumb,0,1).'/'.$thumb.'.tbn';
	if ( @file_get_contents($thumburl,0,NULL,0,1) )
	{
		$thumb_found = true;
	}
	else
	{
		$thumburl = base_url().'thumbs/Video/'.substr($thumb,0,1).'/'.$thumb.'.tbn';
		if ( @file_get_contents($thumburl,0,NULL,0,1) )
		{
			$thumb_found = true;
		}
	}
	
	if ( $thumb_found )
	{
		$imginfo = getimagesize($thumburl);
		if(($imginfo[0]/$imginfo[1])>2)			//Image is twice as wide as it is high
		{
			echo '<div id="banner">'."\n\t".'<a rel="shadowbox" title="Banner" href="'.$thumburl.'">'."\n\t\t".'<img src="'.$thumburl.'" />'."\n\t".'</a>'."\n".'</div>'."\n".'<div id="showinfo">';
		}
		else
		{
			echo '<div id="poster"><a rel="shadowbox" title="Poster" href="'.$thumburl.'"><img src="'.$thumburl.'" /></a></div><div id="movieinfo">';
		}
	}
	else
	{
		$controller = $this->router->class;
		if($controller == 'shows')
		{
			echo '<div id="banner"><img src="/img/na.jpg" /></div><div id="showinfo">';
		}
		if($controller == 'movies')
		{
			echo '<div id="poster"><img src="/img/na.jpg" /></div><div id="movieinfo">';
		}
	}
}
?>

	<div id="title">
		<h1><?php echo $col2['0'] ?></h1>
	</div>
	<div id="infotable">
		<table border="0">
			<tbody>
			<!--Loops throuch arrays containing info, printing to a table-->
			<?php
				for ($i = 1; $i < count($col1); $i++)
				{
					echo "\n\t\t\t\t<tr><th>$col1[$i]</th><td>$col2[$i]</td></tr></p>";
				}
			?>
			</tbody>
		</table>
	</div>
</div>
