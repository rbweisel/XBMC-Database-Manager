// Functions for editing \\

var edit='1';
var tempstring='';

/***********************
 * Save watched status *
 ***********************/
$('#savewatched').live('click', function()
{
	var val = $('#editcbox').attr('checked');
	if (val == 'checked')
	{
		$('#editdiv').replaceWith('<div class="editable watched">Yes</div>');
	}
	else
	{
		$('#editdiv').replaceWith('<div class="editable watched">No</div>');
	}
});

/********************
 * Save edited text *
 ********************/
$('#editsave').live('click', function()
{
	var val = $('#editinput').attr('value');
	if ($('#editinput').hasClass('title'))
	{
		$('#editdiv').replaceWith('<div class="editable title">'+val+'</div>');
	}
	else
	{
		$('#editdiv').replaceWith('<div class="editable">'+val+'</div>');
	}
	edit='1';
	return false;
	
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
});

/********************************************
 * If input field loses focus, restore text *
*********************************************/
$('#contentinfo').live('click', function(e)
{
	if($(e.target).attr('id') !== 'editdiv' && $(e.target).attr('id') !== 'editinput' && $(e.target).attr('id') !== 'editcbox')
	{
		if ($('#editinput').hasClass('title'))
		{
			$('#editdiv').replaceWith('<div class="editable title">'+tempstring+'</div>');
		}
		if ($('#editcbox').length != 0)
		{
			$('#editdiv').replaceWith('<div class="editable watched">'+tempstring+'</div>');
		}
		else
		{
			$('#editdiv').replaceWith('<div class="editable">'+tempstring+'</div>');
		}
		edit='1';

    }
    if($(e.target).attr('id') == 'editcbox')
    {
		$(e.target).attr('checked')=$(e.target).attr('checked');
	}
    return false;
});
/**********************************************************
 * Function to fire when an editable object is clicked on *
 **********************************************************/
$('div.editable').live('click', function(e)
{
	var id = $('#contentinfo span').attr('id');

	if (edit == '1')
	{
		edit='0';
		tempstring=$(this).html();
		if ($(this).hasClass('title'))
		{
			$(this).replaceWith('<div id="editdiv"><textarea id="editinput" class="title">'+$(this).html()+'</textarea><button id="editsave">SAVE</button></div>');
		}
		else if ($(this).hasClass('watched'))
		{
			if($(this).html() == 'Yes')
			{
				$(this).replaceWith('<div id="editdiv"><input type="checkbox" id="editcbox" value="watched" checked><button id="savewatched">SAVE</button></div>');
			}
			else
			{
				$(this).replaceWith('<div id="editdiv"><input type="checkbox" id="editcbox" value="watched"><button id="savewatched">SAVE</button></div>');
			}
		}
		else
		{
			$(this).replaceWith('<div id="editdiv"><textarea id="editinput">'+$(this).html()+'</textarea><button id="editsave">SAVE</button></div>');
		}
		$('#editinput').autosize();  
		$("#editinput").focus();
	}
	else
	{
		if ($('#editinput').hasClass('title'))
		{
			$('#editdiv').replaceWith('<div class="editable title">'+tempstring+'</div>');
		}
		if ($('#editcbox').length != 0)
		{
			$('#editdiv').replaceWith('<div class="editable watched">'+tempstring+'</div>');
		}
		else
		{
			$('#editdiv').replaceWith('<div class="editable">'+tempstring+'</div>');
		}
		edit='1';
	}
	return false;
});


