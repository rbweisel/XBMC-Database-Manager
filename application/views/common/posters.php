<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<link rel="stylesheet" href="<?php echo base_url();?>css/picker.css" type="text/css" media="screen, projection" />
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.1.7.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/picker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/scrollingcarousel.2.0.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#posters').scrollingCarousel();
	});
</script>

<div id="posterpicker">
	<div id="current">
		<?php
			$filename = $hash.'.tbn';
			$current = base_url().'thumbs/'.substr($hash,0,1).'/'.$filename;
			if ( @file_get_contents($current,0,NULL,0,1) )
			{
				echo "<img id='poster' src='".$current."' />\n\t";
			}
			else
			{
				echo "<img id='poster' src='".base_url()."img/na.jpg' />\n\t";
			}
			if (count($urls) != 0)
			{
				//echo "<button class='psave' value='".$filename."' id='".$id."'>SAVE</button>\n\t";
				echo "</div>\n\t";
				echo "<div id='picker'>\n\t\t";
				echo "<div id='posters'>\n\t\t";
				for ($i = 0; $i < count($urls); $i++)
				{
					$url=$base.$urls[$i]['file_path'];
					echo "\t<div class='thumbnail'>\n\t\t\t\t";
					echo '<img onclick="switchposter(this)" src="'.$url.'" />'."\n\t\t\t";
					echo "</div>\n\t\t";
				}
				echo "</div>\n\t\t";
				echo "<div id='baseurl' class='hidden'>".base_url()."</div>\n";
			}
			else
			{
				echo "<p style='color:white'><strong>NO REMOTE POSTERS FOUND!</strong></p>\n";
			}
		?>
	</div>
</div>
