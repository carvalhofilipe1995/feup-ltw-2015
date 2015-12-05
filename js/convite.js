$(document).ready(loadDocument);


function loadDocument() {
	loadInvites();
}

function loadInvites(){
	$.ajax("../action_loadInvite.php",
	{
		type: "GET",
		data: "",
		success: function(data)
		{
			for (var i = 0; i < data.length; i++)
			{
				insertInvite(data[i].tema, data[i].eid, data[i].dataOcorrencia);
				console.log(data[i].tema+"-"+data[i].eid+"-"+data[i].dataOcorrencia);
			}
		},
		error: function(data)
		{
			console.log(data.responseText);
		}
	})
}

function insertInvite(tema, eid, dataOcorrencia){
	content = $(".content");
	content.append('<div class= "containerConvite"><form accept-charset="utf-8" action="../action_acceptInvite.php" method="post" enctype="multipart/form-data" class="simform"><div class="sminputs"><div class="input string optional"><label class="string optional" >'+tema+'</label></div><div class="input string optional"><label class="string optional" >'+dataOcorrencia+'</label></div><input type="hidden" value="'+eid+'" name="eid"></div><div class="simform__actions"><input class="sumbit" name="commit" type="submit" value="ACEITAR"/></div></form></div><br>');
	
}