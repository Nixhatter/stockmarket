<?php

function doDB() {
	global $mysqli;
	//connect to server and select database
	$mysqli = mysqli_connect("localhost", "nixx", "7BBC610C4A815FD0DB49F7094AF36F9D3E0C4EE43B9C380660346C4ACE8403AF", "stockmarket");
	//If the connection fails
	if(mysqli_connect_errno()){
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
}
?>
