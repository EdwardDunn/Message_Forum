<?php
/*
Name: forum.php
Description: Dislays all message held in database along with username of the user that posted message
and the date posted. The page also allows user to enter their own message which uses forumSubmit.php to 
update database with new message.
Author: Edward Dunn
Date: 07/04/14
Version: 1.0
*/

include_once 'dbconnection.php';

//read from database
$query = $con->query("
SELECT *
FROM forum_messages
");

//store returned result as object
$forum_messages = $query->fetchAll(PDO::FETCH_OBJ);

//output to page object values
$output = "";
foreach ($forum_messages as $message){
	$output .= '<div id="messageBox">';
	
			$output .= '<div id="messageBoxDetails">';			
				
				$output .= '<p>';
				$output .= 'Posted by ';
				$output .= $message->username . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				$output .= '</p>'; 
				

				$output .= '<p>';
				$output .= 'on ';
				$output .= $message->date_posted;
				$output .= '</p>';
			
			$output .= '</div>';
		
		$output .= '<p>';
		$output .= $message->message . ' ';
		$output .= '</p>';
	
	$output .= '</div>';
}

?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="styles/forum.css">

<head>
<title>Forum</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

</head>

<!--Onload the page will go to bottom of page and header will maintain position at top of page-->
<body onload="toBottom()" data-spy="scroll" data-offset="50">

<div id="pageContainer">

	<div id="header">
		<a href="login.html">
		<button class="button logoutButton">Log Out</button>
		</a>
			<div id="headerText">
				Chat Forum
			</div>
	</div>

	<!--display message-->
	<?= $output ?>

	<!--form for user to submit their own message-->
	<div id="submitBox">

		<form action="forumSubmit.php" method="POST" onSubmit="window.location.reload()">

		<label for="message">Message: </label>
			
		<input type="text" name="message" id="message">

		<input type="submit" type="submit" value="Submit">

		</form>
		
	</div>

</div>

<!--Make page load at bottom of page so newest post is seen first -->
<script>
function toBottom()
{
window.scrollTo(0, document.body.scrollHeight);
}
</script>

</body>

</html>