<!DOCTYPE html>
<?php

//Start session
session_start();

include "../Class/StudentMapper.php";
include "../Class/RoomMapper.php";
include "../Class/ReservationMapper.php";
include "../Class/WaitlistMapper.php";
include "../Class/RoomList.php";
include dirname(__FILE__)."/../Utilities/tableHelper.php";


$email = $_SESSION['email'];
$userMSG = $_SESSION["userMSG"] ;
$msgClass = $_SESSION["msgClass"];
$modify = $_SESSION["modify"];


if(isset($_SESSION["userMSG"])){
	unset($_SESSION["userMSG"]);
    unset($_SESSION["msgClass"]);
}



$student = new StudentMapper($email);
$reserve = new ReservationMapper();
$rooms = new RoomList();

$firstName = $student->getFirstName();
$lastName = $student->getLastName();
$program = $student->getProgram();
$sID = $student->getSID();

$test = $reserve->getREID($sID);
$studentReservations = $reserve->getReservations($student->getSID());

//If user selects a reservation to modify, this will obtain the reservation details
$modReserve = array();
$modDate;
$modTimeEnd;
if($modify)
{
	//echo $_SESSION['reserveDate'];
	
	foreach($studentReservations as &$singleReservation)
	{ 
		if($_SESSION['reservation'] == $singleReservation['reservationID'])
		{
			$modReserve = $singleReservation;
		}
	}
	$modDate = explode(" ", $modReserve['startTimeDate']);
	$modTimeEnd = explode(" ", $modReserve['endTimeDate']);
}

$getStartHoursSelect = false;
$getEndHoursSelect = false;
//$non_studentRes = $reserve->getReservationsByDate("2016-11-11");
//var_dump($non_studentRes);

$today = date("d/m/Y");
$today = $reserve->getReservationsByDate($today);
function getHours(){
	global $getStartHoursSelect, $getEndHoursSelect;
	global $modDate, $modTimeEnd;
	for($x = 0; $x < 48; $x++){
		$time = (int)($x/2) . ":";
		if($x % 2 == 1){
			$time .= "30";
		}else{
			$time .= "00";
		}
		$timeMod = $time;
		if(strlen($timeMod)==4)$timeMod = "0".$time;
		if($getStartHoursSelect && $timeMod == $modDate[1])
		{
			echo "<option selected='selected' value = '".$time."'>".$time."</option>";
		}
		elseif($getEndHoursSelect && $timeMod == $modTimeEnd[1])
		{
			echo "<option selected='selected' value = '".$time."'>".$time."</option>";
		}
		else
		{
			echo "<option value = '".$time."'>".$time."</option>";
		}
	}
}

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
	
        Novemeber 6, 2016 (Nick)
        -Added reservation tab functionality

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
    
	<!-- All Javascript for Home.php page -->
	<script src="../../Javascript/Home.js"></script>
        
<?php
    if($modify)
    {
            echo '<script> $(document).ready(function(){$("#editModal").modal("show");}); </script>';
            $_SESSION['modify'] = NULL; //Should clear out modify session if user refreshes
    }
	
?>
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
                
				<a class="navbar-brand topnav first r" id="first-r" href="LogOut.php">Log Out</a>
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
				<!-- Id space to confirm if the data was saved or not -->
				<div>
					<?php
						if(!empty($userMSG)){
							echo '<div id = "details" class = "details '.$msgClass.'">'.$userMSG.'</div>';
						}
					?>
				</div>
				
				<!-- class greeting -->
				<div class="greeting">
					<h1>Please select a Day and Room to Begin!</h1>
				</div>
				
				<br><br>

				<!-- Div for datepicker -->
				<div id="datepickerContainer">
					<div id="datepickerInline"></div>
					<br><br>
					<div>
						<select id = "roomOptions" class="btn btn-default btn-lg network-name" name = "roomNum">
							<?php
								foreach($rooms->getRoomList() as $val){
									echo "<option value = '{$val[0]->getRID()}'>{$val[0]->getName()}</option>\n";
								}
							?>
						</select>
					</div>
					<br>
					<div id="reserveButton">
						<a class="btn btn-default btn-lg" data-target="myModal" id="myBtn"><span class="network-name">Make a Reservation</span></a>
					</div>
				</div>

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
								<form id="form" action="Reserve.php" method="post">

									<div class="form-group">
										<label>Title of Reservation</label>
										<input required type="text" class="form-control" placeholder="Enter a Title"  name="title" >
									</div>
									<div class="form-group">
										<label>Description of Reservation</label>
										<textarea style="resize:none;" rows="3" cols="50" placeholder="Describe the Reservation here..." class="form-control" name="description"></textarea>
									</div>
									<!-- Time slots should be inserted here-->
									<div class="form-group">
										<label>Date:</label>
										<input readonly="readonly" type="text" class="form-control" name = "dateDrop" id="dateDrop" placeholder = "Nothing" />
										<br>										
										<label>Start Time:</label> 
											<select name = "startTime">
												<?php getHours()?>
											</select>&nbsp &nbsp &nbsp
										<label>End Time:</label>
											<select name = "endTime">
												<?php getHours()?>
											</select>&nbsp &nbsp &nbsp
										<select readonly = "readonly" id = "roomOptionsMod" class="roomNum" name = "roomNum">
											<?php														
												foreach($rooms->getRoomList() as $val){
														echo "<option value = '{$val[0]->getRID()}'>{$val[0]->getName()}</option>\n";
												}
											?>
										</select>
									</div>
									<div class="form-group">
										<label>Name</label>
										<input readonly="readonly" type="text" class="form-control" name="firstName" placeholder="First Name" value = "<?php echo $firstName." ".$lastName; ?>"/>
									</div>
									<div class="form-group">
										<label>Student ID</label>
										<input readonly="readonly" type="text" class="form-control" name="studentID" value = "<?php echo $sID; ?>"/>
									</div>
									<div class="form-group">
										<label>Program</label>
										<input readonly="readonly" type="text" class="form-control" name="program" value = "<?php echo $program; ?>"/>
									</div>
									<div class="form-group">
										<label>Email Address</label>
										<input readonly="readonly" type="text" class="form-control" name="email" value = "<?php echo $email; ?>"/>
									</div>

									<button type="submit" class="btn btn-default btn-success btn-block">Submit</button>

								</form>
							</div>
						</div>
					</div>
				</div>
				
				<!-- Edit Reservation Modal -->
				<div class="modal fade" id="editModal" role="dialog">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 style="color:red;">Please Edit the specifications of your Reservation</h4>
							</div>
							<div class="modal-body">
								<form id="form" action="Reserve.php" method="post">

									<div class="form-group">
										<label>Title of Reservation</label>
										<input type="text" class="form-control" placeholder="Enter a Title"  name="title" value = "<?php echo $modReserve['title']; ?>">
									</div>
									<div class="form-group">
										<label>Description of Reservation</label>
										<textarea rows="3" cols="50" placeholder="Describe the Reservation here..." class="form-control" name="description"><?php echo $modReserve['description']; ?></textarea>
									</div>
									<!-- Time slots should be inserted here-->
									<div class="form-group">
										<label>Date:</label>
										<input readonly="readonly" type="text" class="form-control" name = "dateDrop" id="dateDrop" value="<?php echo $modDate[0]; ?>"/>
										<br>										
										<label>Start Time:</label> 
											<select name = "startTime">
												<?php
												$getStartHoursSelect = true;
												getHours();
												$getStartHoursSelect = false;
												?>
											</select>&nbsp &nbsp &nbsp
										<label>End Time:</label>
											<select name = "endTime">
												<?php
												$getEndHoursSelect = true;
												getHours();
												$getEndHoursSelect = false;
												?>
											</select>&nbsp &nbsp &nbsp
										<select readonly = "readonly" id = "roomOptionsMod" class="roomNum" name = "roomNum">
											<?php
												foreach($rooms->getRoomList() as $val){
													if($val[0]->getRID() == $modReserve['roomID'])
													{
														echo "<option selected='selected' value = '{$val[0]->getRID()}'>{$val[0]->getName()}</option>\n";
													}
													else
													{
														echo "<option value = '{$val[0]->getRID()}'>{$val[0]->getName()}</option>\n";
													}
												}
											?>
										</select>
									</div>
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
								<form id="profileForm" name = "form" action="ChangeDetails.php" method="post" onclick ="showResult();">
									<div class="form-group">
										<label>Name</label>
										<input readonly="readonly" type="text" class="form-control" name="firstName" placeholder="First Name" value = "<?php echo $firstName." ".$lastName; ?>"/>
									</div>
									<div class="form-group">
										<label>Student ID</label>
										<input readonly="readonly" type="text" class="form-control" name="studentID" placeholder="Student ID" value = "<?php echo $sID; ?>"/>
									</div>
									<div class="form-group">
										<label>Program</label>
										<input readonly="readonly" type="text" class="form-control" name="program" placeholder="Program" value = "<?php echo $program; ?>"/>
									</div>
									<div class="form-group">
										<label>Old Password</label>
										<input type="password" class="form-control" name="oldPass" placeholder="Old Password"/>
									</div>
									<div class="form-group">
										<label>New Password</label>
										<input type="password" class="form-control" name="newPass" placeholder="New Password"/>
									</div>
									<div class="form-group">
										<label>Current Email Address</label>
										<input readonly="readonly" type="text" class="form-control" name="oldEmail" placeholder="Email Address" value = "<?php echo $email; ?>"/>
									</div>
									<div class="form-group">
										<label>New Email Address</label>
										<input type="text" class="form-control" name="newEmail" placeholder="Email Address"/>
									</div>

									<button type="submit" class="btn btn-default btn-success btn-block">Submit</button>
								</form>
							</div>
						</div>
					</div>
				</div>
                                
				<!-- My Reservations Modal -->
				<div class="modal fade" id="reservationmyModal" role="dialog">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 style="color:red;">Your Reservations:</h4>
							</div>
							<div class="modal-body">
									<?php 
									$startDateTime;
									$endDateTime;
									$deleteButton;
									$count = 1;
									foreach($studentReservations as &$singleReservation)
									{   
										$active = new RoomMapper($singleReservation["roomID"]);
										$activeRoom = $active->getName();
										$deleteButton = '<button type="Submit" name="action" value = "delete" class="center btn btn-default"> Delete Reservation '.$count.'</button>';
										$modifyButton = '<br><button type="Submit" data-target="myModal" id = "modify" name="action" value = "modify" class="center btn btn-default"> Modify Reservation '.$count.'</button>';
										$hidden = '<input type="hidden" name="rID" value="'.$singleReservation["reservationID"].'"></input>';
										$startDateTime = explode(" ", $singleReservation["startTimeDate"]);
										$endDateTime = explode(" ", $singleReservation["endTimeDate"]);
										echo "<form id='myReservationform' action='ModifyReservation.php' method='post'>";
											echo "<section class = 'leftcolumn'>";
												echo $hidden;
												echo "Room Name : ".$activeRoom."<br>";
												echo "Title : ".$singleReservation['title']."<br>";
												echo "Date : ".$startDateTime[0]."<br>";
												echo "Start Time : ".$startDateTime[1]."<br>";
												echo "End Time : ".$endDateTime[1];
											echo "</section>";
											echo "<aside class = 'rightcolumn'>";
												echo $deleteButton."<br>";
												echo $modifyButton."<br><br>";
											echo "</aside>";
										echo "</form>";
										$count = $count + 1;
									}
									?>
							</div><!-- End modal-body -->
						</div><!-- End modal content -->
					</div><!-- End modal-dialog -->
				</div><!-- End MyReservations Modal -->
				<div id="reservation-table"><br>
					<?php
						/*$thelper = new tableHelper();
						
						$params = array("class"=>"reservations", "id"=>"reservations");

						$table = $thelper->initTable($params);
						$values = array();
						for($x = 0 ; $x < 24 ; $x++){
							$values[] = sprintf("%02.0f",$x).":00";
						}
						
						$table .= $thelper->populateHeader(array("colspan" => "2"), "time", $values, " ", "date", "datetoday");

						$roomRes = $rooms->getRoomList();
						foreach($today as $res){
							$start = $res->getStartTimeDate();
							$start = explode(" ", $start);
							$start = explode(":", $start[1]);
							$end = $res->getEndTimeDate();
							$end = explode(" ", $end);
							$end = explode(":", $end[1]);

							$slots = (2*($end[0] - $start[0])) + (($end[1] == $start[1])?0:1);
							$begin = (2*$start[0]) + ((strcmp($start[1],"00")==0)?0:1);
							for($x = 0 ; $x < $slots ; $x++){
								$id = $res->getRID();
								$pos = $begin + $x;
								$roomRes[$id][1][$pos] = '11';
							}
						}

						foreach($roomRes as $val){
							$table .= $thelper->populateRow(array("colspan" => "1"), "slot", $val[1], $val[0]->getName()." (".$val[0]->getLocation().")", "room");
						}

						$table .= $thelper->closeTable();

						echo $table;*/
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
