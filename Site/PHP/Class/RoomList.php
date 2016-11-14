<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RoomList
 *
 * @author Georges
 */
include_once 'RoomTDG.php';
include_once 'RoomDomain.php';

class RoomList {
	//put your code here
	
	private $roomList;
	private $tdg;
	
	public function __construct() {
		$this->roomList = array();
		$this->tdg = new RoomTDG();
		//$this->roomList = $this->tdg->getAllRooms();
		
		
		foreach($this->tdg->getAllRooms() as $val){
			$tmp = new RoomDomain();
			$tmp->setRID($val["roomID"]);
			$tmp->setName($val["name"]);
			$tmp->setLocation($val["location"]);
			$tmp->setDescription($val["description"]);
			$this->roomList[$val["roomID"]][0] = $tmp;
			$values = array();
			for($x = 0 ; $x < 48 ; $x++){
				$values[] = "00";
			}
			$this->roomList[$val["roomID"]][1] = $values;
		}
		
	}
	
	public function getRoomList(){
		return $this->roomList;
	}
}
