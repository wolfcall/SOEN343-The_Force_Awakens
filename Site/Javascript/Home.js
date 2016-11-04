//The Javascript file containing the javascript from PHP/Pages/Home.php.

$(document).ready(function() {
			var monthNames = ["January", "February", "March", "April", "May", "June",
				"July", "August", "September", "October", "November", "December"];
			var dayNames = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
			var currentDate = new Date();
			
			todayDate = dayNames[currentDate.getDay()] + ", " 
								+ monthNames[currentDate.getMonth()] + " " 
								+ currentDate.getDate() + " "
								+ currentDate.getUTCFullYear();

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
					document.getElementById("datetoday").innerHTML = todayDate;
					document.getElementById("dateDrop").value = todayDate;
				}
     		});
  		});

$(document).ready(function(){
	$("#myBtn").click(function(){
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

