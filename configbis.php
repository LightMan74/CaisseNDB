<?php
	//define('DB_SERVER', 'lmbruleurs.fr');
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'siteconnect');
	define('DB_PASSWORD', 'Azertyuiop!1');
	define('DB_NAME', 'bdphp');
		
	$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
?>