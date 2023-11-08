<?php
/* Database connection settings */
	$servername = "localhost";
    $username = "root";		//phpmyadmin username.(default is "root")
    $password = "";			//if phpmyadmin has a password put it here.(default is "root")
    $dbname = "biometricattendace";
    
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	
	if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
    }
?>