<?php
	$arturl = base_url().'thumbs/Fanart/'.$hash.'.tbn';
	echo '<div id="backdrop">';
	if ( @file_get_contents($arturl,0,NULL,0,1) )
	{
		echo '<a title="Backdrop" href="'.$arturl.'" onclick="TINY.box.show({image: \''.$arturl.'\', boxid: \'fanart\', animate: false})">';
		echo '<img id="fanart" src="'.$arturl.'" /></a>';
	}
//	echo "html: \"<div><img id=\'fanart\' src=\'".$arturl."\' /></div>\', boxid: \"frameless\", animate: true })";
	else
	{
		echo '<img class="fanart" src="/img/na.jpg" />';
	}
	echo '</div>';
?>

