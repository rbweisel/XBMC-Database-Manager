<link rel="stylesheet" href="<?php echo base_url();?>css/picker.css" type="text/css" media="screen, projection" />
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.1.7.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/picker.js"></script>
<table border="0">
	<div id="posterpicker">
		<div id="current">
			<?php
				$filename = $hash.'.tbn';
				$current = base_url().'thumbs/'.substr($hash,0,1).'/'.$filename;
				echo "<img id='poster' src='".$current."' />\n\t\t\t";
				echo "<button class='psave' value='".$filename."' id='".$id."'>SAVE</button>\n\t\t";
				echo "</div>\n\t\t<div id='picker'>\n\t\t\t<div id='posters'>\n";
				for ($i = 0; $i < count($urls); $i++)
				{
					$url=$base.$urls[$i]['file_path'];
					echo "\t\t\t\t".'<div class="thumbnail">'."\n\t\t\t\t\t";
					echo '<img onclick="switchposter(this)" src="'.$url.'" />'."\n\t\t\t\t";
					echo '</div>'."\n";
					//echo "URL: $base $urls[$i]['file_path'] \n";
					//$thumburl = $urls[$i]['file_path'];
					//echo '<div class="thumbnail"><div class="posterthumb">'."\n";
					//echo '<a href="'.$baseurl.$thumburl.'"><img class="posterthumb" src="'$baseurl.$thumburl.'" /></a>'."\n";
					//echo '</div></div>'."\n";
				}
				echo "\t\t\t\t<div id='baseurl' class='hidden'>".base_url()."</div>\n";
			?>
			</div>
		</div>
	</div>
</table>
