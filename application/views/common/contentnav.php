				<script>
					var uri = "<?php if ( $hash ) { echo base_url().'thumbs/Fanart/'.$hash.'.tbn'; } ?>";
					var exists = "<?php if ( @file_get_contents(base_url().'thumbs/Fanart/'.$hash.'.tbn',0,NULL,0,1) ) { echo '1'; } else { echo '0'; } ?>"
					if (exists == "0")
					{
						$('#bglink').replaceWith('<div id="nobglink"></div>');
						$('#background').css("background-image", "url()");
						$('#background').css("background-color", "transparent");
					}
					else
					{
						$('#nobglink').replaceWith('<a title="Backdrop" id="bglink" onclick="Shadowbox.open({content: \'' + uri + '\', player: \'img\', title: \'Backdrop\'});"></a>');
						$('#bglink').replaceWith('<a title="Backdrop" id="bglink" onclick="Shadowbox.open({content: \'' + uri + '\', player: \'img\', title: \'Backdrop\'});"></a>');
						$('#background').css("background-image", "url(" + uri + ")");
						$('#background').css("background-color", "black");
					}
				</script>
				<?php
				if (is_array($menulist))
				{
					foreach ($menulist as $link)
					{
						echo "\t".$link."\n\t\t\t\t";
					}
				}
				else
				{
					echo $menulist;
				}
				?>
