$(document).ready(loadDocument);


function loadDocument() {
	loadPublicEvents();
}

function loadPublicEvents(){
	$.ajax("../action_loadOrganiza.php",
	{
		type: "GET",
		data: "",
		success: function(data)
		{
			for (var i = 0; i < data.length; i++)
			{
				insertEvent(data[i].eid, data[i].tema);
				console.log(data[i].eid+"-"+data[i].tema);
			}
		},
		error: function(data)
		{
			console.log(data.responseText);
		}
	})
}

function insertEvent(eid, tema){
	content = $(".content");
	content.append('<div class= "containerConvite"><form accept-charset="utf-8" action="../action_inviteEvents.php" method="post" enctype="multipart/form-data" class="simform"><div class="sminputs"><div class="input string optional"><label class="string optional" >'+tema+'</label></div><div class="input string optional"><label class="string optional" for="convidado">Username convidado*</label><input type="hidden" value="'+eid+'" name="eid"><input class="string optional" maxlength="255" name="convidado" type="text" ></div></div><div class="simform__actions"><input class="sumbit" name="commit" type="submit" value="CONVIDAR" /></div> </form></div></div><br>');
}
