$(document).ready(loadDocument);

function loadDocument() {
	loadEventsDetails();
	loadComments(); 
}

function loadEventsDetails() {
	$.ajax("../action_detalhesEvento.php",
	{
		type: "GET",
		data: "",
		success: function(data)
		{
			for (var i = 0; i < data.length; i++)
			{
				insertDetails(data[i].tema, data[i].descricao, data[i].localizacao, data[i].dataOcorrencia, data[i].tipo, data[i].tempo, data[i].fotografia);
				console.log(data[i].tema + " - " + data[i].descricao + " - " + data[i].dataOcorrencia + " - " + data[i].tipo + " - " + data[i].tempo + " - " + data[i].fotografia);
			}
		},
		error: function(data)
		{
			console.log(data.responseText);
		}
	})
}

function loadComments() { // TBD
	$.ajax("../action_comentariosEvento.php",
	{
		type: "GET",
		data: "",
		success: function(data)
		{
			for (var i = data.length-1; i >= 0; i--)
			{
				console.log(data[i].mensagem + "-" + data[i].fotografia + "-" + data[i].nome);
				insertComment(data[i].nome, data[i].mensagem, data[i].fotografia);
			}
		},
		error: function(data)
		{
			console.log(data.responseText);
		}
	})
}

			

function insertDetails(tema, descricao, localizacao, data, tipo, hora, fotografia) {
	$("label[for='nome']").append("Tema: "+tema);
	$("label[for='descricao']").append("Descrição: "+descricao);
	$("label[for='localizacao']").append("Localização: "+localizacao);
	$("label[for='data']").append("Data: "+data);
	$("label[for='hora']").append("Hora: "+hora);
	if (tipo == 0)
		$("label[for='tipo']").append("Evento público");
	else
		$("label[for='tipo']").append("Evento privado");
	$(".caixaFoto").append("<img src=../"+fotografia+" class='fotoDetalhe'>");
}


function insertComment(nome, comentario, foto) {
	$(".caixaComentarios").append("<div class='containerComentario'><div class = 'caixaProfile'><img src=../"+foto+" class='fotoDetalhe'></div><div class='caixaComentario'><h2>"+nome+"</h2>"+comentario+"</div></div>"); // TBD
}