<?php 
	/* The database credentials. */
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'art_gallery');

	/* Attempt to connect to MySQL database */
	$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	 
	$GLOBALS['link'] = $link; 
	// Check connection, if error, return with the error statement
	if($link === false){
	    die("ERROR: Could not connect. " . mysqli_connect_error());
	}
 ?>