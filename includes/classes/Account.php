<?php
	
	
	class Account
	{
		private $errorArray;
		private $con;

		public function __construct($con)
		{
			$this->con = $con;
			$this->errorArray = array();
		}
		public function register($un,$fn,$ln,$ps,$ps2,$em,$em2){
			$this->validateUsername($un);
			$this->validateFirstname($fn);
			$this->validateLastname($ln);
			$this->validatePasswords($ps,$ps2);
			$this->validateEmails($em,$em2);

			if (empty($this->errorArray)) {
				return $this->insertUserDetails($un, $fn, $ln, $em, $ps);
				
			} 
			else {

				return false;
			}
		}

		public function login($un, $ps){
			$password = md5($ps);

			$query = mysqli_query($this->con ,"SELECT * FROM users WHERE username = '$un' AND password= '$password'");
			if (mysqli_num_rows($query) != 0) {
				return true;
			} 
			else {
				array_push($this->errorArray, Constants::$loginFailed);
				return false;
			}
		}

		public function getError($error){

			if (!in_array($error, $this->errorArray)) {
				$error="";
			}
			return "<span class='errormessage'>$error</span>";
		}
		private function insertUserDetails($un, $fn, $ln, $em, $ps){
			$encrypPw = md5($ps);
			$imagePath = "assests/images/Hacker-icon.png";
			$date = date("Y-m-d");
			$query ="INSERT INTO users (username, firstname, lastname, email, password, signUpDate, profilePic) VALUES ('$un', '$fn', '$ln', '$em','$encrypPw', '$date', '$imagePath')";
			//$query ="INSERT INTO users VALUES ('','$un', '$fn', '$ln', '$em','$encrypPw', '$date', '$imagePath')";
			$res = mysqli_query($this->con,$query); 
			return $res;
		}
		private function validateUsername($un){

				if (strlen($un) > 25 || strlen($un) < 5) {
					// testing without this->
					array_push($this->errorArray, Constants::$usernameCharacters );
					return;
				}

				$checkUsernameQuery=mysqli_query( $this->con, "SELECT username FROM users WHERE username = '$un'");
				if (mysqli_num_rows($checkUsernameQuery) != 0) {
					array_push($this->errorArray, Constants::$usernameTaken);
				}
		}
		private function validatefirstname($fn){

			if (strlen($fn) > 25 || strlen($fn) < 5) {
					array_push($this->errorArray, Constants::$firstnameCharacters);
					return;
				}

		}
		private function validatePasswords($ps,$ps2){

			if ($ps != $ps2) {
				array_push($this->errorArray, Constants::$passwordsDoNotMAtch);
					return;
			}

			if (preg_match('/[^A-za-z0-9]/', $ps)) {
				array_push($this->errorArray, Constants::$passwordsNotAlphaNumeric);
					return;
			}

			if (strlen($ps) > 30 || strlen($ps) < 5) {
					array_push($this->errorArray, Constants::$passwordsCharacters);
					return;
				}
		  
		}
		private function validateEmails($em,$em2){

			if ($em != $em2) {
				array_push($this->errorArray, Constants::$emailsDoNotMatch);
					return;
			}

			if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
				array_push($this->errorArray, Constants::$emailInvalid);
					return;
			}

			$checkEmailQuery=mysqli_query( $this->con, "SELECT * FROM users WHERE email = '$em'");
				if (mysqli_num_rows($checkEmailQuery) != 0) {
					array_push($this->errorArray, Constants::$emailTaken);
				}
		  
		}
		private function validateLastname($ln){

			if (strlen($ln) > 25 || strlen($ln) < 5) {
					array_push($this->errorArray, Constants::$lastnameCharacters);
					return;
				}
		  
		}
	}
?>