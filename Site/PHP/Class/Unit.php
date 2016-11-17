<?php

include dirname(__FILE__)."RoomMapper";
include dirname(__FILE__)."StudentMapper";
include dirname(__FILE__)."ReservationMapper";

class UnitOfWork
{
	private $conn;
	/*
		Room can be modified (to set the room as locked or not)
		Room cannot be deleted
		Room cannot be inserted
	*/
	private $roomUpdateList;
	/*
		Student can be modified (only for email and password)
		Student cannot be deleted
		Student cannot be inserted
	*/
	private $studentUpdateList;
	/*
		Reservations can be modified
		Reservations can be created
		Reservations can be deleted
	*/
	private $reservationNewList;
	private $reservationUpdateList;
	private $reservationDeletedList;
	
	public function __construct($conn) {

		$temp = "";
		$this->conn = $conn;
		
		$this->roomUpdateList = array();
		$this->studentUpdateList = array();
		$this->reservationNewList = array();
		$this->reservationUpdateList = array();
		$this->reservationDeletedList = array();
	}
	
	/* 
		Trigger Modification of a Room
	*/
	public function registerDirtyRoom($roomObject){
		
		array_push($this->roomUpdateList, $roomObject);
	}
	
	/* 
		Trigger Modification of a Student
	*/
	public function registerDirtyStudent($studentObject){
		
		array_push($this->studentUpdateList, $studentObject);
	}

	/*
		Trigger Modification of a Student
	*/
	public function registerDirtyReservation($reservationObject){
		
		array_push($this->reservationUpdateList, $reservationObject);
	}
	
	public function registerNewReservation($reservationObject){
		
		array_push($this->reservationNewList, $reservationObject);
	}
	
	public function registerDeletedReservation($reservationObject){
		
		array_push($this->reservationDeletedList, $reservationObject);
	}
	
	/*
		Finalize All Data to be updated
	*/
	public function commit()
	{
		$room = new RoomMapper();

		//Commit changes to the Room
		$room->updateRoom($this->roomUpdateList, $this->conn);
		
		$roomUpdateList = null;
		
		/*
		//Commit changes to the student
		$student->updateStudent($studentUpdateList, $this->conn);
		
		//Commit change to the Reservations
		$reservation->addReservation($reservationNewList, $this->conn);
		$reservation->updateReservation($reservationUpdateList, $this->conn);
		$reservation->deleteReservation($reservationDeletedList, $this->conn);
		
		//Clear the list after completetion
		$studentUpdateList = null;
		$reservationNewList = null;
		$reservationUpdateList = null;
		$reservationDeletedList = null;
		*/
	}
}
?>