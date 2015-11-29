var day;
var year;
var month;
$(document).ready(loadDocument);


function loadDocument() {
	loadPublicEvents();
}

function loadPublicEvents(){
	$.ajax("action_publicEvents.php",
	{
		type: "GET",
		data: "",
		success: function(data)
		{
			for (var i = 0; i < data.length; i++)
			{
				insertEvent(data[i].id, data[i].fotografia);
				console.log(data[i].id + " - " + data[i].fotografia);
			}
		},
		error: function(data)
		{
			console.log(data.responseText);
		}
	})
}

function insertEvent(id, fotografia){
	content = $(".publicEventContainer");
	content.append("<img src="+fotografia+" alt='Evento' class='fotoEvento'><br>");
}

