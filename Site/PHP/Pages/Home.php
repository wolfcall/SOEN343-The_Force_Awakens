<!DOCTYPE html>
<?php

//Start session
session_start();

include "../Class/Student.php";
include "../Class/StudentMapper.php";
include "../Class/RoomMapper.php";
include "../Class/ReservationMapper.php";
include dirname(__FILE__)."/../Utilities/tableHelper.php";

$email = $_SESSION['email'];
$student = new StudentMapper($email);
$reserve = new ReservationMapper();

//$reserve->addReservation(1,1,1, , ,"Test", "InnerTest");

//Tested - Gives California
//$room = new RoomMapper(1);
//$program = $room->getName();

$firstName = $student->getFirstName();
$lastName = $student->getLastName();
$program = $student->getProgram();
$sID = $student->getSID();

?>


<html lang="en">

<!--
	September 27, 2016 (Joey)
	-Added jQuery 1.x, in order for datepicker to work (try to upgrade to 3.1.1)
	-Added datepicker to basic img
	
	September 30, 2016 (Stefano)
	-Added Modal to the Reservation page when users selects make reservation button
	-Made table entities clickable to activate reservations

	October 1, 2016 (Joey)
	-Added calender as default, no image required
	-Added auto-generation of date in reservation table, based on user click of the calender

	October 9, 2016 (Joey)
	-Fixed connection to db for populating Make Reservation popup
	
	!-Still necessary to pass entity ID of time selected
	!-Colors are not permanent, was done to check if CSS worked for table
	!-Red should indicate times that are booked
	!-Grey should indicate times that are not booked
-->

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Room Reserver</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../CSS/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../CSS/landing-page-Registration.css" rel="stylesheet">

	<!-- jQuery -->
    <script src="../../Javascript/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../Javascript/bootstrap.min.js"></script>
	
	<!--jQuery stuff-->
	<!--Try to update to new jquery, doesn't seem to work with jquery 3.1.1-->
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script type="text/javascript">

		$(document).ready(function() {
			var monthNames = ["January", "February", "March", "April", "May", "June",
				"July", "August", "September", "October", "November", "December"];
			var dayNames = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
			var currentDate = new Date();
			
			/******
			 * This date generation should be made into a function, including the arrays above,
			 * and would accept a Date object
			 */
			todayDate = dayNames[currentDate.getDay()] + ", " 
								+ monthNames[currentDate.getMonth()] + " " 
								+ currentDate.getDate() + " "
								+ currentDate.getUTCFullYear();

			document.getElementById("datetoday").innerHTML = todayDate;
			/** end of the function, resued in "onSelect" feature of datepicker */
			
    		$("#datepickerInline").datepicker({
        	//	buttonImage: '../img/calendar.png',
        	//	buttonImageOnly: true,
        		changeMonth: true,
        		changeYear: true,
        		showOn: 'both',
				onSelect: function(event) {
					var pickedDate = $("#datepickerInline").datepicker("getDate");
					todayDate = dayNames[pickedDate.getDay()] + ", " 
								+ monthNames[pickedDate.getMonth()] + " " 
								+ pickedDate.getDate() + " "
								+ pickedDate.getUTCFullYear();
					document.getElementById("datetoday").innerHTML = todayDate;
				}
     		});
  		});
	</script>

	<!-- Pop-up for reservation (by clicking Button)
	Will have to include a way of indicating that start time must be 8:00am
	-->
	<script>
		$(document).ready(function(){
			$("#myBtn").click(function(){
				$("#myModal").modal();
			});
		});
	</script>

	

	<!-- Pop-up for reservation (by clicking table)
	Will have to include some way of passing the time from the block chosen to popup
	-->
	<script>
		$(document).ready(function(){
			$(".slot").click(function(){
				$("#myModal").modal();
			});
		});
	</script>

	<!-- Pop-up for profile editing (by clicking My Profile)-->
	<script>
		$(document).ready(function(){
			$("#second-r").click(function(){
				$("#profilemyModal").modal();
			});
		});
	</script>
		
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top topnav">
        <div class="container topnav">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
				<a class="navbar-brand topnav first r" id="first-r" href="../../index.php">Log Out</a>
				<a class="navbar-brand topnav second r" id="second-r" href="#">My Profile</a>
				<a class="navbar-brand topnav third r" id="third-r" href="#">My Reservations</a>
				<a class="navbar-brand topnav fourth r" id="fourth-r" href="https://my.concordia.ca/psp/upprpr9/EMPLOYEE/EMPL/h/?tab=CU_MY_FRONT_PAGE2">MyConcordia</a>
        
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Header -->
	<div class="intro-header">
		<div class="container">
			<div class="row">
				<div class="greeting">
					<h1>Please select a Day to Begin</h1>
				</div>
				<!-- class greeting -->

				<br><br>

				<!-- Div for datepicker -->
				<div id="datepickerContainer">
					<div id="datepickerInline"></div>
					<br><br>
					<div id="reserveButton">
						<a class="btn btn-default btn-lg" data-target="myModal" id="myBtn"><span class="network-name">Make a Reservation</span></a>
					</div>
				</div>

				<br><br>

				<!-- Reservation Modal -->
				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 style="color:red;">Please enter the specifications for your Reservation</h4>
							</div>
							<div class="modal-body">
								<form id="form">

									<div class="form-group">
										<label>Title of Reservation</label>
										<input type="text" class="form-control" name="title" placeholder="Enter a Title">
									</div>
									<div class="form-group">
										<label>Description of Reservation</label>
										<textarea rows="4" cols="50" class="form-control" name="description" placeholder="Enter your Description">
										</textarea>
									</div>

									<!-- Time slots should be inserted here-->


									<!-- Should be Auto-Populated and Non-Editable-->
									<div class="form-group">
										<label>First Name</label>
										<input disabled type="text" class="form-control" name="firstname" value = "<?php echo $firstName; ?>">
									</div>
									<div class="form-group">
										<label>Last Name</label>
										<input disabled type="text" class="form-control" name="lastname" value = "<?php echo $lastName; ?>">
									</div>
									<div class="form-group">
										<label>Student ID</label>
										<input disabled type="text" class="form-control" name="studentID" value = "<?php echo $sID; ?>">
									</div>
									<div class="form-group">
										<label>Program</label>
										<input disabled type="text" class="form-control" name="program" value = "<?php echo $program; ?>">
									</div>
									<div class="form-group">
										<label>Email Address</label>
										<input disabled type="text" class="form-control" name="email" value = "<?php echo $email; ?>">
									</div>

									<!-- Requires Back-end connection -->
									<button type="submit" class="btn btn-default btn-success btn-block">Submit</button>

								</form>
							</div>
						</div>
					</div>
				</div>

				<!-- Profile Modal -->
				<div class="modal fade" id="profilemyModal" role="dialog">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 style="color:red;">Edit any of your profile info!</h4>
							</div>
							<div class="modal-body">
								<form id="form" action="changeDetails.php" method="post">
									<div class="form-group">
										<label>First Name</label>
										<input disabled type="text" class="form-control" name="firstname" placeholder="First Name" value = "<?php echo $firstName; ?>">
									</div>
									<div class="form-group">
										<label>Last Name</label>
										<input disabled type="text" class="form-control" name="lastname" placeholder="Last Name" value = "<?php echo $lastName; ?>">
									</div>
									<div class="form-group">
										<label>Student ID</label>
										<input disabled type="text" class="form-control" name="studentID" placeholder="Student ID" value = "<?php echo $sID; ?>">
									</div>
									<div class="form-group">
										<label>Program</label>
										<input disabled type="text" class="form-control" name="program" placeholder="Program" value = "<?php echo $program; ?>">
									</div>
									<div class="form-group">
										<label>Old Password</label>
										<input type="password" class="form-control" name="oldPass" placeholder="Old Password">
									</div>
									<div class="form-group">
										<label>New Password</label>
										<input type="password" class="form-control" name="newPass" placeholder="New Password">
									</div>
									<div class="form-group">
										<label>Current Email Address</label>
										<input disabled type="text" class="form-control" name="oldEmail" placeholder="Email Address" value = "<?php echo $email; ?>">
									</div>
									<div class="form-group">
										<label>New Email Address</label>
										<input type="text" class="form-control" name="newEmail" placeholder="Email Address">
									</div>

									<!-- Requires Back-end connection -->
									<button type="submit" class="btn btn-default btn-success btn-block">Submit</button>

								</form>
							</div>
						</div>
					</div>
				</div>

				<div id="reservation-table"><br>
					<?php
						$thelper = new tableHelper();
						
						$params = array("class"=>"reservations");
						
						$table = $thelper->initTable($params);
						
						$values = array();
						for($x = 0 ; $x < 24 ; $x++){
							$values[] = sprintf("%02.0f",$x).":00";
						}
						
						$table .= $thelper->populateHeader(array("colspan" => "2"), "time", $values, " ", "date", "datetoday");
						
						$values = array();
						for($x = 0 ; $x < 48 ; $x++){
							$values[] = "00";
						}
						
						$table .= $thelper->populateRow(array("colspan" => "1"), "slot", $values, "Room1", "room");
						$table .= $thelper->populateRow(array("colspan" => "1"), "slot", $values, "Room2", "room");
						$table .= $thelper->populateRow(array("colspan" => "1"), "slot", $values, "Room3", "room");
						$table .= $thelper->populateRow(array("colspan" => "1"), "slot", $values, "Room4", "room");
						$table .= $thelper->populateRow(array("colspan" => "1"), "slot", $values, "Room5", "room");
						
						$table .= $thelper->closeTable();
						
						echo $table;
					?>
				
				</div>
				<!-- id reservation-table -->
			</div>
			<!-- Class row -->
		</div>
		<!-- class containter -->
	</div>
	<!-- class="intro-header" -->

</body>

</html>
