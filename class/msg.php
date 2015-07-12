<?php
	class Msg
	{
		var $conn;
		
		public $Sender;
		public $Receiver;
		public $Title;
		public $Content;
		public $id;
		private $Timestamp;
		
		
		function __construct(){
			$this->conn = mysqli_connect("localhost", "sbtsys", "sbt@8765","sbtsys"); 
			mysqli_query($this->conn, "SET NAMES 'utf8'");
		}
		
		function __destruct(){
			mysqli_close($this->conn);
		}
		
		function test_input($data){
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		
		function insert_msg()
		{
			$sql = "INSERT INTO message VALUES('$this->Sender',
			                                 '$this->Receiver',
											 '$this->Title',
											 '$this->Content',
											 NULL
											 )";
			$result = $this->conn->query($sql);
			/* //echo "meow~";
			echo $this->St_ID;
			echo $this->Title;
			echo $this->Content; */ 
			if($result){
				echo "<script>alert('Sending new message succeeds!');</script>";
			}
			else{echo "<script>alert('Sending new message failed!');</script>";}
			return $result;
		}
		
		function delete_msg()
		{
			$sql = "DELETE FROM message WHERE Send_Instant = $this->Timestamp";
			$this->conn->query($sql);
		}
		
/* 		//all the messages sent to me
		function load_mymsgrv()
		{
			$sql = "SELECT * FROM message WHERE Receiver = $Receiver";
			$result = $this->conn->query($sql);
			return $result;
		}
		function load_mymsgtx()
		{
			$sql = "SELECT * FROM message WHERE Sender = $Sender";
			$result = $this->conn->query($sql);
			return $result;
		} */
		function load_mymsg()
		{
			$sql = "SELECT * FROM message WHERE Sender = $this->id OR Receiver = $this->id ORDER BY Send_Instant";
			$result = $this->conn->query($sql);
			return $result;
		}
		
	}
?>