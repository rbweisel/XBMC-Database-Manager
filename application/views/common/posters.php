<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<link rel="stylesheet" href="<?php echo base_url();?>css/picker.css" type="text/css" media="screen, projection" />
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.1.7.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/picker.js"></script>

<script type="text/javascript">
	$(document).ready(function()
	{
		$('#carousel img').each(function()
			{
				$(this).attr('src', $(this).attr('title'));
			});
		var scroll;
		var scrolling=false;
		
		if($('#carousel_inner img:last').attr('id')>4)
		{
			scrolling=true;
			$('#carousel_inner img:first').before($('#carousel_inner img:last'));
		}
		else
		{
			$('#carousel_inner').css({'left' : '0px'});
		}
		
        $('#sright img').hover(function(){
			scroll = 1;
			scroll_right();
		},function(){
			scroll = 0;
		});        
		
        $('#sleft img').hover(function(){
			scroll = 1;
			scroll_left();
		},function(){
			scroll = 0;
		});
		function scroll_right()
		{
			if(scrolling)
			{
				$('#carousel_inner').animate({ left: '-140px' },{queue: false, duration:300, complete:function()
				{
					$('#carousel_inner').css({'left' : '-70px'});
					$('#carousel_inner img:last').after($('#carousel_inner img:first'));
					if(	scroll==1 ){ scroll_right(); };
				}});  
			}
		}
		function scroll_left()
		{
			if(scrolling)
			{
				$('#carousel_inner').animate({ left: '0px' },{queue: false, duration:300, complete:function()
				{
					$('#carousel_inner img:first').before($('#carousel_inner img:last'));
					$('#carousel_inner').css({'left' : '-70px'});
					if(	scroll==1 ){ scroll_left(); };
				}});  
			}
		}
	});  
</script>
<div id="saving">
	<h1>Saving image</h1>
	<h1>Please wait</h1>
	<img src="<?php echo "".base_url()."tinybox2/images/preload.gif" ?>"/>
</div>
<div id="posterpicker">
	<?php
			$filename = $hash.'.tbn';
			$current = base_url().'thumbs/'.substr($hash,0,1).'/'.$filename;
			echo "<div id='menu'>\n\t\t";
			echo "<div id='mbg'></div>";
			echo "<div id='buttons'><button class='save' value='".$filename."' id='".$id."'>SAVE</button>\n\t";
			echo "<button class='revert' value='".$current."' id='".$id."'>REVERT</button></div>";
			echo "</div>\n\t";
			echo "<div id='current'>\n\t\t";
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
				echo "</div>\n\t";
				echo "<div id='picker'>\n\t\t";
				echo "<div id='cbg'></div>\n\t\t";
				echo "<div id='sleft'><img src='".base_url()."img/aleft.gif' /></div>\n\t\t";
				echo "<div id='carousel'>\n\t\t\t";
				echo "<div id='carousel_inner'>\n\t\t\t";
				for ($i = 0; $i < count($urls); $i++)
				{
					$url=$base.$urls[$i]['file_path'];
					echo "\t".'<img class="thumb" id="'.$i.'" onclick="switchposter(this)" title="'.$url.'" src="'.base_url().'img/wait.gif"/>'."\n\t\t\t";
				}
				echo "</div>\n\t\t</div>\n\t\t";
				echo "<div id='sright'><img src='".base_url()."img/aright.gif' /></div>\n\t\t";
				echo "<div id='baseurl' class='hidden'>".base_url()."</div>\n";
			}
			else
			{
				echo "<p style='color:white'><strong>NO REMOTE POSTERS FOUND!</strong></p>\n";
			}
		?>
	</div>
</div>
