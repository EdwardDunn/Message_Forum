<?php
/*
Name: forumSubmit.php
Description: Submits text entered in to text box in forum.php, gets username using session create in login.php
Author: Edward Dunn
Date: 07/04/14
Version: 1.0
*/

include_once 'dbconnection.php';

//get username for user currently logged in
session_start();
$name = $_SESSION['username'];


$message = $_POST['message'];

//update database with new message
	if($message != ""){

		$query = $con->prepare("
			
				INSERT INTO forum_messages(message, date_posted, username)
				VALUES (:message, CURDATE(), :name)

		");

		$success = $query->execute([
			'message' => $message,
			'name' => $name
		]);
	}

reload();

//reload page script
function reload(){
	header("Location: forum.php");
}
?>