var nameMonth = ['Janeiro', 'Fevereiro', 'Mar�o', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
var currentMonth;
var dayWeek;
var day;
var year;
var month;
var weeks;
var products = ['ABCD', 'DEFG'];
var sessao;
$(document).ready(loadDocument);


function loadDocument() {
	$("input[value='next']").click(nextMonth);
	$("input[value='previous']").click(previousMonth);
	loadCalendar();
}

function loadCalendar(){ // Cria calend�rio de acordo com o dia de hoje
	var d = new Date();
	dayWeek = d.getDay(); //0-6
	day = d.getDate(); //1-31
	year = d.getFullYear();
	month = d.getMonth(); //0-11
	currentMonth = month;
	var firstDay = new Date(year, month, 1);
	var lastDay = new Date(year, month + 1, 0);
	weeks = Math.ceil((firstDay.getDay() + lastDay.getDate())/7);
	drawCalendar(firstDay.getDay(), lastDay.getDate());
}

function updateCalendar(d){ // Troca calend�rio de acordo com o avan�o ou recuo do m�s
	deleteCalendar();
	var firstDay = new Date(year, month, 1);
	var lastDay = new Date(year, month + 1, 0);
	weeks = Math.ceil((firstDay.getDay() + lastDay.getDate())/7);
	drawCalendar(firstDay.getDay(), lastDay.getDate());
}

function deleteCalendar(){
	$(".mensal").replaceWith("<div class=mensal><table><tr class = diasSemana><td>Domingo</td><td>Segunda</td><td>Terca</td><td>Quarta</td><td>Quinta</td><td>Sexta</td><td>Sabado</td></tr><tr class = semana><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></table></div>");
}

function drawCalendar(firstDay, lastDay) { // Desenha calend�rio	
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
					dia.append('<span class=dia>'+count+'</span>');
					count++;
				}
				else {
					dia.addClass("valido");
					dia.append('<span class=dia>'+count+'</span>');
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

function drawWeeks() { // Replica semanas at� ter semanas suficientes
	var newLine = $(".semana:last-child").clone();
	$(".semana:last-child").after(newLine);
}

function drawMonth() { // Escreve o nome do m�s
	$("h1", ".wrapper").replaceWith("<h1>"+nameMonth[month]+" "+year+"</h1>");
}


function nextMonth() { // Incrementa um m�s no calend�rio
	if (month == 11){
		month = 0;
		year++;
		}
	else {
		month++;
	}
	var d = new Date(year, month, 0);
	updateCalendar(d);
}

function previousMonth() { // Decrementa um m�s no cal�ndario
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

function returnDay(data) { // Retorna elemento td do dia
	var formatoData = data.split('-');
	if (formatoData['0'] != year) {
		return null;
		}
	else if (formatoData['1'] != (month+1)){ // month vai desde 0-11 enquanto q na db vai de 1-12
		return null;
		}
	else
		return $('.dia:contains('+formatoData['2']+')').parent('td');
}

function loadEvents() {
	var id = $('#id').val();
	$.getJSON( "action_myEvents.php?id="+id, eventsLoad)
}

function eventsLoad(data){
	$.each(data, insertEvent);
}

function insertEvent(key, data){
	result = returnDay(data);
	if (result==null)
		return null
	else {
		result.append('<div class=evento>TESTE</div><br>');
		}
}
