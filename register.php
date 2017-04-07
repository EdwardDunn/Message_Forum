<?php
/*
Name: register.php
Description: Checks users for unique email and username, updates database with user details if true
Author: Edward Dunn
Date: 07/04/14
Version: 1.0
*/

include_once 'dbconnection.php';

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

//check if any text boxes are empty
if(empty($fname) || empty($lname) || empty($username) || empty($email) || empty($password)){

	echo '<script language="javascript">';
	echo 'alert("Please enter a value for each box")';
	echo '</script>';

	header( "refresh:0; url=register.html" );

}
else{
		//check if email address already registered
		$stmt = $con->prepare("
		SELECT email
		FROM forum_users	
		WHERE email = ?
		");
		
		$emailResult = $stmt->execute([$email]);
		$emailResult = $stmt->rowCount();
		
		//check if username already used
		$stmt = $con->prepare("
		SELECT username
		FROM forum_users	
		WHERE username = ?
		");
		
		$usernameResult = $stmt->execute([$username]);
		$usernameResult = $stmt->rowCount();
			
		//if email has already been registered
		if($emailResult > 0 ){
			
			echo '<script language="javascript">';
			echo 'alert("There is already an account regsitered to this email address")';
			echo '</script>';

			header( "refresh:0; url=register.html" );
			
		}
		//if username is already in use
		else if($usernameResult > 0){
			
			echo '<script language="javascript">';
			echo 'alert("Username is already taken, please choose another")';
			echo '</script>';

			header( "refresh:0; url=register.html" );
			
		}
		//registered user details entered
		else{
			
		$query = $con->prepare("
			
				INSERT INTO forum_users(fname, lname, username, email, password)
				VALUES (:fname, :lname, :username, :email, :password)

		");

		$success = $query->execute([
			'fname' => $fname,
			'lname' => $lname,
			'username' => $username,
			'email' => $email,
			'password' => $password
			
		]);

			header('Location: login.html?');
		}
		
}

?>

