<?php
class booktype
{
	public $TypeId;
	public $TypeNm;
	
		function __construct() {
			$this->conn = mysqli_connect("localhost", "sbtsys", "sbt@8765","sbtsys"); 
			mysqli_query($this->conn, "SET NAMES  'utf8'");
		}
		
		function __destruct() {
			mysqli_close($this->conn);
		}
		
		function insert_type()
		{
			$sql = "INSERT INTO book_type VALUES('$this->TypeId','$this->TypeNm')";
			$result = $this->conn->query($sql);
		}
		
		function delete_type()
		{
			$sql = "DELETE FROM book_type WHERE Type_ID = '$this->TypeId'";
			$result = $this->conn->query($sql);			
		}
		//根据条件查询,返回一个结果子表，onsale查询用
		function load_typename()
		{
					$sql = "SELECT * FROM book_type WHERE Type_ID = '$this->TypeId' ";
					$result = $this->conn->query($sql);
					$row = $result->fetch_row();
					$this->TypeNm=$row[1];
		}
}
?>