<?php

/*** mysql hostname ***/
$hostname = 'localhost';

/*** mysql username ***/
$username = 'oanegron';

/*** mysql password ***/
$password = 'oanegron';


	$con = mysqli_connect($hostname,$username,$password,"oanegron_db");
    /*** echo a message saying we have connected ***/
	
    // Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	} 
    

?>
