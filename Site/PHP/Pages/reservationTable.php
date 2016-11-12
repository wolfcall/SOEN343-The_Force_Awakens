<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include "../Class/ReservationMapper.php";
include dirname(__FILE__)."/../Utilities/tableHelper.php";
include "../Class/RoomList.php";

$reserve = new ReservationMapper();
echo "<br />"; 
$rooms = new RoomList();
if(isset($_GET["Date"])){
	$date = explode("/", $_GET["Date"]);
	//var_dump($date);
	$today = $reserve->getReservationsByDate($date[2]."/".$date[1]."/".$date[0]);
}else{
	$today = date("d/m/Y");
	$today = $reserve->getReservationsByDate($today);
}

$thelper = new tableHelper();
						
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

echo $table;