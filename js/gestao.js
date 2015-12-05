$(document).ready(loadDocument);
var status;
var dados;

function loadDocument() {
	status = 1; // variavel para o changeStance, se 1, troca para "modo editar", se 0, troca para "modo convite"
    $("#tab1").click(setConvite);
	$("#tab2").click(setEditar);
	loadInvites();
}

function loadInvites() {
	$.ajax("../action_loadOrganiza.php",
	{
		type: "GET",
		data: "",
		success: function(data)
		{
			dados = data;
			for (var i = 0; i < data.length; i++)
			{
				insertInvite(data[i].eid, data[i].tema);
				console.log(data[i].eid+"-"+data[i].tema);
			}
		},
		error: function(data)
		{
			console.log(data.responseText);
		}
	})
}

function setConvite(){
	if (status == 0) {// load Invites
		$(".caixa").empty();
		$("#tab1").parent("div").removeClass();
		$("#tab2").parent("div").removeClass();
		$("#tab1").parent("div").addClass("activo");
		$("#tab2").parent("div").addClass("inactivo");
		status = 1;
		for (var i = 0; i < dados.length; i++) {
				insertInvite(dados[i].eid, dados[i].tema);
				console.log(dados[i].eid+"-"+dados[i].tema);
			}
		}
	}
function setEditar() {
	if (status == 1) { // load edits
		$(".caixa").empty();
		$("#tab1").parent("div").removeClass();
		$("#tab2").parent("div").removeClass();
		$("#tab1").parent("div").addClass("inactivo");
		$("#tab2").parent("div").addClass("activo");
		status = 0;
		for (var i = 0; i < dados.length; i++) {
			insertEdit(dados[i].eid, dados[i].tema, dados[i].descricao, dados[i].localizacao, dados[i].dataOcorrencia, dados[i].tempo, dados[i].fotografia);
			console.log(dados[i].eid+"-"+dados[i].tema);
		}
	}	
}

function insertInvite(eid, tema) {
	caixa = $(".caixa");
	caixa.append('<div class= "containerConvite"><form accept-charset="utf-8" action="../action_inviteEvents.php" method="post" enctype="multipart/form-data" class="simform"><div class="sminputs"><div class="input string optional"><label class="string optional" >Nome: '+tema+'</label></div><div class="input string optional"><label class="string optional" for="convidado">Introduzir Username convidado</label><input type="hidden" value="'+eid+'" name="eid"><input class="string optional" maxlength="255" name="convidado" type="text" ></div></div><div class="simform__actions"><input class="sumbit" name="commit" type="submit" value="CONVIDAR" /></div> </form></div></div><br>');
}

function insertEdit(eid, tema, descricao, localizacao, data, tempo, foto) {
	caixa = $(".caixa");
	caixa.append('<div class="caixaFoto"><img src=../'+foto+' class="fotoDetalhe"></div><div class="caixaEvento"><form action="../action_editEvent.php" method="post" enctype="multipart/form-data"><div class="sminputs"><div class="input full"><input type="hidden" name="eid" value='+eid+'><label class="string optional" for="nome">Nome: '+tema+'</label><input type="text" name="nome" placeholder="Nome"></div></div><div class="sminputs"><div class="input full"><label class="string optional" for="descricao">Descrição: '+descricao+'</label><textarea rows="2" cols="50" name="descricao" placeholder="Descrição"></textarea></div></div><div class="sminputs"><div class="input string optional"><label class="string optional" for="localiazação">Localização: '+localizacao+'</label><input type="text" name="localizacao" placeholder="localização"></div><div class="input string optional"><label class="string optional" for="data">Data: '+data+'</label><input type="date" name="data" placeholder="data ocorrência"></div></div><div class="sminputs"><div class="input string optional"><label class="string optional" for="hora">Hora: '+tempo+'</label><input type="time" name="tempo" placeholder="tempo"></div><div class="input string optional"><label class="string optional" for="poster">Poster*</label><input type="file" name="image" accept=".png, .jpg"></div></div><div class="simform__actions"><input class="sumbit" name="commit" type="submit" value="EDITAR" /><input id="remover" class="sumbit" name="commit" type="submit" value="REMOVER" /></div></form></div>');
}

