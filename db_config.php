<?php
require_once('db_config.php');

	define('HOST','localhost:3306');
	
	define('USER','silvano');
	define('PASS','access');
	define('DB','image_test');
	
	
	$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');
?>
