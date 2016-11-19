//The Javascript file containing the javascript from PHP/Pages/Home.php.
var diff = 1;
var clickDisabled = false;
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

	loadTable(currentDate.getUTCFullYear() + "/" + (currentDate.getMonth()+1) + "/" + currentDate.getDate());
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
			loadTable(pickedDate.getUTCFullYear() + "/" + (pickedDate.getMonth()+1) + "/" + pickedDate.getDate());
			document.getElementById("datetoday").innerHTML = todayDate;
			document.getElementById("dateDrop").value = todayDate;
			
		}
	});
});


$(document).ready(function(){
	
   
      if (clickDisabled == true)
	  {
		  $("#myBtn").click(function(){return false;});
		
	 }
	 else{
	$("#myBtn").click(function(){
	 var selected = document.getElementById("roomOptions").selectedIndex;
		document.getElementById("roomOptionsMod").selectedIndex = selected;
		$("#endTime").children().eq(diff).attr('selected', 'selected');
	 clickDisabled = true;
	 });
	 }
	
	$("#myBtn").unload(function () {
		setTimeout(function(){clickDisabled = true;}, 30000);
		clickDisabled = false;
	});
	
	
	$("#startTime").change(function(){
		$("#endTime").children().eq($("#endTime").prop('selectedIndex')).removeAttr('selected');
		$("#endTime").children().eq(($("#startTime").prop('selectedIndex') + diff >48)? 48 : $("#startTime").prop('selectedIndex') + diff).attr('selected', 'selected');
	});
	
	$("#endTime").change(function(){
		diff = $("#endTime").prop('selectedIndex') - $("#startTime").prop('selectedIndex');
	});
	
	$("#second-r").click(function(){
		$("#profilemyModal").modal();
	});
	
	$("#third-r").click(function(){
		$("#reservationmyModal").modal();
	});
	
	$('#myModal').on('hidden.bs.modal', function () {
		location.href = 'ClearRoom.php';
	});
	
	
});

$(function(){

	 minuteTimer(60, $('#timer'));
    $('#myModal').on('show.bs.modal', function(){
        var myModal = $(this);
        clearTimeout(myModal.data('hideInterval'),60000);
        myModal.data('hideInterval', setTimeout(function(){
            myModal.modal('hide');
        }, 60000));
    });
});

function minuteTimer(duration, display) {
    var seconds = duration;
	display.text(seconds);
    setInterval(function () {
		
		seconds--;				

        display.text(seconds);
		
        
    }, 1000);
}
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

function myNav() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}