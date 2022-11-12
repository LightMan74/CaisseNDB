<?php
	define('DB_SERVER', 'localhost');
	//define('DB_SERVER', '192.168.1.28');
	define('DB_USERNAME', 'GlyCiuM');
	define('DB_PASSWORD', 'Azertyuiop!1');
	define('DB_NAME', 'glycium');
		
	$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
?>