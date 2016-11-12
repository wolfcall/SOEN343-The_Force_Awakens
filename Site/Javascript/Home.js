//The Javascript file containing the javascript from PHP/Pages/Home.php.

$(document).ready(function() {
	disappear();
	
	var monthNames = ["January", "February", "March", "April", "May", "June",
		"July", "August", "September", "October", "November", "December"];
	var dayNames = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
	var currentDate = new Date();

	todayDate = dayNames[currentDate.getDay()] + ", " 
						+ monthNames[currentDate.getMonth()] + " " 
						+ currentDate.getDate() + " "
						+ currentDate.getUTCFullYear();

	//loadTable(currentDate.getUTCFullYear() + "/" + (currentDate.getMonth()+1) + "/" + currentDate.getDate());
	document.getElementById("datetoday").innerHTML = todayDate;
	document.getElementById("dateDrop").value = todayDate;
	/** end of the function, resued in "onSelect" feature of datepicker */

	$("#datepickerInline").datepicker({
	//	buttonImage: '../img/calendar.png',
	//	buttonImageOnly: true,
		changeMonth: true,
		changeYear: true,
		showOn: 'both',
		minDate: 0,
		maxDate: new Date(2018, 11, 31),
		onSelect: function(event) {
			var pickedDate = $("#datepickerInline").datepicker("getDate");
			todayDate = dayNames[pickedDate.getDay()] + ", " 
						+ monthNames[pickedDate.getMonth()] + " " 
						+ pickedDate.getDate() + " "
						+ pickedDate.getUTCFullYear();
			//loadTable(pickedDate.getUTCFullYear() + "/" + (pickedDate.getMonth()+1) + "/" + pickedDate.getDate());
			document.getElementById("datetoday").innerHTML = todayDate;
			document.getElementById("dateDrop").value = todayDate;
			
		}
	});
});



$(document).ready(function(){
	$("#myBtn").click(function(){
		var selected = document.getElementById("roomOptions").selectedIndex;
		document.getElementById("roomOptionsMod").selectedIndex = selected;
		$("#myModal").modal();
	});
});

$(document).ready(function(){
	$(".slot").click(function(){
		$("#myModal").modal();
	});
});

$(document).ready(function(){
	$("#second-r").click(function(){
		$("#profilemyModal").modal();
	});
});

$(document).ready(function(){
	$("#third-r").click(function(){
		$("#reservationmyModal").modal();
	});
});

function disappear(){
	setTimeout(function(){ 
		$("#details").slideUp(1000);
	}, 3000); 
}

function loadTable(date) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	  if (this.readyState == 4 && this.status == 200) {
	   document.getElementById("reservation-table").innerHTML = this.responseText;
	  }
	};
	xhttp.open("GET", "reservationTable.php?Date=" + date + "", false);
	xhttp.send();
} 