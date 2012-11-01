/*************************************************
 * Function to replace poster with file from url *
 *************************************************/
function switchposter(object)
{
	var url=object.src;
	var poster=$('#poster');
	$('#poster').attr('src', url);
	$('#menu').css({'display': 'block'});
	return false;
}

$('.revert').live('click', function() {
	var url=$(this).val();
	$('#poster').attr('src', url);
	$('#menu').css({'display': 'none'});
});

$('.save').live('click', function() {
	$('#posterpicker').css({'display': 'none'});
	$('#saving').css({'display': 'block'});
	
	var filename=$(this).val();
	var id=$(this).attr('id');
	var fileurl=$('#poster').attr('src');
	var baseurl=$('#baseurl').html();

	// Save the new poster to correct file
	$('#baseurl').load(baseurl + "movies/saveposter?purl="+fileurl+"&pfile="+filename, function()
	{
		// Reloads content info when poster have changed
		$('#contentinfo', window.parent.document).load(baseurl+"movies/viewmovie?id="+id, function()
		{
			// Close iframe after page reload is done
			parent.TINY.box.hide();
		});
	});
	return false;
});
