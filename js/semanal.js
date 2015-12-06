var nameMonth = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
var firstDayMonth;
var lastDayMonth;
var day;
var firstDayYear;
var lastDayYear;
var finalMonth;
var weeks;
var lastDay;
var date;
var firstDayWeek;
var lastDayWeek;
$(document).ready(loadDocument);


function loadDocument() {
  $("input[class='next']").click(nextWeek);
  $("input[class='previous']").click(previousWeek);
  loadWeeks();
}

function loadWeeks() {
  var today = new Date();
  day = today.getDate();
  dayWeek = today.getDay(); // de 0 a 6
  var year = today.getFullYear();
  var month = today.getMonth();
  firstDayMonth = month;
  lastDayMonth = month;
  firstDayYear = year;
  lastDayYear = year;
  firstDayWeek = day - dayWeek;
  if (firstDayWeek < 1) { // 0 ou numero negativo
	var previousMonth = new Date(firstDayYear, month, 0); // ultimo dia do mes anterior
	firstDayWeek = previousMonth.getDate() + firstDayWeek;
	firstDayMonth = month - 1;
	if (firstDayMonth == -1)
		firstDayMonth == 12;
		firstDayYear--;
  }
  
  lastDayWeek = day + 6;
  var nextMonth = new Date(lastDayYear, month + 1, 0);
  if (lastDayWeek > nextMonth.getDate()) {
	lastDayWeek = lastDayWeek - nextMonth.getDate();
	lastDayMonth = month + 1;
	if (lastDayMonth == 12)
		lastDayMonth = 0;
		lastDayYear++;
  }
  drawWeekTop();
  loadEvents();
}

function updateCalendar() {
	deleteSemanal();
	drawWeekTop();
	loadEvents();
}

function deleteSemanal() {
  $(".semanal").replaceWith("<div class=semanal><table><tr><td> Domingo</td><td>  </td></tr><tr><td> Segunda</td><td> </td></tr><tr><td> Terça</td><td> </td></tr><tr><td> Quarta</td><td> </td></tr>      <tr><td> Quinta</td><td> </td></tr><tr><td> Sexta</td><td> </td>  </tr><tr><td> Sábado</td>  <td> </td></tr>  </table></div>");
}

function drawWeekTop() {
	$("h1", ".wrapper").replaceWith("<h1>" + "Semana de " + firstDayWeek + " de " + nameMonth[firstDayMonth] + " de " + firstDayYear + " até " + lastDayWeek + " de " + nameMonth[lastDayMonth] + " de " + lastDayYear +"</h1>");
}

function returnDay(data) {
	var formatoData = data.split('-');
	var teste = new Date(firstDayYear, firstDayMonth + 1, 0);
	linha = $(".semanal tr:first");
	n = formatoData['2'] - firstDayWeek;
	for (var i=0;i<n ;i++) {
		linha = linha.next("tr");
	}
	return linha.children("td:last-child");
}

function nextWeek() {
  firstDayWeek = firstDayWeek + 7;
  lastDayWeek = lastDayWeek + 7;
  var nextMonth = new Date(lastDayYear, lastDayMonth + 1, 0);
  if (lastDayWeek > nextMonth.getDate()) {
	lastDayWeek = lastDayWeek - nextMonth.getDate();
	lastDayMonth++;
	if (lastDayMonth == 12) {
		lastDayMonth = 0;
		lastDayYear++;
		}
  }
  nextMonth = new Date(firstDayYear, firstDayMonth + 1, 0);
  if (firstDayWeek > nextMonth.getDate()) {
	firstDayWeek = firstDayWeek - nextMonth.getDate();
	firstDayMonth++;
	if (firstDayMonth == 12) {
		firstDayMonth = 0;
		firstDayYear++;
		}
  }
  updateCalendar();
}

function previousWeek() {
  firstDayWeek = firstDayWeek - 7;
  lastDayWeek = lastDayWeek - 7;
  if (firstDayWeek < 1) { // 0 ou numero negativo
	var previousMonth = new Date(firstDayYear, firstDayMonth, 0); // ultimo dia do mes anterior
	firstDayWeek = previousMonth.getDate() + firstDayWeek;
	firstDayMonth--;
	if (firstDayMonth == -1) {
		firstDayMonth = 11;
		firstDayYear--;
	}
  }
  if (lastDayWeek < 1) { // 0 ou numero negativo
	var previousMonth = new Date(lastDayYear, lastDayMonth, 0); // ultimo dia do mes anterior
	lastDayWeek = previousMonth.getDate() + lastDayWeek;
	lastDayMonth--;
	if (lastDayMonth == -1) {
		lastDayMonth = 11;
		lastDayYear--;
	}
  }
  updateCalendar();
}


function loadEvents()
{
	$.ajax("../action_myEventsWeek.php?firstDayYear="+firstDayYear+"&lastDayYear="+lastDayYear+"&firstDayMonth="+firstDayMonth+"&lastDayMonth="+lastDayMonth+"&firstDay="+firstDayWeek+"&lastDay="+lastDayWeek,
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
