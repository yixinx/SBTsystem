<?php
	class Book
	{
		var $conn;

		public $StId;
		public $TypeId;
		public $CourseId;
		public $BookNm;	
		public $Author;
		public $Language;
		public $Version;
		public $Quantity;
		public $Price;
		public $Location;
		public $Status;
		public $Comments;
		public $Filename;
		public $UploadInstant;
				
		function __construct() {
			$this->conn = mysqli_connect("localhost", "sbtsys", "sbt@8765","sbtsys"); 
			mysqli_query($this->conn, "SET NAMES  'utf8'");
		}
		
		function __destruct() {
			mysqli_close($this->conn);
		}
		
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
}
		
		//插入新记录,返回1代表成功插入,其中0代表“在售”
		function insert_newbook()
		{
			$sql = "INSERT INTO book VALUES('$this->StId',
											'$this->TypeId',
											'$this->CourseId',
											'$this->BookNm',
											'$this->Author',
											'$this->Language',
											'$this->Version',
											'$this->Quantity',
											'$this->Price',
											'$this->Location',
											0, 
											'$this->Comments',
											'$this->Filename',
											NULL
											)";
			$result = $this->conn->query($sql);
			return $result;
		}
		
		//根据条件查询,返回一个结果子表，onsale查询用
		function search_number_onsale($a, $obt, $obp, $oblan, $obloc, $offset, $pagesize)
		{
			//count or load
			if($a==0){$sea="count(*)";}
			else {$sea="*";}
			//type id
			if(!empty($this->TypeId))
			{ $typeid="Type_ID = '$this->TypeId'";}
			else
			{$typeid=1;}
			//course id
			if(!empty($this->CourseId))
			{ $courseid="Course_ID='$this->CourseId'";}
			else
			{ $courseid=1;}
			//language
			switch($oblan)
			{
			case 0:$lan="Language='English'";break;
			case 1:$lan="Language='Chinese'";break;
			case 2:$lan="Language='Others'";break;
			case 3:$lan=1;break;
			}
			//location
			switch($obloc)
			{
			case 0:$loc="Location='SJTU'";break;
			case 1:$loc="Location='UM'";break;
			case 2:$loc=1;break;
			}
			//oder by time or price
			if($obt==0)
			{$order=" ORDER BY Upload_Instant DESC";}
			else if($obt==1)
			{$order=" ORDER BY Upload_Instant ASC";}
			else if
			($obt==2 && $obp==0)
			{ $order=" ORDER BY Price DESC";}
			else if($obt==2 && $obp==1)
			{$order=" ORDER BY Price ASC";}
			else
			{$order=" ";}
			//pagesize and offset
			$sql="SELECT ".$sea." FROM book WHERE Status=0 AND ".$typeid." AND ".$courseid." AND ".$lan." AND ".$loc.$order;
			if($offset==0 && $pagesize==0){}
			else
			{	$sql=$sql." limit $offset,$pagesize";}
			//echo $sql;
			$result = $this->conn->query($sql);
			if($a==0)
			{	
				$rownum = mysqli_fetch_array($result);
				//echo $rownum[0];
				return $rownum[0];
			}
			else
			{	return $result;}
		}
		
		//删除某条书籍记录，返回1代表成功删除
		function delete()
		{
			$sql = "DELETE FROM book WHERE (Student_ID = '$this->StId',
													Course_ID = '$this->CourseId', 
													Book_Name = '$this->BookNm',
													Author = '$this->Author',
													Quantity = '$this->Quantity',
													Price = '$this->Price',
													Status = '$this->Status')";
			$result = $this->conn->query($sql);
			return $result;
		}
		
		//返回的是某个人的所有在售课程书籍,mybook用
		function load_myonsale()
		{
			$sql = "SELECT * FROM book WHERE Student_ID = '$this->StId' AND Status=0 ";
			$result = $this->conn->query($sql);
			Return $result;
		}
		
		//返回的是某个人的所有已售书籍,myhistory用
		function load_myhistory()
		{
			$sql = "SELECT * FROM book WHERE Student_ID = '$this->StId' AND Status=1";
			$result = $this->conn->query($sql);
			Return $result;
		}
		
		//返回的是某个人的某一本书籍,edit用
		function load_one_book()
		{
			$sql = "SELECT * FROM book WHERE Student_ID='$this->StId' AND Book_Name='$this->BookNm' ";
			$result = $this->conn->query($sql);
			Return $result;
		}		
		
		//更新某本书的内容，edit用
		function update($old)
		{
			$sql="UPDATE book SET Book_Name = '$this->BookNm',
										Author = '$this->Author',
										Language = '$this->Language',
										Version = '$this->Version',
										Quantity = '$this->Quantity',
										Price = '$this->Price',
										Location = '$this->Location',
										Status = '$this->Status',
										Comments = '$this->Comments',
										File_name = '$this->Filename',
										Upload_Instant = NULL
										WHERE (Student_ID='$this->StId' AND Book_Name='$old')";
			$result = $this->conn->query($sql);
		}
		
		function total_number($obt,$obp,$oblan, $obloc)
		{
			$sql="SELECT count(*) FROM book";
			if($obt!=2 || $obp!=2)
			{
				$result = $this->conn->query($sql);
				$rownum = mysqli_fetch_array($result);
				return $rownum[0];
			}
			else
			{switch($oblan){
			case 0:{$lan="Language='English'";break;}
			case 1:{$lan="Language='Chinese'";break;}
			case 2:{$lan="Language='Others'";break;}
			case 3:$lan=1;break;}

			switch($obloc){
			case 0:{$loc="Location='SJTU'";break;}
			case 1:{$loc="Location='UM'";break;}
			case 2:$loc=1;break;}

			$sql="SELECT count(*) FROM book WHERE ".$lan." AND ".$loc. " ";
			echo "$sql";
			$result = $this->conn->query($sql);
			//$count=0;
			$rownum = mysqli_fetch_array($result);
			echo $rownum[0];
			return $rownum[0];
			}
		}
		
	}
?>