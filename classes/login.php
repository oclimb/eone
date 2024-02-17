<?php



//include 'DBConnection.php';
//session_start();


class login_function {



    private $con = '';
    private $dbcon = '';



    public function __construct() {

        $this->dbcon = new dbcon();

        $this->con = $this->dbcon->dbcon_function();

    }


function login($uname,$pass){

$login_validate = false;
if ($stmt = $this->con->prepare('SELECT `user_id`, `user_password`, `user_name` FROM user WHERE `user_name` = ?')) {
	$stmt->bind_param('s', $uname);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
	
if ($stmt->num_rows > 0) { 
	$stmt->bind_result($user_id, $user_password, $user_name);
	$stmt->fetch(); 
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	if ($pass==$user_password) { 
		// Verification success! User has logged-in!
		// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
		session_regenerate_id();
		$_SESSION['LOGIN_USER_ID']= $user_id;
		$_SESSION['LOGIN_USER']= $user_name;
		$login_validate = true;
		
	}else{
		$login_validate = false;
	}

} 
$stmt->close();
}

$this->dbcon->disconnect();


return $login_validate;
}
    


}



?>