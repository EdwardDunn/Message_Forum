<?php
/*
Name: login.php
Description: Returns rowCount from database based on email address and password entered
if rowCount > 0 forum.php (main message forum page) is opened. The username alocated to 
database row will initialised using session.
Author: Edward Dunn
Date: 07/04/14
Version: 1.0
*/

include_once 'dbconnection.php';

$email = $_POST['email'];
$password = $_POST['password'];
//var_dump($_POST);

//check if any text boxes are empty
if(empty($email) || empty($password)){

	echo '<script language="javascript">';
	echo 'alert("Please enter a value for each box")';
	echo '</script>';

	header( "refresh:0; url=login.html" );
}
//Return rowCount based on whether email address and password exist in database
else{

	$stmt = $con->prepare("SELECT email, password 
							FROM forum_users 
							WHERE email = ? AND password = ?");

	$result = $stmt->execute([$email, $password]);

	if ($stmt->rowCount() > 0 )
	{
		
		$query = $con->query("
		SELECT * 
		FROM forum_users	
		WHERE email = '$email'
		");
		
		$user = $query->fetch(PDO::FETCH_OBJ);

		$username = $user->username;	
		
		session_start();
		$_SESSION['username'] = $username;
		
		header('Location: forum.php?');
		
	}
	//output alert message if details entered are not in database
	else
	{			
		echo '<script language="javascript">';
		echo 'alert("Password or username does not exist")';
		echo '</script>';

		header( "refresh:0; url=login.html" );
	}   
}
	
?>