var nameMonth = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
var currentMonth;
var day;
var year;
var month;
var weeks;
var lastDay;
$(document).ready(loadDocument);


function loadDocument() {
	$("input[class='next']").click(nextMonth);
	$("input[class='previous']").click(previousMonth);
	loadCalendar();
}

function loadCalendar(){ // Cria calendário de acordo com o dia de hoje
	var d = new Date();
	day = d.getDate(); //1-31
	year = d.getFullYear();
	month = d.getMonth(); //0-11
	currentMonth = month;
	var firstDay = new Date(year, month, 1);
	lastDay = new Date(year, month + 1, 0);
	weeks = Math.ceil((firstDay.getDay() + lastDay.getDate())/7);
	drawCalendar(firstDay.getDay(), lastDay.getDate());
}

function updateCalendar(d){ // Troca calendário de acordo com o avanço ou recuo do mês
	deleteCalendar();
	var firstDay = new Date(year, month, 1);
	lastDay = new Date(year, month + 1, 0);
	weeks = Math.ceil((firstDay.getDay() + lastDay.getDate())/7);
	drawCalendar(firstDay.getDay(), lastDay.getDate());
}

function deleteCalendar(){
	$(".mensal").replaceWith("<div class=mensal><table><tr class = diasSemana><td>Domingo</td><td>Segunda</td><td>Terca</td><td>Quarta</td><td>Quinta</td><td>Sexta</td><td>Sabado</td></tr><tr class = semana><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></table></div>");
}

function drawCalendar(firstDay, lastDay) { // Desenha calendário	
	var count=1;
	drawMonth();
	for (i=2;i<=weeks;i++) {
		drawWeeks();
	}
	semana = $(".mensal tr:first");
	semana = semana.next("tr");
	dia = semana.children("td:first");	
	for (j=1;j<=weeks;j++) {
		semana.addClass(j);
		for (i=0;i<7;i++) {
			if ((i<firstDay && j==1) || count>lastDay){
				dia.addClass("naoValido");
			}
			else {
				if ((month==currentMonth) && (count==day)){
					dia.addClass("hoje");
					dia.append('<div class=container><span class=dia>'+count+'</span><div class="events-container"></div></div>');
					count++;
				}
				else {
					dia.addClass("valido");
					dia.append('<div class=container><span class=dia>'+count+'</span><div class="events-container"></div></div>');
					count++;
				}
			}	
			dia = dia.next("td");
		}
		semana = semana.next("tr");
		dia = semana.children("td:first");
	}
	loadEvents();
}

function drawWeeks() { // Replica semanas até ter semanas suficientes
	var newLine = $(".semana:last-child").clone();
	$(".semana:last-child").after(newLine);
}

function drawMonth() { // Escreve o nome do mês
	$("h1", ".wrapper").replaceWith("<h1>"+nameMonth[month]+" "+year+"</h1>");
}


function nextMonth() { // Incrementa um mês no calendário
	if (month == 11) {
		month = 0;
		year++;
		}
	else {
		month++;
	}
	var d = new Date(year, month, 0);
	updateCalendar(d);
}

function previousMonth() { // Decrementa um mês no caléndario
	if (month == 0){
		year--;
		month = 11;
		}
	else {
		month--;
	}
	var d = new Date(year, month, 0);
	updateCalendar(d);
}

function returnDay(data) { // Retorna d do dia
	var formatoData = data.split('-');
	var result = $('.dia').filter(function() {
    return $(this).text() === formatoData['2'];
		}).parent('div').find('.events-container');
	if (result.length == 0) { // Dia com um algarismo fica 01 (...) Bug fix
		formatoData['2'] = formatoData['2'].replace('0', '');
		result = $('.dia').filter(function() {
			return $(this).text() === formatoData['2'];
		}).parent('div').find('.events-container');
	}
	return result;
}

function loadEvents() 
{
	$.ajax("../action_myEvents.php?year="+year+"&month="+month+"&lastDay="+lastDay.getDate(),
	{
		type: "GET",
		data: "", 
		success: function(data)
		{
			for (var i = 0; i < data.length; i++)
			{
				console.log(data[i].tema + " - " + data[i].dataOcorrencia);
				insertEvent(data[i].tema, data[i].dataOcorrencia);
			}
		},
		error: function(data)
		{
			console.log(data.responseText);
		}
	})
}


function insertEvent(tema, data) {
	result = returnDay(data);
	result.append('<div class="evento">' + tema + '</div>');
}