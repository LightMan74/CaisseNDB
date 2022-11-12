<?php
	define('DB_SERVER', 'mysql19.lwspanel.com');
	//define('DB_SERVER', '192.168.1.28');
	define('DB_USERNAME', 'alpes1599882');
	define('DB_PASSWORD', 'bozds56pkh');
	define('DB_NAME', 'alpes1599882');
		
	$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
?>