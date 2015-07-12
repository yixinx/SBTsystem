<?PHP
	class Users
	{
		var $conn;

		public $StId;
		public $StPwd;	
		public $StName;
		public $qq;
		public $phone;
		public $email;
		public $soldNum;
		
				
		function __construct() {
			$this->conn = mysqli_connect("localhost", "sbtsys", "sbt@8765", "sbtsys"); 
			mysqli_query($this->conn, "SET NAMES 'utf8'");
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
		
		//判断是否被注册过
		function if_exist()
		{
			$result = $this->conn->query("SELECT * FROM user WHERE Student_ID='$this->StId'");
			if($row = $result->fetch_row()) {
			//获取该id到当前实例中，这个没啥用目前
				//$this->StId = $StId;
				return true;
			}
			else
				return false;
		}
				
		// 判断密码是否正确
		function verify()
		{			
			$sql = "SELECT * FROM user WHERE Student_ID='$this->StId' AND  Password='$this->StPwd'";
			$result = $this->conn->query($sql);
			if($row = $result->fetch_row())  
			{
			//获取该id到当前实例中，这个没啥用目前
				//$this->StId = $StId;
				return true;
			}
			else
				return false;
		}
		
		// 插入新记录
		function insert()
		{
			$sql = "INSERT INTO user VALUES('$this->StId','$this->StName', '$this->StPwd' , '0', '$this->qq','$this->phone','$this->email', '0')";
			/* echo $this->StId;
			echo $this->StName;
			echo $this->StPwd;
			echo $this->qq;
			echo $this->phone;
			echo $this->email;
			 */
			$this->conn->query($sql);
		}

		// 删除用户
		function delete()
		{
			$sql = "DELETE FROM user WHERE Student_ID='$this->StId'";
			$this->conn->query($sql);
		}			
		
		function load_users()
		{
			$sql = "SELECT * FROM user WHERE Student_ID='$this->StId'";
			$only_one_row = $this->conn->query($sql);
			$result=$only_one_row->fetch_row();
			$this->StName = $result[1];
			$this->StPwd = $result[2];
			$this->qq = $result[4];
			$this->phone = $result[5];
			$this->email = $result[6];	
			$this->soldNum = $result[7];
		}
		
		function load_privilege()
		{
			$sql = "SELECT Privilege FROM user WHERE Student_ID = '$this->StId'";
			$result = $this->conn->query($sql);
			$priv = $result->fetch_row();
			Return $priv[0];
		}
		
		function load_soldNum()
		{
			$sql = "SELECT soldNum FROM user WHERE Student_ID = '$this->StID'";
			$result = $this->conn->query($sql);
			$soldN = $result->fetch_row();
			return $soldN[0];
		}
		
		function increase_soldNum()
		{
			$sql = "UPDATE user SET soldNum = soldNum + 1 WHERE Student_ID = '$this->StId'";
			$result = $this->conn->query($sql);
		}
		
		function decrease_soldNum()
		{
			$sql = "UPDATE user SET soldNum = soldNum - 1 WHERE Student_ID = '$this->StId'";
			$result = $this->conn->query($sql);
		}
		
				
		// 更新个人信息
		function update_info()
		{
			$sql = "UPDATE user SET Student_Name = '$this->StName', QQ='$this->qq', Phone='$this->phone', Email='$this->email' WHERE Student_ID='$this->StId'";
			$this->conn->query($sql);
		}
		
		// 更新密码
		function update_pwd() {		
			$sql = "UPDATE user SET Password='$this->StPwd' WHERE Student_ID='$this->StId' ";
			$this->conn->query($sql);
		}	
	}
?>