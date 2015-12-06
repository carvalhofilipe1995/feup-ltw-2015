var nameMonth = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
var currentMonth;
var day;
var year;
var month;
var weeks;
var lastDay;
var date;
var weekNumber;
$(document).ready(loadWeeks);


function load() {
  $("input[class='next']").click(nextWeek);
  $("input[class='previous']").click(previousWeek);
  loadWeeks();
}

Date.prototype.getWeek = function() { // Returns the number of the week
    var onejan = new Date(this.getFullYear(), 0, 1);
    return Math.ceil((((this - onejan) / 86400000) + onejan.getDay() + 1) / 7);
};

function loadWeeks(){
  var today = new Date();
  day = today.getDay();
  year = today.getFullYear();
  month = today.getMonth();
  currentMonth = month;
  var firstDay = new Date(year, month, 1);
	lastDay = new Date(year, month, 7);
  weeks = Math.ceil((firstDay.getDay() + lastDay.getDate())/7);
  weekNumber = today.getWeek() - 1;
  drawWeekTop();
}

function updateCalendar() {

}

function drawCalendar() {

}

function deleteSemanal() {
  $(".semanal").replaceWith("<div class=semanal><table><tr><td> Domingo</td><td>  </td></tr><tr><td> Segunda</td><td> </td></tr><tr><td> Terça</td><td> </td></tr><tr><td> Quarta</td><td> </td></tr>      <tr><td> Quinta</td><td> </td></tr><tr><td> Sexta</td><td> </td>  </tr><tr><td> Sábado</td>  <td> </td></tr>  </table></div>");
}

function drawWeekTop() {
	$("h1", ".wrapper").replaceWith("<h1>" + "Semana" + " " + weekNumber + "</h1>");
}

function returnDay(data) {
	var formatoData = data.split('-');
	return $('.dia:contains('+formatoData['2']+')').parent('div').find('.events-container');
}

function nextWeek() {
  if(weekNumber == 52){ // Um ano tem 52 semanas
    weekNumber = 0;
    year++;
  } else {
    weekNumber++;
  }
}

function previousWeek() {
  if(weekNumber == 1){
    weekNumber = 52;
    year--;
  } else {
    weekNumber--;
  }
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
