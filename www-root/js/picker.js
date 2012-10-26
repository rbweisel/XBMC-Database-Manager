/*************************************************
 * Function to replace a file with file from url *
 *************************************************/
function switchposter(object)
{
	var url=object.src;
	$('#poster').attr('src', url);
	return false;
}
$('.psave').live('click', function() {
	var filename=$(this).val();
	var id=$(this).attr('id');
	var fileurl=$('#poster').attr('src');
	var baseurl=$('#baseurl').html();

	if(fileurl==filename)
	{
		alert("Nothing to save!");
		parent.Shadowbox.close();
		return false;
	}
	else
	{
		$('#baseurl').load(baseurl + "movies/saveposter?purl="+fileurl+"&pfile="+filename, function()
		{
			// Reloads content info when poster have changed
			$('#contentinfo', window.parent.document).load(baseurl+"movies/viewmovie?id="+id, function()
			{
				// Close ifram when done
				parent.Shadowbox.close();
			});
		});
		return false;
	}
	return false;
});
