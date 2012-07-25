/**********************************************************
 * Function to toggle divs in tv-show list hidden/showing *
 **********************************************************/
function tvtoggle(div_id)
{
	switch(div_id)
	{
		case 'sortcontent':
			if ($('#sortcontent').is(":visible"))
			{
				$('#sortheading').replaceWith('<a href="" onclick="return tvtoggle(\'sortcontent\');" id="sortheading" class="header">- Sort options -</a>');
				$('#sort').animate({height:'25px'}, 0);
				$('#list').animate({top:'25px'}, 0);
			}
			else
			{
				$('#sortheading').replaceWith('<a href="" onclick="return tvtoggle(\'sortcontent\');" id="sortheading" class="header">^ Sort options ^</a>');
				$('#sort').animate({height:'140px'}, 0);
				$('#list').animate({top:'140px'}, 0);
				$('#seasonlistheading').animate({top:'25px'}, 0);
				$('#eplistheading').animate({top:'50px'}, 0); 
				$('#eplist').animate({top:'75px'}, 0); 
			}
			break;
		case 'showlist':
			if ($('#showlist').is(":visible"))
			{
				$('#showlistheading').replaceWith('<a href="" onclick="return tvtoggle(\'showlist\');" id="showlistheading" class="header">- TV-Shows -</a>');
				
			}
			else
			{
				$('#showlistheading').replaceWith('<a href="" onclick="return tvtoggle(\'showlist\');" id="showlistheading" class="header">^ TV-Shows ^</a>');
				$('#seasonlistheading').replaceWith('<a href="" onclick="return tvtoggle(\'seasonlist\');" id="seasonlistheading" class="header">- Season -</a>');
				$('#eplistheading').replaceWith('<a href="" onclick="return tvtoggle(\'eplist\');" id="eplistheading" class="header">- Episodes -</a>');
				$('#seasonlist').hide();
				$('#eplist').hide();
			}
			break;
		case 'seasonlist':
			if ($('#seasonlist').is(":visible"))
			{
				$('#seasonlistheading').replaceWith('<a href="" onclick="return tvtoggle(\'seasonlist\');" id="seasonlistheading" class="header">- Season -</a>');
			}
			else
			{
				$('#showlistheading').replaceWith('<a href="" onclick="return tvtoggle(\'showlist\');" id="showlistheading" class="header">- TV-Shows -</a>');
				$('#seasonlistheading').replaceWith('<a href="" onclick="return tvtoggle(\'seasonlist\');" id="seasonlistheading" class="header">^ Season ^</a>');
				$('#eplistheading').replaceWith('<a href="" onclick="return tvtoggle(\'eplist\');" id="eplistheading" class="header">- Episodes -</a>');
				$('#seasonlistheading').animate({top:'25px'}, 0);
				$('#seasonlist').animate({top:'50px'}, 0);
				$('#seasonlist').animate({bottom:'25px'}, 0);
				$('#showlist').hide();
				$('#eplist').hide();
			}
			break;
		case 'eplist':
			if ($('#eplist').is(":visible"))
			{
				$('#eplistheading').replaceWith('<a href="" onclick="return tvtoggle(\'eplist\');" id="eplistheading" class="header">- Episodes -</a>');
			}
			else
			{
				$('#showlistheading').replaceWith('<a href="" onclick="return tvtoggle(\'showlist\');" id="showlistheading" class="header">- TV-Shows -</a>');
				$('#seasonlistheading').replaceWith('<a href="" onclick="return tvtoggle(\'seasonlist\');" id="seasonlistheading" class="header">- Season -</a>');
				$('#eplistheading').replaceWith('<a href="" onclick="return tvtoggle(\'eplist\');" id="eplistheading" class="header">^ Episodes ^</a>');
				$('#seasonlistheading').animate({top:'25px'}, 0);
				$('#eplistheading').animate({top:'50px'}, 0); 
				$('#eplist').animate({top:'75px'}, 0); 
				$('#showlist').hide();
				$('#seasonlist').hide();
			}
			break;
	}
	$('#' + div_id).toggle();
	
	if ($('#sortcontent').is(":hidden") && $('#showlist').is(":hidden") && $('#seasonlist').is(":hidden") && $('#eplist').is(":hidden"))
	{
		$('#sidebar').animate({width:'130px'}, 0);
		$('#sidebar').animate({height:'95px'}, 0);
		$('#content').animate({left:'180px'}, 0);
	}
	else if ($('#sortcontent').is(":visible") && $('#showlist').is(":hidden") && $('#seasonlist').is(":hidden") && $('#eplist').is(":hidden"))
	{
		$('#sidebar').removeAttr('style'); 
		$('#sidebar').animate({height:'208px'}, 10);
		$('#content').removeAttr('style'); 
	}
	else
	{
		$('#sidebar').removeAttr('style'); 
		$('#content').removeAttr('style'); 
	}
	return false;
}

/********************************************************
 * Function to toggle divs in movie list hidden/showing *
 ********************************************************/
function togglehidden(div_id)
{
	if (div_id == "sortcontent")
	{
		if ($('#' + div_id).is(":visible"))
		{
			$('#sortlabel').replaceWith('<a href="" onclick="return togglehidden(\'sortcontent\');" id="sortlabel">- Sort options -</a>');
			$('#sort').animate({height:'25px'}, 0);
			$('#list').animate({top:'25px'}, 0);
		}
		else
		{
			$('#sortlabel').replaceWith('<a href="" onclick="return togglehidden(\'sortcontent\');" id="sortlabel">^ Sort options ^</a>');
			$('#sort').animate({height:'140px'}, 0);
			$('#list').animate({top:'140px'}, 0);
		}
	}
	if (div_id == "listcontent")
	{
		if ($('#' + div_id).is(":visible"))
		{
			$('#listlabel').replaceWith('<a href="" onclick="return togglehidden(\'listcontent\');" id="togglelabel">- Movies -</a>');
		}
		else
		{
			$('#listlabel').replaceWith('<a href="" onclick="return togglehidden(\'listcontent\');" id="togglelabel">^ Movies ^</a>');
		}
	}
	
	$('#' + div_id).toggle();
	if ($('#listcontent').is(":hidden") && $('#sortcontent').is(":visible"))
	{
		$('#sidebar').removeAttr('style'); 
		$('#sidebar').animate({height:'162px'}, 10);
		$('#content').removeAttr('style'); 
	}
	if ($('#listcontent').is(":visible"))
	{
		$('#sidebar').removeAttr('style'); 
		$('#content').removeAttr('style'); 
	}
	if ($('#listcontent').is(":hidden") && $('#sortcontent').is(":hidden"))
	{
		$('#sidebar').animate({width:'130px'}, 0);
		$('#sidebar').animate({height:'46px'}, 0);
		$('#content').animate({left:'180px'}, 0);
	}
	return false;
}

/**********************
 * For the movie view *
 **********************/
// Function viewmovie, updates content navigation and content for movie info view --//
function viewmovie(id, view)														//
{																					//
	edit='1';
	if (view)																		//
	{																				//
		$('#contentnav').load("movies/viewcontentnav?id=" + id + "&view=" + view);	//
		$('#contentinfo').load("movies/viewmovie?id=" + id + "&view=" + view);		//
		return false;																//
	}																				//
	else																			//
	{																				//
		$('#contentnav').load("movies/viewcontentnav?id=" + id);					//
		$('#contentinfo').load("movies/viewmovie?id=" + id);						//
	}																				//
	$('#list li').removeAttr('style');
	$('#' + id).css('background-color',"black");
	$('#' + id).css('color',"white");
	return false;																	//
}																					//
// End function viewmovie(id, view) ------------------------------------------------//

// Function editmovie, updates content navigation and content for movie edit view
function editmovie(object)
{
	var value = $("#" + object.name).find("#datacol").html();
	switch(object.name)
	{
		case 'Watched':
			value = (value == 'Yes') ? null : '1';
			break;
		case 'Title':
			var newtitle = prompt("Please enter the new title",value);
			if(newtitle != value && newtitle != null)
			{
				value = newtitle;
			}
			else if(newtitle == null ||  newtitle == value)
			{
				return false;
			}
			break;
		case 'Path':
			var newpath = prompt("Please enter the new path",value);
			if(newpath != value && newpath != null)
			{
				value = newpath;
			}
			else if(newpath == null ||  newpath == value)
			{
				return false;
			}
			break;
		case 'File':
			var newfile = prompt("Please enter the new filename",value);
			if(newfile != value && newfile != null)
			{
				value = newfile;
			}
			else if(newfile == null ||  newfile == value)
			{
				return false;
			}
			break;
		case 'Delete':
			var action = confirm("Are you sure you want to delete this item?");
			if (action==true)
			{
				$.post('/movies/delete',{ id: object.id });
				location.reload();
			}
			else
			{
				location.reload();
			}
			return false;
			break;
		default:
			return false;
			break;
	}
	$.ajax(
	{
		type: 'POST',
		url:  '/movies/edit',
		async: false,
		data: {
			id: object.id,
			what: object.name,
			to: value
		},
		success: function(data)
		{
			$('#contentnav').load("movies/viewcontentnav?id=" + object.id);
			$('#contentinfo').load("movies/viewmovie?id=" + object.id);
		},
		error: function(data)
		{
			alert("Error: " + data);
		}
	});
	return false;
}
// Function sortmovies, update movie list based on selected sorting options
function sortmovies()
{
	var sortby = $('select.sortby option:selected').val();
	var sortdir = $('select.sortdir option:selected').val();
	var filter = $('select.filterby option:selected').val();
	$('#listcontent').load("movies/getlist?sortby=" + sortby + "&sortdir=" + sortdir + "&filter=" + filter);
	if ($('#listcontent').is(":hidden"))
	{
		$('#sidebar').removeAttr('style'); 
		$('#content').removeAttr('style'); 
		$('#listcontent').toggle();
	}
}

/************************
 * For the TV-Show view *
 ************************/
// Function viewtv, updates content navigation and content for tv-show/episode info view
function viewtv(object, view)
{
	edit='1';
	var idshow = object.id;
	var idepisode = object.title ? object.title : '0';
	var what = $(object).attr('class');
	if (view)
	{
		switch (what)
		{
			case 'tvshowlink':
				$('#contentnav').load("shows/viewcontentnav?idshow="+idshow+"&idepisode="+idepisode+"&view="+view);
				$('#contentinfo').load('shows/view?idshow='+idshow+"&idepisode="+idepisode+"&view="+view);
				$('#seasonlist').load('shows/getseasons?idshow='+idshow);
				$('#eplist').load('shows/getepisodes?idshow='+idshow);
				$('#showlist li').removeAttr('style');
				break;
			case 'eplink':
				$('#contentnav').load("shows/viewcontentnav?idshow=" + idshow + "&idepisode=" + idepisode+"&view="+view);
				$('#contentinfo').load('shows/view?idshow=' + idshow + "&idepisode=" + idepisode + "&view=" + view);
				$('#eplist li').removeAttr('style');
				break;
			default:
				$('#contentnav').load("shows/viewcontentnav?idshow="+idshow+"&idepisode="+idepisode+"&view="+view);
				$('#contentinfo').load('shows/view?idshow='+idshow+"&idepisode="+idepisode+"&view="+view);
				break;
		}
	}
	else
	{
		switch (what)
		{
			case 'tvshowlink':
				$('#contentnav').load("shows/viewcontentnav?idshow="+idshow+"&idepisode="+idepisode);
				$('#contentinfo').load('shows/view?idshow='+idshow+"&idepisode="+idepisode);
				$('#seasonlist').load('shows/getseasons?idshow='+idshow);
				$('#eplist').load('shows/getepisodes?idshow='+idshow);
				$('#showlist li').removeAttr('style');
				break;
			case 'eplink':
				$('#contentnav').load("shows/viewcontentnav?idshow=" + idshow + "&idepisode=" + idepisode);
				$('#contentinfo').load('shows/view?idshow=' + idshow + "&idepisode=" + idepisode);
				$('#eplist li').removeAttr('style');
				break;
			default:
				$('#contentnav').load("shows/viewcontentnav?idshow="+idshow+"&idepisode="+idepisode);
				$('#contentinfo').load('shows/view?idshow='+idshow+"&idepisode="+idepisode);
				break;
		}
	}
	if (what == 'tvshowlink' || what == 'eplink')
	{
		$(object).css('background-color',"black");
		$(object).css('color',"white");
	}
	return false;
}
// Function sortshows, updates tv-show list based on sorting options
function sortshows()
{
	var sortby = $('select.sortby option:selected').val();
	var sortdir = $('select.sortdir option:selected').val();
	$('#showlist').load("shows/getlist?sortby=" + sortby + "&sortdir=" + sortdir + "&filter=" + filter);
}
// Function sortepisodes, updates episode list based on sorting options
function sortepisodes(object)
{
	var idshow = object.id;
	var season = object.title ? object.title : '0';
	$('#eplist').load('shows/getepisodes?idshow=' + idshow + '&season=' + season);
	tvtoggle('eplist');
	$('#seasonlist li').removeAttr('style');
	$(object).css('background-color',"black");
	$(object).css('color',"white");
	return false;
}

/*************************
 * For the settings view *
 *************************/
function viewsettings(object)
{
	what = object.id;
	$('#contentnav').load('settings/getcontentnav?what=' + what);
	$('#contentinfo').load('settings/getsettings?what=' + what);
	return false;
}
// Function to save edited settings
function editcfg(object)
{
	var type = object.id;
	switch (type)
	{
		case 'dbcfg':
			var data = {};
			$('.'+type).each(function(index)
			{
				data['hostname'] = ($(this).attr('name') == 'Hostname') ? $(this).attr('value') : data['hostname'];
				data['username'] = ($(this).attr('name') == 'Username') ? $(this).attr('value') : data['username'];
				data['password'] = ($(this).attr('name') == 'Password') ? $(this).attr('value') : data['password'];
				data['database'] = ($(this).attr('name') == 'Database') ? $(this).attr('value') : data['database'];
				data['dbdriver'] = ($(this).attr('name') == 'Database driver') ? $(this + 'option:selected').attr('value') : data['dbdriver'];
				data['dbprefix'] = ($(this).attr('name') == 'Database prefix') ? $(this).attr('value') : data['dbprefix'];
			});
			$.ajax(
			{
				type: 'POST',
				url:  '/settings/edit',
				async: false,
				data: data,
				success: function(data)
				{
					alert("SAVED!" + data);
					$('#contentnav').load('settings/getcontentnav?what=database');
					$('#contentinfo').load('settings/getsettings?what=database');
				},
				error: function(data)
				{
					alert("Error: " + data);
				}
			});
			break;
		case 'usercfg':
			alert('Type: ' +type);
			break;
		case 'users':
			alert('Type: ' +type);
			break;
	}
	return false;
}
