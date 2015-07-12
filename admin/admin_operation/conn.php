<?php

	function connectDB(){
		$conn = mysqli_connect("localhost", "sbtsys", "sbt@8765","sbtsys"); 
		if(!$conn){
			echo "fail to connect DB.";
		}
	/* 	else{
			echo "succeed to connect DB.";
		} */
		return $conn;
	}
    function destroyDB(){
		mysql_close();
	}

?>