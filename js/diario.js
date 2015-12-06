var nameMonth = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
var day;
var year;
var month;
var weeks;
var lastDay;

$(document).ready(loadDocument);


function loadDocument() {
	 
	
	$("input[class='next']").click(nextDay);
	$("input[class='previous']").click(previousDay);
	loadDay();
	
}
 
function loadDay(){
	var d = new Date();
	day = d.getDate();
	year = d.getFullYear();
	month = d.getMonth();
	
	
	
	drawDayEvents();
	
}


function updateDayEvents(){
 	deleteDayEvents();
	drawDayEvents();
	
}

function deleteDayEvents(){			// para substituir o que está no div por nada
	
	$(".DayEvents").replaceWith("<div class=DayEvents> </div>");
	//$(".titlee").replaceWith("<h1 class = titlee>6, dezembro</h1>");
}




function nextDay(){
	
	var days =new Date(year, month + 1 , 0).getDate();
	
	if (day == days){
		
		if(month == 11)
		{
			month = 0;
			day = 1;
			++year
		}
		else{
			++month;
			day = 1;
		}
		
	}
	else
		++day;
	
	
	 
	
	
	updateDayEvents();
}

function previousDay(){
	
	if(day == 1){
		
		if (month == 0){
			month = 11;
			day = 31;
			--year;
		}
		else{
			--month;
			day = new Date(year, month + 1, 0).getDate();
		}
				
	}
	else
		--day;
	
	
	 
	
	
	updateDayEvents();
}


 

function drawDayEvents(){
	
	
	$(".titlee").replaceWith("<h1 class = titlee>" + day + ", " + nameMonth[month] + "</h1>");
	
	$.ajax("../action_myEventsToday.php?&year=" + year + "&month=" + month + "&day=" + day,
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
	content = $(".DayEvents");
	content.append("<a href='detalhesEvento.php?eid="+id+"'><img src=../"+fotografia+" alt='Evento' class='fotoEvento'></a><br>");
}


 
