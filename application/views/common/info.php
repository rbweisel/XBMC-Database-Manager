<script type="text/javascript" src="<?php echo base_url();?>shadowbox/shadowbox.js"></script>
<script type="text/javascript">
	Shadowbox.init();
</script><?php
//Random number to bypass browser image caching
$rand = rand(1000, 9999);

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
		else
		{
			$thumburl = base_url().'thumbs/'.substr($thumb,0,1).'/auto-'.$thumb.'.tbn';
			if ( @file_get_contents($thumburl,0,NULL,0,1) )
			{
				$thumb_found = true;
			}
			else
			{
				$thumburl = base_url().'thumbs/Video/'.substr($thumb,0,1).'/auto-'.$thumb.'.tbn';
				if ( @file_get_contents($thumburl,0,NULL,0,1) )
				{
					$thumb_found = true;
				}	
			}
		}
	}
	if ( $thumb_found )
	{
		switch($type)
		{
			case 'episode':
				echo "\t\t\t\t\t".'<div id="poster"><a rel="shadowbox" title="Poster" href="'.$thumburl.'"><img src="'.$thumburl.'" /></a></div>'."\n\t\t\t\t\t".'<div id="movieinfo">'."\n";
				break;
			case 'movie':
				if($edit==true)
				{
					echo "\t\t\t\t\t<div id='poster'><a title='Poster' href=''><img onclick=\"Shadowbox.open({content: '".base_url()."/movies/getposters?imdb_id=".$imdb_id."&id=".$id."', player: 'iframe', title: 'Posters'})\" src='".$thumburl."?".$rand."' /></a></div><div id=\"movieinfo\">\n";
				}
				else
				{
					echo "\t\t\t\t\t".'<div id="poster"><a rel="shadowbox" title="Poster" href="'.$thumburl.'"><img id="'.$imdb_id.'" src="'.$thumburl.'?'.$rand.'" /></a></div>'."\n\t\t\t\t\t".'<div id="movieinfo">'."\n";
				}
				break;
			case 'show':
				echo "\t\t\t\t\t".'<div id="banner">'."\n\t".'<a rel="shadowbox" title="Banner" href="'.$thumburl.'">'."\n\t\t".'<img src="'.$thumburl.'" />'."\n\t".'</a>'."\n".'</div>'."\n\t\t\t\t\t".'<div id="showinfo">'."\n";
				break;
		}
	}
	else
	{
		switch($type)
		{
			case 'episode':
				echo "\t\t\t\t\t".'<div id="poster"><img src="/img/na.jpg" /></div>'."\n\t\t\t\t\t".'<div id="movieinfo">'."\n";
				break;
			case 'movie':
				if($edit==true)
				{
					echo "\t\t\t\t\t<div id='poster'><a title='Poster' href=''><img onclick=\"Shadowbox.open({content: '".base_url()."/movies/getposters?imdb_id=".$imdb_id."&id=".$id."', player: 'iframe', title: 'Posters'})\" src='/img/na.jpg' /></a></div><div id=\"movieinfo\">\n";
				}
				else
				{
					echo "\t\t\t\t\t".'<div id="poster"><a rel="shadowbox" title="Poster" href="'.$thumburl.'"><img id="'.$imdb_id.'" src="'.$thumburl.'?'.$rand.'" /></a></div>'."\n\t\t\t\t\t".'<div id="movieinfo">'."\n";
				}
				break;
			case 'show':
				echo "\t\t\t\t\t".'<div id="poster"><img src="/img/na.jpg" /></div>'."\n\t\t\t\t\t".'<div id="movieinfo">'."\n";
//				echo "\t\t\t\t\t".'<div id="banner"><img src="/img/na.jpg" /></div>'."\n\t\t\t\t\t".'<div id="showinfo">'."\n";
				break;
		}
	}
}?>
						<span id="<?php echo $id; ?>" class="<?php echo $type; ?>">
							<div id="title" class="<?php echo $type.' '.$id; ?>">
								<h1><?php echo $col2['0'] ?></h1>
							</div>
							<div id="infotable" class="<?php echo $type.' '.$id; ?>">
								<table border="0">
									<tbody>
										<!--Loops throuch arrays containing info, printing to a table-->
									<?php
										for ($i = 1; $i < count($col1); $i++)
										{
											echo "\t<tr><th>$col1[$i]</th><td>$col2[$i]</td></tr></p>\n\t\t\t\t\t\t\t\t\t";
										}?></tbody>
								</table>
							</div>
						</span>
					</div><?php echo "\n\t\t\t\t"; ?>
