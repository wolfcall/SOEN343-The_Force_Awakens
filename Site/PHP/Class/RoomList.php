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

class RoomList {
	//put your code here
	
	private $roomList;
	private $tdg;
	public function __construct() {
		$this->roomList = array();
		$this->tdg = new RoomTDG();
		$this->roomList = $this->tdg->getAllRooms();
	}
	
	public function getRoomList(){
		return $this->roomList;
	}
}
