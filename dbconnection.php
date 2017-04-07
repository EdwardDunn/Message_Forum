<!DOCTYPE html>
<!--
Name: dbconnection.php
Description: Database connect file, to be included in any file requiring connection
Author: Edward Dunn
Date: 07/04/14
Version: 1.0
-->
<html>
<body>

<?php

try{

$host = '******';
$dbname = '******';
$username = '******';
$password = '********';

$con = new PDO ('mysql:host='.$host.';dbname='.$dbname.';charset=utf8',$username,$password);
//echo "successful";
}catch (PDOException $e) {
	
	die("Connection Failed");
}

?>


</body>
</html>