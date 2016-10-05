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

//MySQL Database Connect 
//session_start();
// '../Utilities/ServerConnection.php';
//$conn = getCon();

//Temporary use only, delete this server connection at a later date
$servernameremote = "wolfcall.ddns.net";
$user = "nicholas";
$pass = "*******";
$port = 3306;
$schema = "soen343";
$conn = new mysqli($servernameremote, $user, $pass, $schema, $port);



class User
{
    private $username = "";
    /* For the sake of security, password will not be stored in the user
    * class, but can be obtained from the database using the check password
    * method which compares the password entered at login vs password
    * obtained from the database, and returns whether or not they were a
    * match.
    */
    private $firstName = "";
    private $lastName = "";
    private $emailAddress = "";
    private $program = ""; //Added 05/10/16 NB
    
    //Association to reservation class (class not created yet at time of coding)
    private $reservation;
   
    //Should this just be the storage for user information or also
    //handle server authentication?
    //NOTE(25/09/16): If password validation method used further below,
    //should make this a null constructor, and let password validator
    //populate object upon successful login.
    public function __construct($uName) {
        /*
         * //Username is email?
        $sql = "SELECT password FROM student WHERE username ='".$uName."'";
        $result = $connection->Something is wrong($sql);
        $row = $result->fetch_assoc()
        $password = $row["password"];
        */
        $this->username = $uName;
        //$this->firstName = $fName;
        //$this->lastName = $lName;
        
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
    //-Method to call to validate user password
    //-If true, should populate the object with names
    //-If false, destroy object?
    //-If used this way, perhaps make a null constructor
    public function validatePassword($email, $enteredPassword) {
        
         $sql = "SELECT * FROM student WHERE email ='".$email."'";
         $result = $conn->query($sql);
         $row = $result->fetch_assoc();
         $password = $row["password"];
        
       //Add hash check here later once hashing has been done
       if($enteredPassword = $password)
       {
           $this->setFirstName($row["firstName"]);
           $this->setLastName($row["lastName"]);
           $this->setEmailAddress($email);
           $this->setProgram($row["program"]);
           return true;
       }
       else
       {
           return false;
       }
    }
    
    //To clear the object in case user login fails?
    function __destruct() {
       //echo "Object destroyed";
   }
}
//FOR TESTING PURPOSES, TO BE DELETED LATER
$sql = "SELECT * FROM student";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$fname = $row["firstName"];
echo $fname;
$row = $result->fetch_assoc();
$fname = $row["firstName"];
echo $fname;
