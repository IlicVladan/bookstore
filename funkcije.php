<?php

	$serverName = "localhost";
	$userName = "root";
	$password = "";
	$dbName = "bookstore";

	$db = mysqli_connect($serverName,$userName,$password,$dbName);

	if(!$db) {
		
	die("Connection failed " . mysqli_connect_error());
	
}
?>