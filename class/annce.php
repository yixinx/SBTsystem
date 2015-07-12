<?php
	class Annce
	{
		var $conn;
		
		//public $annceNum;
		public $St_ID;
		public $Title;
		public $Content;
		public $Filename;
		private $timestamp;
		
		
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
		
		function insert_annce()
		{
			$sql = "INSERT INTO annce VALUES('$this->St_ID',
			                                 '$this->Title',
											 '$this->Content',
											 '$this->Filename',
											 NULL
											 )";
			$result = $this->conn->query($sql);
			/* echo "meow~";
			echo $this->St_ID;
			echo $this->Title;
			echo $this->Content; */
			return $result;
		}
		
		function delete_annce()
		{
			$sql = "DELETE FROM annce WHERE Student_ID = $St_ID AND Title = $this->Title AND Content = $this->Content";
			$this->conn->query($sql);
		}
		
		function load_annce($instant)
		{
			$sql = "SELECT * FROM annce WHERE Upload_Instant = $instant";
			$only_one_row = $this->conn->query($sql);
			$result = fetch_row($only_one_row);
			$this->St_ID = $result["Admin"];
			$this->Title = $result["Title"];
			$this->Content = $result["Content"];
		}
		
		function update_annce()
		{
			$sql = "UPDATE annce SET Student_ID = $this->St_ID, Title = $this->Title, Content = $this->Content WHERE Upload_Instant = $this->timestamp";
			$this->conn->query($sql);
		}
		
	}
?>