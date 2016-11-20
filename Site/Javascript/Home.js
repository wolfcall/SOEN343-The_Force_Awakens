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
	$("[name='dateDrop']").val(todayDate);
	//document.getElementById("dateDrop").value = todayDate;
	
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
			//document.getElementById("dateDrop").value = todayDate;
			$("[name='dateDrop']").val(todayDate);
		}
	});
});
function lockoutSubmit(timeExpire) {
    
   btn = document.getElementById('makeReserve');
	
	//Get current Time
	var dt = new Date();
	var secs = dt.getSeconds() + (60 * dt.getMinutes()) + (60 * 60 * dt.getHours());
	
	
	//If expering time is greater than the current time
	//Then initiate the timer
	if(timeExpire > secs)
	{
		var left = timeExpire-secs;
		
		btn.setAttribute('disabled', true);

		setTimeout(function(){
		   btn.removeAttribute('disabled');
		},left*1000)
	}	
}

$(document).ready(function(){
	
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
	
	$('#editModal').on('hidden.bs.modal', function () {
		location.href = 'ClearRoom.php';
	});
	
	$('#makeReserve').click(function(){
		openModel();
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
		
		if(performance.navigation.type  == 1) {
			$('#myModal').modal('hide');
		}
		else {
		seconds--;				

        display.text(seconds);
	}
        
    }, 1000);
}
$(function(){

	 minuteTimer2(60, $('#timer2'));
    $('#editModal').on('show.bs.modal', function(){
        var myModal = $(this);
        clearTimeout(myModal.data('hideInterval'),60000);
        myModal.data('hideInterval', setTimeout(function(){
            myModal.modal('hide');
        }, 60000));
    });
});

function minuteTimer2(duration, display) {
    var seconds = duration;
	display.text(seconds);
    setInterval(function () {
		
		if(performance.navigation.type  == 1) {
			$('#editModal').modal('hide');
		}
		else {
		seconds--;				

        display.text(seconds);
	}
        
    }, 1000);
}
function disappear(){
	if($("#details").text() === ""){
		$("#details").hide();
	}else{
		$("#details").show();
		setTimeout(function(){ 
			$("#details").slideUp(1000);
		}, 3000);	
	}
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

function openModel(){
	$.ajax({
		url:"checkRoomAvaImp.php",
		type:"POST",
		data:{
			dateDrop: $("#mkResdateDrop").val(),
			action:"make",
			rID: $("#roomOptions").val()
		},
		success:function(data){
			var tags = document.createElement("DIV");
			tags.innerHTML = data;
			var available = $(tags).children("#CRAroomAvailable").val();
			if(available === "true"){
				$("#details").removeClass("failure");
				$("#details").html("");
				$("#myModal").modal();
			}else{
				$("#details").addClass("failure");
				$("#details").text($(tags).children("#CRAuserMsg").val())
			}
			disappear();
		}
	});
}

function myNav() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}