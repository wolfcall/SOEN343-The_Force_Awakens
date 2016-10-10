<?php
/* 
 * Original Creator: Nicholas Burdet
 * Last Change Date: 10/02/16 (NB)
 * 
 * Version History:
 * 10/05/16(NB)
 * -Added program value and gets and sets
 * 
 * 10/02/16(NB)
 * -Removed username, email will handle username usage
 * -Added inclusion to server connection handling
 * -Cleaned up password validation slightly
 * 
 * 30/09/16(NB)
 * -Added email (as username?) to variables and appropriate gets and sets
 * -Tested database connections but left in test code (except for personal password)
 * 
 * 
 * NOTES:
 * This merely a bare-bones, first draft, template. More work is
 * to be done when documentation is finalized and processes defined.
*/

// Start the session
session_start();

include_once dirname(__FILE__).'/../Utilities/ServerConnection.php';

class User
{
    private $username = "";
    /* For the sake of security, password will not be stored in the user
    * class, but can be obtained from the database using the check password
    * method which compares the password entered at login vs password
    * obtained from the database, and returns whether or not they were a
    * match.
    */
    private $firstName;
    private $lastName;
    private $emailAddress;
    private $program;
	private $sID;
    
    //Association to reservation class (class not created yet at time of coding)
    private $reservation;
   
    //Should this just be the storage for user information or also
    //handle server authentication?
    //NOTE(25/09/16): If password validation method used further below,
    //should make this a null constructor, and let password validator
    //populate object upon successful login.
	public function __construct($email) {

		$this->setEmailAddress($email);
		
		$conn = getServerConn();
		
		$sql = "SELECT * FROM student WHERE email ='".$this->getEmailAddress()."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		$this->setFirstName($row["firstName"]);
		$this->setLastName($row["lastName"]);
		$this->setProgram($row["program"]);
		$this->setSID($row["studentID"]);
				
		closeServerConn($conn);
	}
    
    /* The general gets and sets are here
     * (Sets may be unneccessary since users should already be
     * created in the database, this would be to populate the
     * object)
     */
    public function getFirstName(){
		return $this->firstName;
    }
    
    public function getLastName(){
		return $this->lastName;
    }
    
    //Returns reservation object
    public function getReservation() {
        return $this->reservation;
    }
    
    public function getEmailAddress() {
        return $this->emailAddress;
    }
    
    public function getProgram() {
        return $this->program;
    }
	
	public function getSID() {
        return $this->sID;
    }
    
    public function setFirstName($fName){
		$this->firstName = $fName;
    }
    
    public function setLastName($lName){
		$this->lastName = $lName;
    }
    
    public function setReservation($reserve){
		$this->reservation = $reserve;
    }
    
    public function setEmailAddress($email) {
        $this->emailAddress = $email;
    }
    
    public function setProgram($prog) {
        $this->program = $prog;
    }
	
	public function setSID($sID) {
        $this->sID = $sID;
    }
    
    //To clear the object in case user login fails?
    function __destruct() {
       //echo "Object destroyed";
   }
}
