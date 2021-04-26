<?php
	$host = 'localhost';
	$dataBase = 'labsweb';
	$user = 'root';
	$password = '';

	$link = mysqli_connect($host,$user,$password,$dataBase);
	if(mysqli_connect_errno()){ //return error number if !0
		echo 'Error conect to dataBase № ' . mysqli_connect_errno() . ': ' . mysqli_connect_error();
		exit();
	}
?>