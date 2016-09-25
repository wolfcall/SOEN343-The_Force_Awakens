<?php

/* 
 * Original Creator: Nicholas Burdet
 * Last Change Date: 25/09/16 (NB)
 * 
 * Version History: 
 * 25/09/16(NB)
 * -Added password validation concept
 * -Added temporary reservation class association (reservation class
 * at this point not yet started, so purely conceptual).
 * -Added reservation get and sets
 * 
 * 23/09/16(NB)
 * -Created skeleton for user class, gets and sets, rudimentary sql workings
 * 
 * NOTES:
 * This merely a bare-bones, first draft, template. More work is
 * to be done when documentation is finalized and processes defined.
 */

    //Below is bare bones mySQL code to connect to the database.
    //Values to be inserted later.
    //This might not be the correct method for doing this
    //but will act as placeholder in any case
/*
    $server = "insert server name here";
    $user = "insert username here";
    $pass = "insert password here";
    $db = "insert database name/location here";
    
    $connection = new mysqli($server, $user, $pass, $db);
*/

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
    
    //Association to reservation class (class not created yet at time of coding)
    private $reservation;

    //Should this just be the storage for user information or also
    //handle server authentication?
    //NOTE(25/09/16): If password validation method used further below,
    //should make this a null constructor, and let password validator
    //populate object upon successful login.
    public function __construct($uName, $pWord) {
        /*
        $sql = "SELECT password FROM table_name WHERE username ='".$uName."'";
        $result = $connection->query($sql);
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
    
    public function getUserName(){
	return $this->username;
    }
    
    public function getReservation() {
        return $this->reservation;
    }
    
    public function setFirstName($fName){
	$this->firstName = $fName;
    }
    
    public function setLastName($lName){
	$this->lastName = $lName;
    }
    
    public function setUserName($uName){
	$this->username = $uName;
    }
    
    //Returns reservation object
    public function setReservation($reserve){
	$this->reservation = $reserve;
    }
    //-Method to call to validate user password
    //-If true, should populate the object with names
    //-If false, destroy object?
    //-If used this way, perhaps make a null constructor
    public function validatePassword($userName, $enteredPassword) {
        /*
         * $sql = "SELECT username, password, firstname, lastname FROM table_name WHERE username ='".$uName."'";
         * $result = $connection->query($sql);
         * $row = $result->fetch_assoc()
         * $password = $row["password"];
        */
       if($enteredPassword = $password)
       {
           $this->setFirstName($row["firstname"]);
           $this->setLastName($row["lastname"]);
           $this->setUserName($row["username"]);
           return true;
       }
       else
           return false;
    }
    
    //To clear the object in case user login fails?
    function __destruct() {
       //echo "Object destroyed";
   }
}

//Code purely for testing purposes. To be deleted later
$test = new User("n_burdet", "password");
echo "First Name: " . $test->getFirstName();
echo "</br>";
echo "Last Name: " . $test->getLastName();
echo "</br>";
echo "Username: " . $test->getUserName();

echo "</br>";
$test = null;
