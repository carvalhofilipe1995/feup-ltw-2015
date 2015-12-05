$(document).ready(loadDocument);


function loadDocument() {
	loadPublicEvents();
}

function loadPublicEvents(){
	$.ajax("../action_publicEvents.php",
	{
		type: "GET",
		data: "",
		success: function(data)
		{
			for (var i = 0; i < data.length; i++)
			{
				insertEvent(data[i].eid, data[i].fotografia);
				console.log(data[i].eid + " - " + data[i].fotografia);
			}
		},
		error: function(data)
		{
			console.log(data.responseText);
		}
	})
}

function insertEvent(id, fotografia){
	content = $(".content");
	content.append("<a href='detalhesEvento.php?eid="+id+"'><img src=../"+fotografia+" alt='Evento' class='fotoEvento'></a><br>");
}

