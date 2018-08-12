<?php 
include("../config.php");

if (!isset($_POST['username'])) {
	echo "username not Identified";
	exit();
}

if (isset($_POST['email']) && $_POST['email'] != "") {
	
	$email = $_POST['email'];
	$username = $_POST['username'];

	if (filter_var($email,FILTER_VALIDATE_EMAIL)) {

		
		$query = mysqli_query($con,"SELECT email FROM users WHERE email='$email' AND username='$username'");
		if (mysqli_num_rows($query) > 0) {
			
			echo "Email Already in USE";
			exit();
		}
		else {
			mysqli_query($con,"UPDATE users SET email='$email' WHERE username='$username'");
			echo "Email Updated Successfully";
		}
	}
	else {
		echo "Invalid Email";
		exit();
	}
} else {
	echo "Email field Empty";
}

?>